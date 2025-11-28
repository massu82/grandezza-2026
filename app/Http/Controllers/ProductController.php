<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('estado', 1)->with('category');

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->string('tipo'));
        }

        if ($request->filled('pais')) {
            $query->where('pais', $request->string('pais'));
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->integer('categoria'));
        }

        if ($request->string('orden') === 'precio_asc') {
            $query->orderBy('precio');
        } elseif ($request->string('orden') === 'precio_desc') {
            $query->orderByDesc('precio');
        } else {
            $query->orderByDesc('created_at');
        }

        $products = $query->paginate(12)->withQueryString();

        $tipos = Product::query()->select('tipo')->distinct()->pluck('tipo', 'tipo')->toArray();
        $paises = Product::query()->select('pais')->whereNotNull('pais')->distinct()->pluck('pais', 'pais')->toArray();
        $categorias = Product::query()->with('category')->get()->pluck('category.nombre', 'categoria_id')->filter()->toArray();

        return view('products.index', [
            'products' => $products,
            'tipos' => $tipos,
            'paises' => $paises,
            'categorias' => $categorias,
        ]);
    }

    public function show(string $categoria, string $slug)
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->whereHas('category', function ($query) use ($categoria) {
                $query->where('slug', $categoria);
            })
            ->with('category')
            ->firstOrFail();

        $related = Product::query()
            ->where('estado', 1)
            ->where('id', '!=', $product->id)
            ->where('categoria_id', $product->categoria_id)
            ->with('category')
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('products.show', [
            'product' => $product,
            'related' => $related,
        ]);
    }
}
