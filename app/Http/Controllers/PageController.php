<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        // Priorizar vistas estáticas para ciertos slugs
        $staticViews = [
            'nosotros' => 'pages.nosotros',
            'contacto' => 'pages.contacto',
            'terminos' => 'pages.terminos',
            'privacidad' => 'pages.privacidad',
            'bolsa' => 'pages.bolsa',
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
