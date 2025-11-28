<x-layout-admin :title="'Pedido '.$order->codigo">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 space-y-4">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Pedido {{ $order->codigo }}</h1>
                <p class="text-sm text-slate-600">Cliente: {{ $order->nombre_cliente }} | {{ $order->email_cliente }}</p>
            </div>
            <form method="POST" action="{{ url('/admin/orders/'.$order->id) }}" class="flex items-center gap-2">
                @method('PUT')
                @csrf
                <x-form-select name="estado" :options="['nuevo' => 'Nuevo', 'en_preparacion' => 'En preparación', 'listo' => 'Listo', 'entregado' => 'Entregado', 'cancelado' => 'Cancelado']" :value="$order->estado" />
                <x-button-primary type="submit">Actualizar</x-button-primary>
            </form>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <h2 class="text-lg font-semibold text-slate-900 mb-3">Productos</h2>
                <div class="divide-y divide-slate-200 border border-slate-200 rounded-lg">
                    @foreach($order->items ?? [] as $item)
                        <div class="p-4 flex items-center justify-between">
                            <div>
                                <div class="text-sm font-semibold text-slate-900">{{ $item->nombre_producto }}</div>
                                <div class="text-xs text-slate-500">Cant: {{ $item->cantidad }}</div>
                            </div>
                            <div class="text-sm font-semibold text-rose-900">${{ number_format($item->subtotal, 2) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="space-y-3">
                <div class="p-4 border border-slate-200 rounded-lg bg-slate-50">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-600">Total</span>
                        <span class="text-xl font-semibold text-rose-900">${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="mt-2 text-xs text-slate-500">Método: {{ $order->metodo_entrega }}</div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-800 mb-1">Notas cliente</h3>
                    <p class="text-sm text-slate-600 bg-slate-50 border border-slate-200 rounded-lg p-3">{{ $order->notas_cliente ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-800 mb-1">Notas internas</h3>
                    <p class="text-sm text-slate-600 bg-slate-50 border border-slate-200 rounded-lg p-3">{{ $order->notas_internas ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>
