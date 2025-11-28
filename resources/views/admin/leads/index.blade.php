<x-layout-admin title="Leads">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">Leads</h1>
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
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Servicio</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Origen</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Fecha</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($leads as $lead)
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $lead->nombre }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $lead->email }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $lead->servicio ?? '—' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $lead->origen }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $lead->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-sm text-right space-x-2">
                            <a href="{{ url('/admin/leads/'.$lead->id) }}" class="text-primary hover:underline">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">No hay leads.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-pagination :paginator="$leads" />
</x-layout-admin>
