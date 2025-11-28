<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }

    public function index(Request $request)
    {
        $pages = Page::query()->orderBy('titulo')->paginate(15)->withQueryString();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $page = new Page();
        return view('admin.pages.create', compact('page'));
    }

    public function store(PageRequest $request)
    {
        Page::create($request->validated());

        return redirect('/admin/pages')->with('success', 'Página creada.');
    }

    public function show(Page $page)
    {
        return redirect('/admin/pages/'.$page->id.'/edit');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->validated());

        return redirect('/admin/pages')->with('success', 'Página actualizada.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->back()->with('success', 'Página eliminada.');
    }
}
