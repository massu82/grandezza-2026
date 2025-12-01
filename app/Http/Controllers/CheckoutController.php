<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = collect(session('cart', []));
        $productIds = $cart->pluck('product_id')->all();
        $products = Product::query()->whereIn('id', $productIds)->get()->keyBy('id');

        $items = $cart->map(function ($item) use ($products) {
            $product = $products[$item['product_id']] ?? null;

            return (object) [
                'id' => $item['product_id'],
                'name' => $product?->nombre ?? 'Producto',
                'qty' => $item['quantity'],
                'price' => $product?->precio ?? 0,
                'subtotal' => ($product?->precio_promocion ?? $product?->precio ?? 0) * $item['quantity'],
            ];
        });

        return view('checkout.index', [
            'cartItems' => $items,
            'cartTotal' => $items->sum('subtotal'),
        ]);
    }

    public function store(OrderRequest $request)
    {
        // reserva para flujo legacy (pago al recoger)
        return $this->createStripeSession($request);
    }

    public function createStripeSession(OrderRequest $request)
    {
        $cart = collect(session('cart', []));
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Tu carrito está vacío.');
        }

        $secret = config('services.stripe.secret');
        $public = config('services.stripe.public');
        if (!$secret || !$public) {
            return redirect()->back()->with('error', 'Stripe no está configurado. Verifica las llaves.');
        }

        $productIds = $cart->pluck('product_id')->all();
        $products = Product::query()->whereIn('id', $productIds)->get()->keyBy('id');

        $lineItems = [];
        $normalizedItems = [];
        $total = 0;

        foreach ($cart as $item) {
            $product = $products[$item['product_id']] ?? null;
            if (!$product) {
                continue;
            }
            $price = $product->precio_promocion ?? $product->precio ?? 0;
            $amount = (int) round($price * 100);
            $quantity = $item['quantity'] ?? 1;
            $total += $price * $quantity;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'mxn',
                    'product_data' => [
                        'name' => $product->nombre,
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => $quantity,
            ];

            $normalizedItems[] = [
                'product_id' => $product->id,
                'nombre' => $product->nombre,
                'precio' => $price,
                'cantidad' => $quantity,
                'subtotal' => $price * $quantity,
            ];
        }

        if (empty($lineItems)) {
            return redirect()->back()->with('error', 'No se encontraron productos válidos en el carrito.');
        }

        $stripe = new StripeClient($secret);

        $session = $stripe->checkout->sessions->create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'customer_email' => $request->email_cliente,
            'metadata' => [
                'nombre_cliente' => $request->nombre_cliente,
                'telefono_cliente' => $request->telefono_cliente,
            ],
            'success_url' => url('/checkout/success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/checkout/cancel'),
        ]);

        session([
            'stripe_checkout' => [
                'session_id' => $session->id,
                'customer' => [
                    'nombre_cliente' => $request->nombre_cliente,
                    'email_cliente' => $request->email_cliente,
                    'telefono_cliente' => $request->telefono_cliente,
                    'notas_cliente' => $request->notas_cliente,
                ],
                'items' => $normalizedItems,
                'total' => $total,
                'processed' => false,
            ],
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        $payload = session('stripe_checkout');
        $sessionId = request('session_id');

        if (!$payload || !$sessionId || ($payload['session_id'] ?? null) !== $sessionId) {
            return redirect('/checkout')->with('error', 'No pudimos validar tu pago.');
        }

        if ($payload['processed'] ?? false) {
            session()->forget('cart');
            return redirect('/')->with('success', 'Pago confirmado. Gracias por tu compra.');
        }

        $secret = config('services.stripe.secret');
        if (!$secret) {
            return redirect('/checkout')->with('error', 'Stripe no está configurado.');
        }

        $stripe = new StripeClient($secret);
        $session = $stripe->checkout->sessions->retrieve($sessionId);

        if (($session->payment_status ?? '') !== 'paid') {
            return redirect('/checkout')->with('error', 'El pago no fue confirmado.');
        }

        $order = DB::transaction(function () use ($payload) {
            $order = Order::create([
                'codigo' => Str::upper(Str::random(8)),
                'user_id' => auth()->id(),
                'nombre_cliente' => $payload['customer']['nombre_cliente'] ?? '',
                'email_cliente' => $payload['customer']['email_cliente'] ?? '',
                'telefono_cliente' => $payload['customer']['telefono_cliente'] ?? '',
                'estado' => 'pagado',
                'metodo_entrega' => 'recoleccion_tienda',
                'total' => $payload['total'] ?? 0,
                'notas_cliente' => $payload['customer']['notas_cliente'] ?? null,
                'notas_internas' => 'Pagado vía Stripe Checkout',
            ]);

            foreach ($payload['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'nombre_producto' => $item['nombre'],
                    'precio_unitario' => $item['precio'],
                    'cantidad' => $item['cantidad'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            $order->load('items');

            if (!empty($payload['customer']['email_cliente'])) {
                Mail::to($payload['customer']['email_cliente'])->send(new OrderCreated($order, false));
            }

            if ($admin = config('mail.from.address')) {
                Mail::to($admin)->send(new OrderCreated($order, true));
            }

            return $order;
        });

        session()->forget('cart');
        $payload['processed'] = true;
        $payload['order_code'] = $order->codigo;
        session(['stripe_checkout' => $payload]);

        session()->forget('stripe_checkout');

        return redirect('/')->with('success', 'Pago confirmado. Código de pedido: '.$order->codigo);
    }

    public function cancel()
    {
        return redirect('/checkout')->with('error', 'Pago cancelado. Puedes intentar nuevamente.');
    }
}
