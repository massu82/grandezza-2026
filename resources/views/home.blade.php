<x-layout-public title="Grandezza | Tiempo del Vino">
    @php
        $promotionCount = max(1, count($promotions ?? []));
        $featuredCount = max(1, count($featuredProducts ?? []));
        $promoCount = max(1, count($promoProducts ?? []));
        $categoryCount = max(1, count($featuredCategories ?? []));
    @endphp
    <section class="relative bg-gradient-to-b from-zinc-900 via-zinc-950 to-zinc-900 text-white m-0 p-0">
        <div class="absolute inset-0 opacity-70 bg-[radial-gradient(circle_at_20%_20%,rgba(113,113,122,0.22),transparent_40%),radial-gradient(circle_at_80%_30%,rgba(63,63,70,0.26),transparent_40%)] pointer-events-none"></div>
        <div
            class="relative"
            x-data="carousel({
                length: {{ $promotionCount }},
                autoplay: 5000,
                loop: true,
                perView: { 0: 1 },
                gap: 16,
            })"
        >
            <div class="overflow-hidden">
                <div
                    class="flex transition-transform duration-500 ease-out"
                    :style="trackStyle()"
                    @mouseenter="stopAutoplay"
                    @mouseleave="startAutoplay"
                >
                    @forelse($promotions ?? [] as $promotion)
                        <div class="shrink-0" :style="slideStyle()">
                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid md:grid-cols-2 gap-8 items-center">
                                <div class="space-y-4">
                                    <p class="text-xs uppercase tracking-[0.2em] text-accent">Promoción</p>
                                    <h1 class="text-3xl md:text-4xl font-semibold text-white leading-tight" style="font-family: 'Playfair Display', serif;">{{ $promotion->titulo }}</h1>
                                    <p class="text-base text-zinc-200">{{ $promotion->descripcion }}</p>
                                    <a href="{{ url('/promociones') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-zinc-600 via-zinc-700 to-zinc-900 text-white text-sm font-semibold hover:from-zinc-700 hover:to-zinc-700 transition focus:outline-none focus:ring-2 focus:ring-zinc-300 focus:ring-offset-2 focus:ring-offset-zinc-900">
                                        Ver vinos en promoción
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                                <div class="w-full h-64 md:h-80 overflow-hidden shadow-lg">
                                    <img loading="lazy" src="{{ $promotion->banner ?? 'https://images.unsplash.com/photo-1514369118554-e20d93546b30?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $promotion->titulo }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="shrink-0" :style="slideStyle()">
                            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center text-white">
                                <h1 class="text-3xl font-semibold" style="font-family: 'Playfair Display', serif;">Descubre nuestra selección de vinos</h1>
                                <p class="text-zinc-200 mt-3">Próximamente verás aquí nuestras mejores promociones.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="absolute inset-y-0 left-3 flex items-center">
                <button type="button" class="slider-nav slider-nav-dark" @click="prev" aria-label="Anterior">‹</button>
            </div>
            <div class="absolute inset-y-0 right-3 flex items-center">
                <button type="button" class="slider-nav slider-nav-dark" @click="next" aria-label="Siguiente">›</button>
            </div>
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2">
                <template x-for="index in positions()" :key="`hero-dot-${index}`">
                    <button
                        type="button"
                        class="slider-dot slider-dot-dark"
                        :class="{ 'slider-dot-active': isActive(index - 1) }"
                        @click="goTo(index - 1)"
                        :aria-label="`Ir al slide ${index}`"
                    ></button>
                </template>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-6" x-data="sectionTitle({ kicker: 'Selección', title: 'Vinos destacados', ctaUrl: '{{ url('/vinos') }}', ctaLabel: 'Ver todos' })">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-secondary" x-text="kicker"></p>
                <h2 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;" x-text="title"></h2>
            </div>
            <a :href="ctaUrl" class="text-sm font-semibold text-primary hover:text-secondary" x-text="ctaLabel"></a>
        </div>
        <div
            class="relative"
            x-data="carousel({
                length: {{ $featuredCount }},
                perView: { 0: 1.1, 640: 2, 1024: 4 },
                gap: 16,
            })"
        >
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-out" :style="trackStyle()">
                    @forelse($featuredProducts ?? [] as $product)
                        <div class="shrink-0 pb-6 h-full" :style="slideStyle()">
                            <x-product-card :product="$product" />
                        </div>
                    @empty
                        <div class="shrink-0" :style="slideStyle()">
                            <p class="text-zinc-500 text-sm">No hay productos disponibles aún.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="flex items-center justify-between mt-4">
                <div class="flex items-center gap-2">
                    <template x-for="index in positions()" :key="`featured-dot-${index}`">
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

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="flex items-center justify-between mb-6" x-data="sectionTitle({ kicker: 'Promociones', title: 'Vinos en promoción', ctaUrl: '{{ url('/promociones') }}', ctaLabel: 'Ver todos' })">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-secondary" x-text="kicker"></p>
                <h2 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;" x-text="title"></h2>
            </div>
            <a :href="ctaUrl" class="text-sm font-semibold text-primary hover:text-secondary" x-text="ctaLabel"></a>
        </div>
        <div
            class="relative"
            x-data="carousel({
                length: {{ $promoCount }},
                perView: { 0: 1.1, 640: 2, 1024: 4 },
                gap: 16,
            })"
        >
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-out" :style="trackStyle()">
                    @forelse($promoProducts ?? [] as $product)
                        <div class="shrink-0 pb-6 h-full" :style="slideStyle()">
                            <x-product-card :product="$product" />
                        </div>
                    @empty
                        <div class="shrink-0" :style="slideStyle()">
                            <p class="text-zinc-500 text-sm">No hay productos en promoción en este momento.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="flex items-center justify-between mt-4">
                <div class="flex items-center gap-2">
                    <template x-for="index in positions()" :key="`promo-dot-${index}`">
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

    <section class="w-full bg-gradient-to-b from-zinc-900 via-zinc-950 to-zinc-900 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between mb-6" x-data="sectionTitle({ kicker: 'Explorar', title: 'Categorías destacadas', ctaUrl: '{{ url('/categorias') }}', ctaLabel: 'Ver todas' })">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-accent" x-text="kicker"></p>
                <h2 class="text-2xl font-semibold text-white" style="font-family: 'Playfair Display', serif;" x-text="title"></h2>
            </div>
            <a :href="ctaUrl" class="text-sm font-semibold text-white hover:text-accent" x-text="ctaLabel"></a>
        </div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="relative"
                x-data="carousel({
                    length: {{ $categoryCount }},
                    perView: { 0: 1.1, 640: 2, 1024: 4 },
                    gap: 16,
                })"
            >
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-out" :style="trackStyle()">
                        @forelse($featuredCategories ?? [] as $category)
                            <div class="shrink-0 pb-4" :style="slideStyle()">
                                <a href="{{ url('/categorias/'.$category->slug) }}" class="block bg-zinc-800 border border-zinc-700 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                                    @php
                                        $base = $category->imagen ?? null;
                                        $isExternal = $base && str_starts_with($base, 'http');
                                        $isLocalAsset = $base && str_starts_with($base, 'img/');
                                        $useStorageThumb = $base && !$isExternal && !$isLocalAsset;
                                        $baseName = $useStorageThumb ? pathinfo($base, PATHINFO_FILENAME) : null;
                                        $thumbWebp = $useStorageThumb ? asset('storage/categories/thumb/'.$baseName.'.webp') : null;
                                        $thumbJpg = $useStorageThumb ? asset('storage/categories/thumb/'.$baseName.'.jpg') : null;
                                        $fallback = $isExternal
                                            ? $base
                                            : ($isLocalAsset ? asset($base) : 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?auto=format&fit=crop&w=1200&q=80');
                                    @endphp
                                    <div class="h-32 w-full overflow-hidden">
                                        <picture>
                                            @if($thumbWebp)
                                                <source srcset="{{ $thumbWebp }}" type="image/webp">
                                            @endif
                                            @if($thumbJpg)
                                                <source srcset="{{ $thumbJpg }}" type="image/jpeg">
                                            @endif
                                            <img loading="lazy" src="{{ $thumbJpg ?? $thumbWebp ?? $fallback }}" alt="{{ $category->nombre }}" class="w-full h-full object-cover">
                                        </picture>
                                    </div>
                                    <div class="p-4">
                                        <p class="text-xs uppercase tracking-wide text-accent">Categoría</p>
                                        <h3 class="text-lg font-semibold text-white" style="font-family: 'Playfair Display', serif;">{{ $category->nombre }}</h3>
                                        <p class="text-sm text-zinc-300 mt-1">{{ \Illuminate\Support\Str::limit($category->descripcion, 90) }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="shrink-0" :style="slideStyle()">
                                <p class="text-zinc-300 text-sm">No hay categorías destacadas.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center gap-2">
                        <template x-for="index in positions()" :key="`categories-dot-${index}`">
                            <button
                                type="button"
                                class="slider-dot"
                                :class="{ 'slider-dot-active': isActive(index - 1) }"
                                @click="goTo(index - 1)"
                                :aria-label="`Ir al slide ${index}`"
                            ></button>
                        </template>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="slider-nav slider-nav-dark" @click="prev" aria-label="Anterior">‹</button>
                        <button type="button" class="slider-nav slider-nav-dark" @click="next" aria-label="Siguiente">›</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-concierge-cta />
</x-layout-public>
