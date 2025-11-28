<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
        Category::create($request->validated());

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
        $category->update($request->validated());

        return redirect('/admin/categories')->with('success', 'Categoría actualizada.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Categoría eliminada.');
    }
}
