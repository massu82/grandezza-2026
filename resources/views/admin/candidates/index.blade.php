<x-layout-admin title="Candidatos">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Candidatos</h1>
        <form method="GET" class="flex items-center gap-2">
            <x-form-input name="q" placeholder="Buscar nombre o email" />
            <x-button-primary type="submit">Buscar</x-button-primary>
        </form>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Nombre</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Puesto</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Fecha</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($candidates as $candidate)
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $candidate->nombre }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $candidate->email }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $candidate->puesto ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $candidate->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-sm text-right space-x-2">
                            <a href="{{ url('/admin/candidates/'.$candidate->id) }}" class="text-rose-900 hover:underline">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">No hay candidatos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-pagination :paginator="$candidates" />
</x-layout-admin>
