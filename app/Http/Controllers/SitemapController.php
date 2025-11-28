<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'slug', 'categoria_id', 'updated_at')
            ->with('category:id,slug')
            ->get();
        $categories = Category::select('slug', 'updated_at')->get();
        $pages = Page::select('slug', 'updated_at')->where('publicado', true)->get();

        $content = view('pages.sitemap-xml', compact('products', 'categories', 'pages'));

        return new Response($content, 200, ['Content-Type' => 'application/xml']);
    }
}
