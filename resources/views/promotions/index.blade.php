<x-layout-public title="Promociones | Grandezza">
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-rose-700">Promociones</p>
                <h1 class="text-3xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Vinos en oferta</h1>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($promotions as $promotion)
                <x-promotion-card :promotion="$promotion" />
            @empty
                <p class="text-sm text-slate-500">No hay promociones activas.</p>
            @endforelse
            <x-pagination :paginator="$promotions" />
        </div>

        <div class="border-t border-slate-200 pt-8">
            <h2 class="text-xl font-semibold text-rose-950 mb-4" style="font-family: 'Playfair Display', serif;">Vinos con descuento</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <p class="col-span-full text-sm text-slate-500">Sin productos en promoción.</p>
                @endforelse
            </div>
            <x-pagination :paginator="$products" />
        </div>
    </section>

    <x-concierge-cta />
</x-layout-public>
