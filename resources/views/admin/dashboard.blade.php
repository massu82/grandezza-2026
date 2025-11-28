<x-layout-admin title="Dashboard">
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs uppercase text-slate-500">Pedidos nuevos</p>
            <p class="text-3xl font-semibold text-primary mt-2">{{ $stats['orders_new'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs uppercase text-slate-500">Ingresos (mes)</p>
            <p class="text-3xl font-semibold text-primary mt-2">${{ number_format($stats['revenue_month'] ?? 0, 2) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs uppercase text-slate-500">Productos activos</p>
            <p class="text-3xl font-semibold text-primary mt-2">{{ $stats['products_active'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs uppercase text-slate-500">Clientes</p>
            <p class="text-3xl font-semibold text-primary mt-2">{{ $stats['customers'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs uppercase text-slate-500">Leads</p>
            <p class="text-3xl font-semibold text-primary mt-2">{{ $stats['leads'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
            <p class="text-xs uppercase text-slate-500">Candidatos</p>
            <p class="text-3xl font-semibold text-primary mt-2">{{ $stats['candidates'] ?? 0 }}</p>
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">CTA Concierge público</h2>
                <p class="text-sm text-slate-600">Recuerda actualizar el número de WhatsApp en el componente `components/concierge-cta`.</p>
            </div>
            <a href="{{ url('/') }}" class="text-sm text-primary hover:underline" target="_blank">Ver sitio</a>
        </div>
    </div>
</x-layout-admin>
