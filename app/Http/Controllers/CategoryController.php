<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->orderBy('nombre')->paginate(12);

        return view('pages.categorias', [
            'categories' => $categories,
        ]);
    }

    public function show(string $slug)
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail();

        $products = Product::query()
            ->where('categoria_id', $category->id)
            ->where('estado', 1)
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('products.index', [
            'products' => $products,
            'tipos' => [],
            'paises' => [],
            'categorias' => [],
            'category' => $category,
        ]);
    }
}
