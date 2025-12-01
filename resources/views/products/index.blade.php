@php
    $currentCategory = $category->nombre ?? null;
    $pageTitle = $currentCategory ? ($currentCategory.' | Grandezza') : 'Vinos | Grandezza';
    $metaDescription = $category->descripcion ?? ($currentCategory ? "Explora {$currentCategory} en Grandezza." : null);
@endphp

<x-layout-public :title="$pageTitle" :metaDescription="$metaDescription">
    <section class="w-full bg-gradient-to-b from-zinc-900 via-zinc-950 to-zinc-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-semibold text-white" style="font-family: 'Playfair Display', serif;">
                {{ $currentCategory ?? 'Vinos' }}
            </h1>
            <p class="text-sm text-zinc-200 mt-1">
                @if(isset($products) && $products->count())
                    Mostrando {{ $products->firstItem() }}–{{ $products->lastItem() }} de {{ $products->total() }} {{ $currentCategory ? 'productos' : 'vinos' }}
                @else
                    Explora nuestra selección.
                @endif
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6"
            x-data="filtersBar({
                initial: {
                    tipo: '{{ request('tipo') }}',
                    pais: '{{ request('pais') }}',
                    categoria: '{{ request('categoria') }}',
                    orden: '{{ request('orden') }}',
                }
            })"
        >
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3 w-full">
                <div class="col-span-2 md:col-span-1">
                    <label class="text-xs uppercase tracking-wide text-zinc-500 block mb-1">Tipo</label>
                    <select x-model="filters.tipo" class="w-full rounded-lg border border-zinc-300 bg-white text-sm text-dark focus:border-primary focus:ring-accent">
                        <option value="">Todos</option>
                        @foreach(($tipos ?? []) as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-xs uppercase tracking-wide text-zinc-500 block mb-1">País</label>
                    <select x-model="filters.pais" class="w-full rounded-lg border border-zinc-300 bg-white text-sm text-dark focus:border-primary focus:ring-accent">
                        <option value="">Todos</option>
                        @foreach(($paises ?? []) as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-xs uppercase tracking-wide text-zinc-500 block mb-1">Categoría</label>
                    <select x-model="filters.categoria" class="w-full rounded-lg border border-zinc-300 bg-white text-sm text-dark focus:border-primary focus:ring-accent">
                        <option value="">Todas</option>
                        @foreach(($categorias ?? []) as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-xs uppercase tracking-wide text-zinc-500 block mb-1">Ordenar por</label>
                    <select x-model="filters.orden" class="w-full rounded-lg border border-zinc-300 bg-white text-sm text-dark focus:border-primary focus:ring-accent">
                        <option value="">Relevancia</option>
                        <option value="precio_asc">Precio (menor)</option>
                        <option value="precio_desc">Precio (mayor)</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1 flex items-end gap-2">
                    <button type="button" class="btn-primary w-full justify-center" @click="submit()">Aplicar filtros</button>
                    <button type="button" class="text-xs text-zinc-600 hover:text-secondary underline" @click="clear()">Limpiar</button>
                </div>
            </div>
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
