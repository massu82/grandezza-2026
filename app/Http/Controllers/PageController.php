<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Page;

class PageController extends Controller
{
    public function home()
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

    public function show(string $slug)
    {
        // Priorizar vistas estáticas para ciertos slugs
        $staticViews = [
            'nosotros' => 'pages.nosotros',
            'contacto' => 'pages.contacto',
            'terminos' => 'pages.terminos',
            'privacidad' => 'pages.privacidad',
            'bolsa' => 'pages.bolsa',
            'fest' => 'fest.index',
        ];

        if (isset($staticViews[$slug]) && view()->exists($staticViews[$slug])) {
            return view($staticViews[$slug]);
        }

        $page = Page::query()->where('slug', $slug)->first();

        if ($page && $page->publicado) {
            return view('pages.dynamic', ['page' => $page]);
        }

        abort(404);
    }
}
