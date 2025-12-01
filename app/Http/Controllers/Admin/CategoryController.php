<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }

    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('q')) {
            $query->where('nombre', 'like', '%'.$request->q.'%');
        }

        $categories = $query->orderBy('nombre')->paginate(15)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $category = new Category();
        return view('admin.categories.create', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        if (!$request->hasFile('imagen')) {
            unset($data['imagen']);
        }
        $slugSource = $request->filled('slug') ? $request->slug : $request->nombre;
        $data['slug'] = Str::slug((string) $slugSource);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $this->imageService->process($request->file('imagen'), 'categories');
        }

        Category::create($data);

        return redirect('/admin/categories')->with('success', 'Categoría creada.');
    }

    public function show(Category $category)
    {
        return redirect('/admin/categories/'.$category->id.'/edit');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        if (!$request->hasFile('imagen')) {
            unset($data['imagen']);
        }
        $slugSource = $request->filled('slug') ? $request->slug : $request->nombre;
        $data['slug'] = Str::slug((string) $slugSource);

        if ($request->hasFile('imagen')) {
            $this->deleteImageIfLocal($category->imagen);
            $data['imagen'] = $this->imageService->process($request->file('imagen'), 'categories');
        }

        $category->update($data);

        return redirect('/admin/categories')->with('success', 'Categoría actualizada.');
    }

    public function destroy(Category $category)
    {
        $this->deleteImageIfLocal($category->imagen);
        $category->delete();

        return redirect()->back()->with('success', 'Categoría eliminada.');
    }

    protected function deleteImageIfLocal(?string $image): void
    {
        if (!$image) {
            return;
        }

        if (str_starts_with($image, 'http') || str_starts_with($image, 'img/')) {
            return;
        }

        $basename = pathinfo($image, PATHINFO_FILENAME) ?: $image;
        $this->imageService->delete($basename, 'categories');
    }
}
