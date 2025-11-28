{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc>{{ url('/vinos') }}</loc>
    </url>
    <url>
        <loc>{{ url('/categorias') }}</loc>
    </url>
    @foreach($products as $product)
        <url>
            <loc>{{ url('/vinos/'.$product->slug) }}</loc>
            <lastmod>{{ optional($product->updated_at)->toAtomString() }}</lastmod>
        </url>
    @endforeach
    @foreach($categories as $category)
        <url>
            <loc>{{ url('/categorias/'.$category->slug) }}</loc>
            <lastmod>{{ optional($category->updated_at)->toAtomString() }}</lastmod>
        </url>
    @endforeach
    @foreach($pages as $page)
        <url>
            <loc>{{ url('/'.$page->slug) }}</loc>
            <lastmod>{{ optional($page->updated_at)->toAtomString() }}</lastmod>
        </url>
    @endforeach
</urlset>
