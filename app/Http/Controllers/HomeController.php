<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $promotions = Promotion::query()
            ->where('activo', true)
            ->orderByDesc('fecha_inicio')
            ->take(5)
            ->get();

        $featuredProducts = Product::query()
            ->where('estado', 1)
            ->where(function ($q) {
                $q->where('destacado', true)
                    ->orWhereNotNull('precio_promocion');
            })
            ->with('category')
            ->orderByDesc('created_at')
            ->take(16)
            ->get();

        $promoProducts = Product::query()
            ->where('estado', 1)
            ->whereNotNull('precio_promocion')
            ->with('category')
            ->orderByDesc('updated_at')
            ->take(16)
            ->get();

        $featuredCategories = Category::query()
            ->orderBy('nombre')
            ->take(5)
            ->get();

        return view('home', [
            'promotions' => $promotions,
            'featuredProducts' => $featuredProducts,
            'promoProducts' => $promoProducts,
            'featuredCategories' => $featuredCategories,
        ]);
    }
}
