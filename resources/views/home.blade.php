<x-layout-public title="Grandezza | Vinos premium">
    <section class="relative">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @forelse($promotions ?? [] as $promotion)
                    <div class="swiper-slide">
                        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid md:grid-cols-2 gap-8 items-center">
                            <div class="space-y-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-rose-700">Promoción</p>
                                <h1 class="text-3xl md:text-4xl font-semibold text-rose-950 leading-tight" style="font-family: 'Playfair Display', serif;">{{ $promotion->titulo }}</h1>
                                <p class="text-base text-slate-600">{{ $promotion->descripcion }}</p>
                                <a href="{{ url('/promociones') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-rose-900 text-white rounded-lg hover:bg-rose-800 transition">
                                    Ver vinos en promoción
                                    <span aria-hidden="true">→</span>
                                </a>
                            </div>
                            <div class="w-full h-64 md:h-80 rounded-2xl overflow-hidden shadow-lg">
                                <img loading="lazy" src="{{ $promotion->banner ?? 'https://images.unsplash.com/photo-1514369118554-e20d93546b30?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $promotion->titulo }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
                            <h1 class="text-3xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Descubre nuestra selección de vinos</h1>
                            <p class="text-slate-600 mt-3">Próximamente verás aquí nuestras mejores promociones.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-rose-700">Selección</p>
                <h2 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Vinos destacados</h2>
            </div>
            <a href="{{ url('/vinos') }}" class="text-sm font-semibold text-rose-900 hover:text-rose-700">Ver todos</a>
        </div>
        <div class="swiper featuredProducts">
            <div class="swiper-wrapper">
                @forelse($featuredProducts ?? [] as $product)
                    <div class="swiper-slide pb-6">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <p class="text-slate-500 text-sm">No hay productos disponibles aún.</p>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-rose-700">Explorar</p>
                <h2 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Categorías destacadas</h2>
            </div>
            <a href="{{ url('/categorias') }}" class="text-sm font-semibold text-rose-900 hover:text-rose-700">Ver todas</a>
        </div>
        <div class="swiper featuredCategories">
            <div class="swiper-wrapper">
                @forelse($featuredCategories ?? [] as $category)
                    <div class="swiper-slide pb-4">
                        <a href="{{ url('/categorias/'.$category->slug) }}" class="block bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                            <div class="h-32 w-full overflow-hidden">
                                <img loading="lazy" src="{{ $category->imagen ?? 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $category->nombre }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <p class="text-xs uppercase tracking-wide text-slate-500">Categoría</p>
                                <h3 class="text-lg font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">{{ $category->nombre }}</h3>
                                <p class="text-sm text-slate-600 mt-1">{{ \Illuminate\Support\Str::limit($category->descripcion, 90) }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm">No hay categorías destacadas.</p>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <x-concierge-cta />

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                new Swiper('.mySwiper', {
                    loop: true,
                    autoplay: { delay: 5000 },
                    pagination: { el: '.swiper-pagination', clickable: true },
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                    breakpoints: {
                        640: { slidesPerView: 1 },
                        1024: { slidesPerView: 1 },
                    },
                });

                new Swiper('.featuredProducts', {
                    spaceBetween: 16,
                    slidesPerView: 1.1,
                    breakpoints: {
                        640: { slidesPerView: 2, spaceBetween: 16 },
                        1024: { slidesPerView: 4, spaceBetween: 20 },
                    },
                    pagination: { el: '.featuredProducts .swiper-pagination', clickable: true },
                    navigation: { nextEl: '.featuredProducts .swiper-button-next', prevEl: '.featuredProducts .swiper-button-prev' },
                });

                new Swiper('.featuredCategories', {
                    spaceBetween: 16,
                    slidesPerView: 1.1,
                    breakpoints: {
                        640: { slidesPerView: 2, spaceBetween: 16 },
                        1024: { slidesPerView: 4, spaceBetween: 20 },
                    },
                    pagination: { el: '.featuredCategories .swiper-pagination', clickable: true },
                });
            });
        </script>
    @endpush
</x-layout-public>
