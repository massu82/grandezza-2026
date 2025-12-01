@php
    $pageTitle = ($product->nombre ?? 'Vino').' | Grandezza';
@endphp
<x-layout-public :title="$pageTitle" :meta-description="$product->descripcion_corta ?? ''">
    <section class="w-full bg-gradient-to-b from-zinc-900 via-zinc-950 to-zinc-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-semibold text-white" style="font-family: 'Playfair Display', serif;">{{ $product->nombre }}</h1>
            <p class="text-sm text-zinc-200 mt-1">{{ $product->category->nombre ?? 'Vino' }}</p>
        </div>
    </section>
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <nav class="text-xs text-slate-500 mb-4">
            <a href="{{ url('/') }}" class="hover:text-primary">Home</a>
            <span class="mx-2">/</span>
            @if($product->category ?? false)
                <a href="{{ url('/categorias/'.$product->category->slug) }}" class="hover:text-primary">{{ $product->category->nombre }}</a>
                <span class="mx-2">/</span>
            @endif
            <span class="text-primary">{{ $product->nombre }}</span>
        </nav>

        <div class="grid md:grid-cols-2 gap-8">
            <div
                x-data="gallery({
                    length: {{ 1 + count($product->galeria ?? []) }},
                    thumbBreakpoints: { 0: 4, 640: 5 },
                    gap: 10,
                })"
                class="space-y-3"
            >
                @php
                    $imgBase = $product->imagen_principal ?? null;
                    $isExternal = $imgBase && str_starts_with($imgBase, 'http');
                    $isLocalAsset = $imgBase && str_starts_with($imgBase, 'img/');
                    $useStorageThumbs = $imgBase && !$isExternal && !$isLocalAsset;
                    $baseName = $useStorageThumbs ? pathinfo($imgBase, PATHINFO_FILENAME) : null;
                    $largeWebp = $useStorageThumbs ? asset('storage/products/large/'.$baseName.'.webp') : null;
                    $largeJpg = $useStorageThumbs ? asset('storage/products/large/'.$baseName.'.jpg') : null;
                    $fallbackImg = $isExternal ? $imgBase : ($isLocalAsset ? asset($imgBase) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1100&q=80');
                @endphp
                <div class="relative rounded-2xl overflow-hidden shadow">
                    <div class="overflow-hidden">
                        <div class="flex transition-transform duration-500 ease-out" :style="mainTrackStyle()">
                            <div class="w-full shrink-0">
                                <picture>
                                    @if($largeWebp)<source srcset="{{ $largeWebp }}" type="image/webp">@endif
                                    @if($largeJpg)<source srcset="{{ $largeJpg }}" type="image/jpeg">@endif
                                    <img loading="lazy" src="{{ $largeJpg ?? $fallbackImg }}" alt="{{ $product->nombre }}" class="w-full h-96 object-cover">
                                </picture>
                            </div>
                            @foreach(($product->galeria ?? []) as $imagen)
                                <div class="w-full shrink-0">
                                    <img loading="lazy" src="{{ $imagen }}" alt="{{ $product->nombre }}" class="w-full h-96 object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="absolute inset-y-0 left-3 flex items-center">
                        <button type="button" class="slider-nav" @click="prev" aria-label="Imagen anterior">‹</button>
                    </div>
                    <div class="absolute inset-y-0 right-3 flex items-center">
                        <button type="button" class="slider-nav" @click="next" aria-label="Imagen siguiente">›</button>
                    </div>
                    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex items-center gap-2">
                        <template x-for="index in {{ 1 + count($product->galeria ?? []) }}" :key="`gallery-dot-${index}`">
                            <button
                                type="button"
                                class="slider-dot slider-dot-dark"
                                :class="{ 'slider-dot-active': isActive(index - 1) }"
                                @click="goTo(index - 1)"
                                :aria-label="`Ir a la imagen ${index}`"
                            ></button>
                        </template>
                    </div>
                </div>
                @if(($product->galeria ?? []) && count($product->galeria))
                    <div class="relative overflow-hidden">
                        <div class="flex transition-transform duration-300 ease-out" :style="thumbTrackStyle()">
                            <div class="shrink-0" :style="thumbSlideStyle()">
                                <button
                                    type="button"
                                    class="w-full block overflow-hidden rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-accent"
                                    :class="{ 'ring-2 ring-accent border-transparent': isActive(0) }"
                                    @click="goTo(0)"
                                >
                                    <picture>
                                        @if($baseName && !$isExternal && !$isLocalAsset)
                                            <source srcset="{{ asset('storage/products/thumb/'.$baseName.'.webp') }}" type="image/webp">
                                            <source srcset="{{ asset('storage/products/thumb/'.$baseName.'.jpg') }}" type="image/jpeg">
                                        @endif
                                        <img loading="lazy" src="{{ $baseName && !$isExternal && !$isLocalAsset ? asset('storage/products/thumb/'.$baseName.'.jpg') : $fallbackImg }}" alt="{{ $product->nombre }}" class="w-full h-20 object-cover">
                                    </picture>
                                </button>
                            </div>
                            @foreach($product->galeria as $imagen)
                                <div class="shrink-0" :style="thumbSlideStyle()">
                                    <button
                                        type="button"
                                        class="w-full block overflow-hidden rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-accent"
                                        :class="{ 'ring-2 ring-accent border-transparent': isActive({{ $loop->iteration }}) }"
                                        @click="goTo({{ $loop->iteration }})"
                                    >
                                        <img loading="lazy" src="{{ $imagen }}" alt="{{ $product->nombre }}" class="w-full h-20 object-cover">
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="space-y-4">
                <h1 class="text-3xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">{{ $product->nombre }}</h1>
                <p class="text-sm text-slate-600">{{ $product->descripcion_corta }}</p>
                <div class="flex flex-wrap gap-3 text-sm text-slate-600">
                    @if($product->presentation)<span class="px-3 py-1 bg-slate-100 rounded-full">{{ $product->presentation }}</span>@endif
                    @if($product->tipo)<span class="px-3 py-1 bg-light text-primary rounded-full">{{ $product->tipo }}</span>@endif
                    @if($product->pais)<span class="px-3 py-1 bg-slate-100 rounded-full">{{ $product->pais }}</span>@endif
                    @if($product->uva)<span class="px-3 py-1 bg-slate-100 rounded-full">{{ $product->uva }}</span>@endif
                    @if($product->anada)<span class="px-3 py-1 bg-slate-100 rounded-full">Año {{ $product->anada }}</span>@endif
                </div>
                <div class="flex items-center gap-3">
                    @if($product->precio_promocion)
                        <span class="text-3xl font-semibold text-primary">${{ number_format($product->precio_promocion, 2) }}</span>
                        <span class="text-lg text-slate-400 line-through">${{ number_format($product->precio, 2) }}</span>
                    @else
                        <span class="text-3xl font-semibold text-primary">${{ number_format($product->precio, 2) }}</span>
                    @endif
                </div>
                <div class="prose max-w-none text-slate-700">
                    {!! nl2br(e($product->descripcion_larga)) !!}
                </div>
                <div class="flex items-center gap-3">
                    <form method="POST" action="{{ url('/carrito/agregar') }}" data-cart-form>
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <x-button-primary
                            data-gtm-event="add_to_cart"
                            data-gtm-product-id="{{ $product->id }}"
                            data-gtm-product-name="{{ $product->nombre }}"
                            data-meta-event="AddToCart"
                        >
                            Agregar al carrito
                        </x-button-primary>
                    </form>
                    <button class="text-sm text-primary underline" data-gtm-event="view_item" data-gtm-product-id="{{ $product->id }}">Ver detalles</button>
                    <div class="flex items-center gap-2 text-zinc-600 text-sm ml-auto">
                        <span>Compartir:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Compartir en Facebook" class="p-1 rounded hover:text-primary">
                            <x-social-icon name="facebook" class="w-5 h-5" />
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->nombre) }}" target="_blank" rel="noopener" aria-label="Compartir en X" class="p-1 rounded hover:text-primary">
                            <x-social-icon name="x" class="w-5 h-5" />
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($product->nombre.' '.url()->current()) }}" target="_blank" rel="noopener" aria-label="Compartir en WhatsApp" class="p-1 rounded hover:text-primary" data-gtm-event="share_whatsapp" data-meta-event="Contact">
                            <x-social-icon name="whatsapp" class="w-5 h-5" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(($related ?? null) && $related->isNotEmpty())
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-secondary">Te puede interesar</p>
                    <h2 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">Vinos relacionados</h2>
                </div>
                <a href="{{ url('/vinos') }}" class="text-sm font-semibold text-primary hover:text-secondary">Ver todos</a>
            </div>
            <div
                class="relative"
                x-data="carousel({
                    length: {{ max(1, ($related ?? collect())->count()) }},
                    perView: { 0: 1.1, 640: 2, 1024: 4 },
                    gap: 16,
                })"
            >
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-out" :style="trackStyle()">
                        @foreach($related as $item)
                            <div class="shrink-0 pb-6 h-full" :style="slideStyle()">
                                <x-product-card :product="$item" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center gap-2">
                        <template x-for="index in positions()" :key="`related-dot-${index}`">
                            <button
                                type="button"
                                class="slider-dot slider-dot-dark"
                                :class="{ 'slider-dot-active': isActive(index - 1) }"
                                @click="goTo(index - 1)"
                                :aria-label="`Ir al slide ${index}`"
                            ></button>
                        </template>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="slider-nav" @click="prev" aria-label="Anterior">‹</button>
                        <button type="button" class="slider-nav" @click="next" aria-label="Siguiente">›</button>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <x-concierge-cta />
</x-layout-public>
