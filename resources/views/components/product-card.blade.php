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
    $cardBg = 'bg-white text-zinc-900 border-zinc-200';
    $tagBg = 'bg-accent text-zinc-900';
    $priceColor = 'text-zinc-900';
@endphp

<div
    class="group {{ $cardBg }} rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col h-full min-h-[420px]"
    x-data="productCard({ id: {{ $product->id }} })"
>
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
                <span class="flex items-center gap-1 text-xs text-accent">
                    <x-heroicon-s-tag class="w-4 h-4" /> <span class="sr-only">Promoción</span>
                </span>
            @endif
            @if($product->destacado ?? false)
                <span class="flex items-center gap-1 text-xs text-accent">
                    <x-heroicon-s-star class="w-4 h-4" /> <span class="sr-only">Destacado</span>
                </span>
            @endif
            @if($product->created_at && $product->created_at->gt(now()->subDays(14)))
                <span class="flex items-center gap-1 text-xs text-zinc-700">
                    <x-heroicon-s-sparkles class="w-4 h-4" /> <span class="sr-only">Nuevo</span>
                </span>
            @endif
        </div>
    </div>
    <div class="p-4 flex-1 flex flex-col">
        <div class="text-xs uppercase tracking-wide text-zinc-500 mb-1">{{ $product->category->nombre ?? $product->tipo ?? 'Vino' }}</div>
        <h3
            class="text-lg font-semibold text-zinc-900 group-hover:text-zinc-700 transition leading-tight min-h-[52px] max-h-[52px] overflow-hidden"
            style="font-family: 'Playfair Display', serif; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"
        >
            <a href="{{ $productUrl }}">
                {{ $product->nombre }}@if($product->presentation) — {{ $product->presentation }}@endif
            </a>
        </h3>
        <p
            class="text-sm text-zinc-500 mt-1 flex-1 min-h-[66px] max-h-[66px] overflow-hidden"
            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
        >
            {{ \Illuminate\Support\Str::limit($product->descripcion_corta, 110) }}
        </p>
        <div class="mt-4 min-h-[44px] flex items-center">
            <div class="flex items-center gap-2">
                @if($hasPromo)
                    <span class="text-lg font-semibold {{ $priceColor }}">${{ number_format($product->precio_promocion, 2) }}</span>
                    <span class="text-sm {{ $isFeatured ? 'text-zinc-400' : 'text-zinc-400' }} line-through">${{ number_format($product->precio, 2) }}</span>
                @else
                    <span class="text-lg font-semibold {{ $priceColor }}">${{ number_format($product->precio, 2) }}</span>
                @endif
            </div>
        </div>
        <form
            method="POST"
            action="{{ url('/carrito/agregar') }}"
            class="mt-auto pt-4"
            data-cart-form
            @submit="handleSubmit"
        >
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button
                class="w-full justify-center font-medium px-4 py-2 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-zinc-300 focus:ring-offset-2 {{ $isFeatured ? 'bg-zinc-700 text-white hover:bg-zinc-600 focus:ring-offset-dark' : 'bg-gradient-to-r from-zinc-600 via-zinc-700 to-zinc-900 text-white hover:from-zinc-700 hover:to-zinc-700 focus:ring-offset-light' }}"
                :class="{ 'opacity-70 pointer-events-none': isLoading }"
                :disabled="isLoading"
                data-gtm-event="add_to_cart"
                data-gtm-product-id="{{ $product->id }}"
                data-gtm-product-name="{{ $product->nombre }}"
                data-meta-event="AddToCart"
            >
                <span class="inline-flex items-center justify-center gap-2">
                    <x-heroicon-s-shopping-cart class="w-5 h-5" />
                    <span x-show="!isLoading && !added && !errored">Agregar al carrito</span>
                    <span x-show="isLoading">Agregando...</span>
                    <span x-show="added">Agregado ✓</span>
                    <span x-show="errored">Reintentar</span>
                </span>
            </button>
        </form>
    </div>
</div>
