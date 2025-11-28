<x-layout-admin title="Promociones">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">Promociones</h1>
        <a href="{{ url('/admin/promotions/create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-secondary">Nueva promoción</a>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Título</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Activo</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Vigencia</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($promotions ?? [] as $promotion)
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $promotion->titulo }}</td>
                        <td class="px-4 py-3 text-sm">
                            @if($promotion->activo)
                                <span class="px-2 py-1 text-xs rounded-full bg-emerald-50 text-emerald-700">Activo</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-600">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">
                            {{ optional($promotion->fecha_inicio)->format('d/m/Y') }} - {{ optional($promotion->fecha_fin)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-right space-x-2">
                            <a href="{{ url('/admin/promotions/'.$promotion->id.'/edit') }}" class="text-slate-700 hover:underline">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-500">No hay promociones.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($promotions))
        <x-pagination :paginator="$promotions" />
    @endif
</x-layout-admin>
