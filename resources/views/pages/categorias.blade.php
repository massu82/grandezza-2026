<x-layout-public title="Categorías | Grandezza">
    <section class="w-full bg-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-semibold text-white" style="font-family: 'Playfair Display', serif;">Categorías</h1>
            <p class="text-sm text-slate-200 mt-2">Explora nuestras familias de vinos y destilados.</p>
        </div>
    </section>
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($categories ?? [] as $category)
                <a href="{{ url('/categorias/'.$category->slug) }}" class="block bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="h-28 w-full overflow-hidden">
                        <img loading="lazy" src="{{ $category->imagen ?? 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $category->nombre }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-primary" style="font-family: 'Playfair Display', serif;">{{ $category->nombre }}</h2>
                        <p class="text-sm text-slate-600 mt-1">{{ \Illuminate\Support\Str::limit($category->descripcion, 80) }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-sm text-slate-500">No hay categorías disponibles.</p>
            @endforelse
        </div>
        @if(isset($categories))
            <x-pagination :paginator="$categories" />
        @endif
    </section>

    <x-concierge-cta />
</x-layout-public>
