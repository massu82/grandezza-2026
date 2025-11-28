<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $query = Promotion::query();

        if ($request->filled('q')) {
            $query->where('titulo', 'like', '%'.$request->q.'%');
        }

        $promotions = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $promotion = new Promotion();
        return view('admin.promotions.create', compact('promotion'));
    }

    public function store(PromotionRequest $request)
    {
        Promotion::create($request->validated());

        return redirect('/admin/promotions')->with('success', 'Promoción creada.');
    }

    public function show(Promotion $promotion)
    {
        $promotion->load('products');
        return view('admin.promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(PromotionRequest $request, Promotion $promotion)
    {
        $promotion->update($request->validated());

        return redirect('/admin/promotions')->with('success', 'Promoción actualizada.');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->back()->with('success', 'Promoción eliminada.');
    }
}
