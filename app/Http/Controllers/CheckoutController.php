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
        $cart = collect(session('cart', []));
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Tu carrito está vacío.');
        }

        $productIds = $cart->pluck('product_id')->all();
        $products = Product::query()->whereIn('id', $productIds)->get()->keyBy('id');

        DB::transaction(function () use ($request, $cart, $products) {
            $total = 0;
            foreach ($cart as $item) {
                $product = $products[$item['product_id']] ?? null;
                $price = $product?->precio_promocion ?? $product?->precio ?? 0;
                $total += $price * $item['quantity'];
            }

            $order = Order::create([
                'codigo' => Str::upper(Str::random(8)),
                'user_id' => auth()->id(),
                'nombre_cliente' => $request->nombre_cliente,
                'email_cliente' => $request->email_cliente,
                'telefono_cliente' => $request->telefono_cliente,
                'estado' => 'nuevo',
                'metodo_entrega' => 'recoleccion_tienda',
                'total' => $total,
                'notas_cliente' => $request->notas_cliente,
                'notas_internas' => null,
            ]);

            foreach ($cart as $item) {
                $product = $products[$item['product_id']] ?? null;
                if (!$product) {
                    continue;
                }
                $price = $product->precio_promocion ?? $product->precio;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'nombre_producto' => $product->nombre,
                    'precio_unitario' => $price,
                    'cantidad' => $item['quantity'],
                    'subtotal' => $price * $item['quantity'],
                ]);
            }

            $order->load('items');

            if ($request->filled('email_cliente')) {
                Mail::to($request->email_cliente)->send(new OrderCreated($order, false));
            }

            if ($admin = config('mail.from.address')) {
                Mail::to($admin)->send(new OrderCreated($order, true));
            }
        });

        session()->forget('cart');

        return redirect('/')->with('success', 'Pedido creado. Te contactaremos para la recolección.');
    }
}
