<x-layout-admin title="Productos">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Productos</h1>
        <a href="{{ url('/admin/products/create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-rose-900 text-white text-sm font-semibold hover:bg-rose-800">Nuevo producto</a>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4">
            <form method="GET" class="grid md:grid-cols-4 gap-3">
                <x-form-input name="q" label="Buscar" placeholder="Nombre o SKU" />
                <x-form-select name="categoria" label="Categoría" :options="$categorias ?? []" placeholder="Todas" />
                <x-form-select name="estado" label="Estado" :options="['1' => 'Activo', '0' => 'Inactivo']" placeholder="Todos" />
                <div class="flex items-end">
                    <x-button-primary type="submit">Filtrar</x-button-primary>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Categoría</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Precio</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Stock</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Estado</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($products ?? [] as $product)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $product->nombre }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $product->category->nombre ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-900">${{ number_format($product->precio, 2) }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($product->stock <= 0)
                                    <span class="px-2 py-1 text-xs rounded-full bg-rose-50 text-rose-800">Agotado</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-emerald-50 text-emerald-700">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if($product->estado)
                                    <span class="px-2 py-1 text-xs rounded-full bg-emerald-50 text-emerald-700">Activo</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-600">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-right space-x-2">
                                <a href="{{ url('/admin/products/'.$product->id) }}" class="text-rose-900 hover:underline">Ver</a>
                                <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" class="text-slate-700 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">No hay productos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(isset($products))
        <x-pagination :paginator="$products" />
    @endif
</x-layout-admin>
