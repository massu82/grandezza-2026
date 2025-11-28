<x-layout-admin title="Pedidos">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Pedidos</h1>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-4 mb-4">
        <form method="GET" class="grid md:grid-cols-4 gap-3">
            <x-form-input name="q" label="Buscar" placeholder="Código o cliente" />
            <x-form-select name="estado" label="Estado" :options="['nuevo' => 'Nuevo', 'en_preparacion' => 'En preparación', 'listo' => 'Listo', 'entregado' => 'Entregado', 'cancelado' => 'Cancelado']" placeholder="Todos" />
            <x-form-input name="fecha_desde" type="date" label="Desde" />
            <x-form-input name="fecha_hasta" type="date" label="Hasta" />
            <div class="flex items-end">
                <x-button-primary type="submit">Filtrar</x-button-primary>
            </div>
        </form>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Código</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Cliente</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Estado</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Total</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Fecha</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($orders ?? [] as $order)
                    <tr>
                        <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $order->codigo }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $order->nombre_cliente }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-700">{{ $order->estado }}</span>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-rose-900">${{ number_format($order->total, 2) }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-sm text-right">
                            <a href="{{ url('/admin/orders/'.$order->id) }}" class="text-rose-900 hover:underline">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">No hay pedidos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($orders))
        <x-pagination :paginator="$orders" />
    @endif
</x-layout-admin>
