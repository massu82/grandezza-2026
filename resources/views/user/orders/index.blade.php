<x-layout-app>
    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">Mis pedidos</h1>
                <p class="text-sm text-slate-600">Consulta el historial y estado de tus pedidos.</p>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Código</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Estado</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Total</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Fecha</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($orders as $order)
                        <tr>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $order->codigo }}</td>
                            <td class="px-4 py-3 text-sm text-slate-700">{{ $order->estado }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-primary">${{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-sm text-right">
                                <a href="{{ route('panel.orders.show', $order) }}" class="text-primary hover:underline">Ver detalle</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">No tienes pedidos aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-pagination :paginator="$orders" />
    </div>
</x-layout-app>
