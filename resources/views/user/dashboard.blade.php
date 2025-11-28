<x-layout-app>
    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Mi panel</h1>
            <p class="text-sm text-slate-600">Hola {{ auth()->user()->name ?? 'Usuario' }}, aquí puedes revisar tus pedidos y soporte.</p>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <p class="text-xs uppercase text-slate-500">Pedidos totales</p>
                <p class="text-3xl font-semibold text-rose-900 mt-2">{{ $ordersCount }}</p>
                @if($lastOrder)
                    <p class="text-sm text-slate-600 mt-1">Último: {{ $lastOrder->codigo }} ({{ $lastOrder->estado }})</p>
                @endif
                <a href="{{ route('panel.orders.index') }}" class="text-sm text-rose-900 hover:underline mt-2 inline-block">Ver pedidos</a>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <p class="text-xs uppercase text-slate-500">Soporte</p>
                <p class="text-sm text-slate-600 mt-2">¿Necesitas ayuda? Envíanos un mensaje.</p>
                <a href="{{ route('panel.support.create') }}" class="text-sm text-rose-900 hover:underline mt-2 inline-block">Contactar soporte</a>
            </div>
        </div>
    </div>
</x-layout-app>
