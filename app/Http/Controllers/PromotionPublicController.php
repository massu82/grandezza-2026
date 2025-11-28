<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;

class PromotionPublicController extends Controller
{
    public function index()
    {
        $promotions = Promotion::where('activo', true)->orderByDesc('fecha_inicio')->paginate(10);
        $products = Product::query()
            ->whereNotNull('precio_promocion')
            ->where('estado', 1)
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('promotions.index', compact('promotions', 'products'));
    }
}
