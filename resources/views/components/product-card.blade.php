@props(['product'])

@php
    $hasPromo = $product->precio_promocion && $product->precio_promocion > 0;
@endphp

@php
    $base = $product->imagen_principal ?? null;
    $isExternal = $base && str_starts_with($base, 'http');
    $isLocalAsset = $base && str_starts_with($base, 'img/');
    $useStorageThumb = $base && !$isExternal && !$isLocalAsset;
    $baseName = $useStorageThumb ? pathinfo($base, PATHINFO_FILENAME) : null;
    $thumbWebp = $useStorageThumb ? asset('storage/products/thumb/'.$baseName.'.webp') : null;
    $thumbJpg = $useStorageThumb ? asset('storage/products/thumb/'.$baseName.'.jpg') : null;
    $fallback = $isExternal
        ? $base
        : ($isLocalAsset ? asset($base) : 'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=800&q=80');
    $productUrl = ($product->category?->slug ?? false)
        ? route('products.show', ['categoria' => $product->category->slug, 'slug' => $product->slug])
        : route('products.show', ['categoria' => 'vinos', 'slug' => $product->slug]);
@endphp

@php
    $isFeatured = $product->destacado ?? false;
    $cardBg = $isFeatured ? 'bg-slate-900 text-white border-slate-700' : 'bg-white text-slate-900 border-slate-100';
    $tagBg = $isFeatured ? 'bg-accent text-slate-900' : 'bg-primary text-white';
    $priceColor = $isFeatured ? 'text-white' : 'text-primary';
@endphp

<div class="group {{ $cardBg }} rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col h-full min-h-[420px]">
    <div class="relative">
        <picture>
            @if($thumbWebp)
                <source srcset="{{ $thumbWebp }}" type="image/webp">
            @endif
            @if($thumbJpg)
                <source srcset="{{ $thumbJpg }}" type="image/jpeg">
            @endif
            <img loading="lazy" src="{{ $thumbJpg ?? $thumbWebp ?? $fallback }}" alt="{{ $product->nombre }}" class="w-full h-56 object-cover">
        </picture>
        <div class="absolute top-3 left-3 flex gap-2">
            @if($hasPromo)
                <span class="text-xs px-2 py-1 {{ $tagBg }} rounded-full">Promoción</span>
            @endif
            @if($product->destacado ?? false)
                <span class="text-xs px-2 py-1 bg-accent text-slate-900 rounded-full">Destacado</span>
            @endif
            @if($product->created_at && $product->created_at->gt(now()->subDays(14)))
                <span class="text-xs px-2 py-1 bg-emerald-600 text-white rounded-full">Nuevo</span>
            @endif
        </div>
    </div>
    <div class="p-4 flex-1 flex flex-col">
        <div class="text-xs uppercase tracking-wide text-slate-500 mb-1">{{ $product->category->nombre ?? $product->tipo ?? 'Vino' }}</div>
        <h3
            class="text-lg font-semibold {{ $isFeatured ? 'text-white group-hover:text-accent' : 'text-primary group-hover:text-secondary' }} transition leading-tight min-h-[52px] max-h-[52px] overflow-hidden"
            style="font-family: 'Playfair Display', serif; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"
        >
            <a href="{{ $productUrl }}">
                {{ $product->nombre }}@if($product->presentation) — {{ $product->presentation }}@endif
            </a>
        </h3>
        <p
            class="text-sm {{ $isFeatured ? 'text-slate-200' : 'text-slate-500' }} mt-1 flex-1 min-h-[66px] max-h-[66px] overflow-hidden"
            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
        >
            {{ \Illuminate\Support\Str::limit($product->descripcion_corta, 110) }}
        </p>
        <div class="mt-4 min-h-[44px] flex items-center">
            <div class="flex items-center gap-2">
                @if($hasPromo)
                    <span class="text-lg font-semibold {{ $priceColor }}">${{ number_format($product->precio_promocion, 2) }}</span>
                    <span class="text-sm {{ $isFeatured ? 'text-slate-400' : 'text-slate-400' }} line-through">${{ number_format($product->precio, 2) }}</span>
                @else
                    <span class="text-lg font-semibold {{ $priceColor }}">${{ number_format($product->precio, 2) }}</span>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ url('/carrito/agregar') }}" class="mt-auto pt-4 swiper-no-swiping" data-cart-form data-swiper-no-swiping="true">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button
                class="w-full justify-center font-medium px-4 py-2 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 {{ $isFeatured ? 'bg-accent text-secondary hover:bg-white hover:text-secondary focus:ring-offset-dark' : 'bg-gradient-to-r from-primary via-secondary to-primary text-white hover:from-secondary hover:to-primary focus:ring-offset-light' }}"
                data-gtm-event="add_to_cart"
                data-gtm-product-id="{{ $product->id }}"
                data-gtm-product-name="{{ $product->nombre }}"
                data-meta-event="AddToCart"
            >
                Agregar al carrito
            </button>
        </form>
    </div>
</div>
