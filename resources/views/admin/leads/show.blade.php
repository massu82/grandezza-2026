<x-layout-admin :title="$lead->nombre">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 space-y-3">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">{{ $lead->nombre }}</h1>
                <p class="text-sm text-slate-600">{{ $lead->email }}</p>
            </div>
            <form method="POST" action="{{ url('/admin/leads/'.$lead->id) }}">
                @csrf
                @method('DELETE')
                <x-button-primary type="submit">Eliminar</x-button-primary>
            </form>
        </div>
        <div class="grid sm:grid-cols-2 gap-4 text-sm">
            <div><span class="text-slate-500">Teléfono:</span> {{ $lead->telefono ?? '—' }}</div>
            <div><span class="text-slate-500">Servicio:</span> {{ $lead->servicio ?? '—' }}</div>
            <div><span class="text-slate-500">Origen:</span> {{ $lead->origen }}</div>
            <div><span class="text-slate-500">Fecha:</span> {{ $lead->created_at?->format('d/m/Y H:i') }}</div>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 mb-1">Mensaje</h3>
            <p class="text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-lg p-3">{{ $lead->mensaje ?? '—' }}</p>
        </div>
    </div>
</x-layout-admin>
