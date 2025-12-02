<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Models\Promotion;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }

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
        $data = $request->validated();
        $bannerOptions = [
            'large' => ['mode' => 'cover', 'width' => 1600, 'height' => 500],
            'thumb' => ['mode' => 'cover', 'width' => 800, 'height' => 250],
        ];
        if ($request->hasFile('banner')) {
            $data['banner'] = $this->imageService->process($request->file('banner'), 'promotions', $bannerOptions);
        }

        Promotion::create($data);

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
        $data = $request->validated();
        $bannerOptions = [
            'large' => ['mode' => 'cover', 'width' => 1600, 'height' => 500],
            'thumb' => ['mode' => 'cover', 'width' => 800, 'height' => 250],
        ];
        if ($request->hasFile('banner')) {
            if ($promotion->banner) {
                $this->imageService->delete($promotion->banner, 'promotions');
            }
            $data['banner'] = $this->imageService->process($request->file('banner'), 'promotions', $bannerOptions);
        }

        $promotion->update($data);

        return redirect('/admin/promotions')->with('success', 'Promoción actualizada.');
    }

    public function destroy(Promotion $promotion)
    {
        if ($promotion->banner) {
            $this->imageService->delete($promotion->banner, 'promotions');
        }
        $promotion->delete();

        return redirect()->back()->with('success', 'Promoción eliminada.');
    }
}
