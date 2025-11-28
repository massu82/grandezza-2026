<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        [$items, $total] = $this->cartSummary();

        return view('cart.index', [
            'cartItems' => $items,
            'cartTotal' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::with('category')->findOrFail($request->integer('product_id'));

        $cart = collect(session('cart', []));
        $index = $cart->search(fn ($item) => $item['product_id'] == $request->integer('product_id'));

        if ($index !== false) {
            $item = $cart->get($index);
            $item['quantity'] += $request->integer('quantity');
            $item['precio'] = $product->precio;
            $item['precio_promocion'] = $product->precio_promocion;
            $item['nombre'] = $product->nombre;
            $item['imagen'] = $product->imagen_principal;
            $item['categoria'] = $product->category?->nombre;
            $cart->put($index, $item);
        } else {
            $cart->push([
                'product_id' => $request->integer('product_id'),
                'quantity' => $request->integer('quantity'),
                'nombre' => $product->nombre,
                'precio' => $product->precio,
                'precio_promocion' => $product->precio_promocion,
                'imagen' => $product->imagen_principal,
                'categoria' => $product->category?->nombre,
            ]);
        }

        session(['cart' => $cart->values()->all()]);

        if ($request->wantsJson()) {
            return response()->json($this->cartSummary());
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::find($request->integer('product_id'));

        $cart = collect(session('cart', []))->map(function ($item) use ($request, $product) {
            if ($item['product_id'] == $request->integer('product_id')) {
                $item['quantity'] = $request->integer('quantity');
                if ($product) {
                    $item['precio'] = $product->precio;
                    $item['precio_promocion'] = $product->precio_promocion;
                    $item['nombre'] = $product->nombre;
                    $item['imagen'] = $product->imagen_principal;
                    $item['categoria'] = $product->category?->nombre;
                }
            }
            return $item;
        });

        session(['cart' => $cart->values()->all()]);

        if ($request->wantsJson()) {
            return response()->json($this->cartSummary());
        }

        return redirect()->back()->with('success', 'Cantidad actualizada.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $cart = collect(session('cart', []))
            ->reject(fn ($item) => $item['product_id'] == $request->integer('product_id'))
            ->values();

        session(['cart' => $cart->all()]);

        if ($request->wantsJson()) {
            return response()->json($this->cartSummary());
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    protected function cartSummary(): array
    {
        $cart = collect(session('cart', []));
        $productIds = $cart->pluck('product_id')->all();
        $products = Product::query()->whereIn('id', $productIds)->get()->keyBy('id');

        $items = $cart->map(function ($item) use ($products) {
            $product = $products[$item['product_id']] ?? null;
            $price = $item['precio_promocion'] ?? $item['precio'] ?? $product?->precio_promocion ?? $product?->precio ?? 0;

            return [
                'product_id' => $item['product_id'],
                'nombre' => $item['nombre'] ?? $product?->nombre ?? 'Producto',
                'quantity' => $item['quantity'],
                'precio' => $product?->precio,
                'precio_promocion' => $product?->precio_promocion ?? $item['precio_promocion'] ?? null,
                'imagen' => $item['imagen'] ?? $product?->imagen_principal,
                'categoria' => $item['categoria'] ?? $product?->category?->nombre,
                'subtotal' => $price * $item['quantity'],
            ];
        })->values();

        $total = $items->sum('subtotal');

        return [$items, $total];
    }
}
