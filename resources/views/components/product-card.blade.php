@props(['product'])

@php
    $hasPromo = $product->precio_promocion && $product->precio_promocion > 0;
@endphp

@php
    $base = $product->imagen_principal ?? null;
    $isUrl = $base && str_starts_with($base, 'http');
    $thumbWebp = $base && !$isUrl ? asset('storage/products/thumb/'.$base.'.webp') : null;
    $thumbJpg = $base && !$isUrl ? asset('storage/products/thumb/'.$base.'.jpg') : null;
    $fallback = $isUrl ? $base : 'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=800&q=80';
@endphp

<div class="group bg-white border border-slate-100 rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col h-full">
    <div class="relative">
        <picture>
            @if($thumbWebp)
                <source srcset="{{ $thumbWebp }}" type="image/webp">
            @endif
            @if($thumbJpg)
                <source srcset="{{ $thumbJpg }}" type="image/jpeg">
            @endif
            <img loading="lazy" src="{{ $thumbJpg ?? $fallback }}" alt="{{ $product->nombre }}" class="w-full h-56 object-cover">
        </picture>
        <div class="absolute top-3 left-3 flex gap-2">
            @if($hasPromo)
                <span class="text-xs px-2 py-1 bg-rose-900 text-white rounded-full">Promoción</span>
            @endif
            @if($product->destacado ?? false)
                <span class="text-xs px-2 py-1 bg-amber-500 text-white rounded-full">Destacado</span>
            @endif
            @if($product->created_at && $product->created_at->gt(now()->subDays(14)))
                <span class="text-xs px-2 py-1 bg-emerald-600 text-white rounded-full">Nuevo</span>
            @endif
        </div>
    </div>
    <div class="p-4 flex-1 flex flex-col">
        <div class="text-xs uppercase tracking-wide text-slate-500 mb-1">{{ $product->category->nombre ?? $product->tipo ?? 'Vino' }}</div>
        <h3 class="text-lg font-semibold text-rose-950 group-hover:text-rose-800 transition" style="font-family: 'Playfair Display', serif;">
            <a href="{{ url('/vinos/'.$product->slug) }}">{{ $product->nombre }}</a>
        </h3>
        <p class="text-sm text-slate-500 mt-1 flex-1 min-h-[48px]">{{ \Illuminate\Support\Str::limit($product->descripcion_corta, 80) }}</p>
        <div class="mt-4 min-h-[36px]">
            <div class="flex items-center gap-2">
                @if($hasPromo)
                    <span class="text-lg font-semibold text-rose-900">${{ number_format($product->precio_promocion, 2) }}</span>
                    <span class="text-sm text-slate-400 line-through">${{ number_format($product->precio, 2) }}</span>
                @else
                    <span class="text-lg font-semibold text-rose-900">${{ number_format($product->precio, 2) }}</span>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ url('/carrito/agregar') }}" class="mt-auto pt-4" data-cart-form>
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button
                class="w-full inline-flex items-center justify-center px-4 py-2 rounded-lg bg-rose-900 text-white text-sm font-medium hover:bg-rose-800 transition focus:outline-none focus:ring-2 focus:ring-rose-300"
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
