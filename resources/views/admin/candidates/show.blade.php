<x-layout-admin :title="$candidate->nombre">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 space-y-3">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">{{ $candidate->nombre }}</h1>
                <p class="text-sm text-slate-600">{{ $candidate->email }}</p>
            </div>
            <form method="POST" action="{{ url('/admin/candidates/'.$candidate->id) }}">
                @csrf
                @method('DELETE')
                <x-button-primary type="submit">Eliminar</x-button-primary>
            </form>
        </div>
        <div class="grid sm:grid-cols-2 gap-4 text-sm">
            <div><span class="text-slate-500">Teléfono:</span> {{ $candidate->telefono ?? '—' }}</div>
            <div><span class="text-slate-500">Puesto:</span> {{ $candidate->puesto ?? '—' }}</div>
            <div><span class="text-slate-500">Fecha:</span> {{ $candidate->created_at?->format('d/m/Y H:i') }}</div>
            <div><span class="text-slate-500">CV:</span>
                @if($candidate->cv_path)
                    <a href="{{ Storage::url($candidate->cv_path) }}" class="text-primary hover:underline" target="_blank">Ver CV</a>
                @else
                    —
                @endif
            </div>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-slate-800 mb-1">Mensaje</h3>
            <p class="text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-lg p-3">{{ $candidate->mensaje ?? '—' }}</p>
        </div>
    </div>
</x-layout-admin>
