<x-layout-public title="Vinos | Grandezza">
    <section class="w-full bg-gradient-to-b from-zinc-900 via-zinc-950 to-zinc-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-semibold text-white" style="font-family: 'Playfair Display', serif;">Vinos</h1>
            @if(isset($products) && $products->count())
                <p class="text-sm text-zinc-200 mt-1">Mostrando {{ $products->firstItem() }}–{{ $products->lastItem() }} de {{ $products->total() }} vinos</p>
            @else
                <p class="text-sm text-zinc-200 mt-1">Explora nuestra selección.</p>
            @endif
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <form method="GET" class="w-full md:w-auto">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <x-form-select name="tipo" :options="$tipos ?? []" placeholder="Tipo" />
                    <x-form-select name="pais" :options="$paises ?? []" placeholder="País" />
                    <x-form-select name="categoria" :options="$categorias ?? []" placeholder="Categoría" />
                    <x-form-select name="orden" :options="['precio_asc' => 'Precio (menor)', 'precio_desc' => 'Precio (mayor)']" placeholder="Ordenar por" />
                </div>
                <div class="mt-3 flex justify-end">
                    <x-button-primary type="submit">Aplicar filtros</x-button-primary>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 items-stretch">
            @forelse($products ?? [] as $product)
                <x-product-card :product="$product" />
            @empty
                <p class="col-span-full text-zinc-500 text-sm">No encontramos vinos con los filtros seleccionados.</p>
            @endforelse
        </div>

        @if(isset($products))
            <x-pagination :paginator="$products" />
        @endif
    </section>

    <x-concierge-cta />
</x-layout-public>
