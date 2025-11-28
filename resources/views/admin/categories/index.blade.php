<x-layout-admin title="Categorías">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Categorías</h1>
        <a href="{{ url('/admin/categories/create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-rose-900 text-white text-sm font-semibold hover:bg-rose-800">Nueva categoría</a>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Nombre</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Slug</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($categories ?? [] as $category)
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $category->nombre }}</td>
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $category->slug }}</td>
                        <td class="px-4 py-3 text-sm text-right space-x-2">
                            <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}" class="text-slate-700 hover:underline">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-sm text-slate-500">No hay categorías.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($categories))
        <x-pagination :paginator="$categories" />
    @endif
</x-layout-admin>
