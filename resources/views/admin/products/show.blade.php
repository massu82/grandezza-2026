<x-layout-admin :title="$product->nombre">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 space-y-4">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">{{ $product->nombre }}</h1>
                <p class="text-sm text-slate-600">SKU: {{ $product->sku }}</p>
            </div>
            <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" class="text-sm text-primary hover:underline">Editar</a>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2 space-y-3">
                <img src="{{ $product->imagen_principal ?? 'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=1000&q=80' }}" alt="{{ $product->nombre }}" class="w-full h-72 object-cover rounded-lg">
                <p class="text-sm text-slate-700">{{ $product->descripcion_larga }}</p>
            </div>
            <div class="space-y-2 text-sm">
                <div class="flex items-center justify-between"><span class="text-slate-500">Precio:</span><span class="font-semibold text-primary">${{ number_format($product->precio, 2) }}</span></div>
                @if($product->precio_promocion)
                    <div class="flex items-center justify-between"><span class="text-slate-500">Promoción:</span><span class="font-semibold text-primary">${{ number_format($product->precio_promocion, 2) }}</span></div>
                @endif
                <div class="flex items-center justify-between"><span class="text-slate-500">Stock:</span><span class="font-semibold">{{ $product->stock }}</span></div>
                <div class="flex items-center justify-between"><span class="text-slate-500">Estado:</span><span>{{ $product->estado ? 'Activo' : 'Inactivo' }}</span></div>
                <div class="flex items-center justify-between"><span class="text-slate-500">Categoría:</span><span>{{ $product->category->nombre ?? '—' }}</span></div>
                <div class="flex items-center justify-between"><span class="text-slate-500">Tipo:</span><span>{{ $product->tipo }}</span></div>
                <div class="flex items-center justify-between"><span class="text-slate-500">Presentación:</span><span>{{ $product->presentation }}</span></div>
            </div>
        </div>
    </div>
</x-layout-admin>
