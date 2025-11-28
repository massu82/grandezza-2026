<x-layout-public :title="$product->nombre ?? 'Vino'" :meta-description="$product->descripcion_corta ?? ''">
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
            <div>
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
                <div class="swiper productSwiper rounded-2xl overflow-hidden shadow">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <picture>
                                @if($largeWebp)<source srcset="{{ $largeWebp }}" type="image/webp">@endif
                                @if($largeJpg)<source srcset="{{ $largeJpg }}" type="image/jpeg">@endif
                                <img loading="lazy" src="{{ $largeJpg ?? $fallbackImg }}" alt="{{ $product->nombre }}" class="w-full h-96 object-cover">
                            </picture>
                        </div>
                        @foreach(($product->galeria ?? []) as $imagen)
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{ $imagen }}" alt="{{ $product->nombre }}" class="w-full h-96 object-cover">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                @if(($product->galeria ?? []) && count($product->galeria))
                    <div class="swiper productThumbs mt-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide cursor-pointer">
                                <picture>
                                    @if($baseName && !$isExternal && !$isLocalAsset)
                                        <source srcset="{{ asset('storage/products/thumb/'.$baseName.'.webp') }}" type="image/webp">
                                        <source srcset="{{ asset('storage/products/thumb/'.$baseName.'.jpg') }}" type="image/jpeg">
                                    @endif
                                    <img loading="lazy" src="{{ $baseName && !$isExternal && !$isLocalAsset ? asset('storage/products/thumb/'.$baseName.'.jpg') : $fallbackImg }}" alt="{{ $product->nombre }}" class="w-full h-20 object-cover rounded-lg border border-slate-200">
                                </picture>
                            </div>
                            @foreach($product->galeria as $imagen)
                                <div class="swiper-slide cursor-pointer">
                                    <img loading="lazy" src="{{ $imagen }}" alt="{{ $product->nombre }}" class="w-full h-20 object-cover rounded-lg border border-slate-200">
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
                    <div class="flex items-center gap-2 text-slate-600 text-sm ml-auto">
                        <span>Compartir:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Compartir en Facebook" class="p-1 rounded hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M13.5 9H16V6h-2.5a3.5 3.5 0 0 0-3.5 3.5V12H8v3h2v6h3v-6h2.1l.4-3H13V9.5c0-.3.2-.5.5-.5Z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->nombre) }}" target="_blank" rel="noopener" aria-label="Compartir en X" class="p-1 rounded hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M5 4h3l4 5.5L16.5 4H19l-5.4 7.3L19 20h-3l-4.4-5.8L7.3 20H5l5.6-7.5L5 4Z"/>
                            </svg>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($product->nombre.' '.url()->current()) }}" target="_blank" rel="noopener" aria-label="Compartir en WhatsApp" class="p-1 rounded hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4.5 20.3 5.3 17a7.8 7.8 0 1 1 3 2.2l-3.8 1.1ZM9 8.5c-.1-.3-.3-.3-.5-.3h-.4c-.1 0-.3 0-.4.2-.1.2-.5.5-.5 1.2s.5 1.4.6 1.5c.1.2 1.1 1.8 2.7 2.4 1.3.5 1.5.4 1.8.4.3 0 .9-.3 1-0.7.1-.4.4-.7.4-.7.1-.1.1-.2 0-.3l-.5-.3c-.1-.1-.3-.1-.4 0-.2.1-.6.3-.7.3-.2 0-.3 0-.5-.2-.2-.2-.5-.7-.5-.7-.1-.1 0-.2 0-.3l.2-.3c.1-.1.1-.2.2-.3l.1-.2c.1-.1.1-.2 0-.3l-.4-.9c-.1-.2-.2-.2-.3-.2h-.3c-.1 0-.3 0-.4.1l-.3.2c-.2.2-.6.6-.6 1.2 0 .7.6 1.3.7 1.4Z"/>
                            </svg>
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
            <div class="swiper relatedProducts">
                    <div class="swiper-wrapper">
                        @foreach($related as $item)
                            <div class="swiper-slide pb-6 h-full">
                                <x-product-card :product="$item" />
                            </div>
                        @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
    @endif

    <x-concierge-cta />

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let thumbs;
                if (document.querySelector('.productThumbs')) {
                    thumbs = new Swiper('.productThumbs', {
                        slidesPerView: 4,
                        spaceBetween: 8,
                        watchSlidesProgress: true,
                        breakpoints: {
                            640: { slidesPerView: 5, spaceBetween: 10 },
                        },
                    });
                }

                new Swiper('.productSwiper', {
                    loop: true,
                    pagination: { el: '.productSwiper .swiper-pagination', clickable: true },
                    slidesPerView: 1,
                    thumbs: thumbs ? { swiper: thumbs } : {},
                });

                new Swiper('.relatedProducts', {
                    spaceBetween: 16,
                    slidesPerView: 1.1,
                    breakpoints: {
                        640: { slidesPerView: 2, spaceBetween: 16 },
                        1024: { slidesPerView: 4, spaceBetween: 20 },
                    },
                    pagination: { el: '.relatedProducts .swiper-pagination', clickable: true },
                    navigation: { nextEl: '.relatedProducts .swiper-button-next', prevEl: '.relatedProducts .swiper-button-prev' },
                });
            });
        </script>
    @endpush
</x-layout-public>
