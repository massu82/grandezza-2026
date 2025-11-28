<x-layout-app>
    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">Pedido {{ $order->codigo }}</h1>
                <p class="text-sm text-slate-600">Estado: {{ $order->estado }} | Total: ${{ number_format($order->total, 2) }}</p>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-4 space-y-3">
            <div class="grid sm:grid-cols-2 gap-3 text-sm">
                <div><span class="text-slate-500">Nombre:</span> {{ $order->nombre_cliente }}</div>
                <div><span class="text-slate-500">Email:</span> {{ $order->email_cliente }}</div>
                <div><span class="text-slate-500">Teléfono:</span> {{ $order->telefono_cliente }}</div>
                <div><span class="text-slate-500">Método:</span> {{ $order->metodo_entrega }}</div>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-800 mb-2">Productos</h3>
                <div class="divide-y divide-slate-200">
                    @foreach($order->items as $item)
                        <div class="py-2 flex items-center justify-between text-sm">
                            <div>
                                <div class="font-semibold text-slate-900">{{ $item->nombre_producto }}</div>
                                <div class="text-xs text-slate-500">Cant: {{ $item->cantidad }}</div>
                            </div>
                            <div class="text-sm font-semibold text-primary">${{ number_format($item->subtotal, 2) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-800 mb-1">Notas</h3>
                <p class="text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-lg p-3">{{ $order->notas_cliente ?? '—' }}</p>
            </div>
        </div>
    </div>
</x-layout-app>
