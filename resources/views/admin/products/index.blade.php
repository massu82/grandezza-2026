<x-layout-admin title="Productos">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">Productos</h1>
        <a href="{{ url('/admin/products/create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-secondary">Nuevo producto</a>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4">
            <form method="GET" class="grid md:grid-cols-4 gap-3" data-filter>
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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">SKU</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Categoría</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Presentación</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Precio</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Stock</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Estado</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($products ?? [] as $product)
                        <tr data-product-row data-name="{{ strtolower($product->nombre ?? '') }}" data-sku="{{ strtolower($product->sku ?? '') }}">
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $product->sku }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $product->nombre }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $product->category->nombre ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600" data-inline-edit data-field="presentation" data-id="{{ $product->id }}">{{ $product->presentation ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-900" data-inline-edit data-field="precio" data-id="{{ $product->id }}">${{ number_format($product->precio, 2) }}</td>
                            <td class="px-4 py-3 text-sm" data-inline-edit data-field="stock" data-id="{{ $product->id }}">
                                @if($product->stock <= 0)
                                    <span class="px-2 py-1 text-xs rounded-full bg-light text-secondary">Agotado</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-emerald-50 text-emerald-700">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <button
                                    type="button"
                                    data-toggle-estado
                                    data-id="{{ $product->id }}"
                                    data-current="{{ $product->estado }}"
                                    class="inline-flex items-center gap-2 px-2 py-1 rounded bg-slate-100 text-xs font-semibold text-slate-700 hover:bg-slate-200"
                                >
                                    <span class="w-10 h-5 inline-flex items-center rounded-full transition {{ $product->estado ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                        <span class="h-4 w-4 bg-white rounded-full shadow transform transition {{ $product->estado ? 'translate-x-5' : 'translate-x-1' }}"></span>
                                    </span>
                                    <span>{{ $product->estado ? 'Activo' : 'Inactivo' }}</span>
                                </button>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="isolate inline-flex rounded-md shadow-xs">
                                    <a href="{{ url('/admin/products/'.$product->id) }}" class="relative inline-flex items-center gap-1 rounded-l-md bg-white px-3 py-2 text-xs font-semibold text-slate-900 inset-ring-1 inset-ring-slate-300 hover:bg-slate-50 focus:z-10">
                                        <x-heroicon-o-eye class="w-4 h-4" /> Ver
                                    </a>
                                    <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" class="relative -ml-px inline-flex items-center gap-1 bg-white px-3 py-2 text-xs font-semibold text-slate-900 inset-ring-1 inset-ring-slate-300 hover:bg-slate-50 focus:z-10">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" /> Editar
                                    </a>
                                    <a href="{{ route('admin.products.duplicate', $product) }}" class="relative -ml-px inline-flex items-center gap-1 rounded-r-md bg-primary px-3 py-2 text-xs font-semibold text-white inset-ring-1 inset-ring-primary hover:bg-secondary focus:z-10">
                                        <x-heroicon-o-squares-plus class="w-4 h-4" /> Duplicar
                                    </a>
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-sm text-slate-500">No hay productos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(isset($products))
        <x-pagination :paginator="$products" />
    @endif

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                const makeEditable = (cell) => {
                    const field = cell.dataset.field;
                    const id = cell.dataset.id;
                    if (!field || !id) return;

                    const original = cell.innerText.trim().replace(/^\$/, '');
                    const input = document.createElement('input');
                    input.type = field === 'stock' ? 'number' : 'text';
                    input.value = original;
                    input.className = 'w-full border border-slate-300 rounded px-2 py-1 text-sm';

                        const save = async () => {
                            const value = input.value.trim();
                        if (value === '' || value === null) return cancel();
                        try {
                            const response = await fetch(`/admin/products/${id}/inline`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': token,
                                },
                                body: JSON.stringify({
                                    presentation: field === 'presentation' ? value : cell.parentElement.querySelector('[data-field="presentation"]').innerText.trim(),
                                    precio: field === 'precio' ? value : cell.parentElement.querySelector('[data-field="precio"]').innerText.replace('$','').trim(),
                                    stock: field === 'stock' ? value : cell.parentElement.querySelector('[data-field="stock"]').innerText.trim(),
                                    estado: cell.parentElement.querySelector('[data-toggle-estado]')?.dataset.current ?? 1,
                                }),
                            });
                            if (response.ok) {
                                const json = await response.json();
                                const estadoVal = json.estado ?? value;
                                if (field === 'precio') {
                                    cell.innerHTML = '$' + parseFloat(value).toFixed(2);
                                } else if (field === 'estado') {
                                    cell.dataset.value = estadoVal;
                                    cell.innerHTML = estadoVal == 1
                                        ? '<span class="px-2 py-1 text-xs rounded-full bg-emerald-50 text-emerald-700">Activo</span>'
                                        : '<span class="px-2 py-1 text-xs rounded-full bg-slate-100 text-slate-600">Inactivo</span>';
                                } else {
                                    cell.textContent = value;
                                }
                            } else {
                                cancel();
                            }
                        } catch {
                            cancel();
                        }
                    };

                    const cancel = () => {
                        cell.textContent = original ? (field === 'precio' ? '$' + parseFloat(original).toFixed(2) : original) : '—';
                    };

                    input.addEventListener('blur', save);
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            save();
                        } else if (e.key === 'Escape') {
                            e.preventDefault();
                            cancel();
                        }
                    });

                    cell.innerHTML = '';
                    cell.appendChild(input);
                    input.focus();
                    input.select();
                };

                document.querySelectorAll('[data-inline-edit]').forEach(cell => {
                    cell.addEventListener('dblclick', () => makeEditable(cell));
                });

                document.querySelectorAll('[data-toggle-estado]').forEach(btn => {
                    btn.addEventListener('click', async () => {
                        const row = btn.closest('tr');
                        const id = btn.dataset.id;
                        const current = Number(btn.dataset.current || 0);
                        const next = current === 1 ? 0 : 1;
                        const presentation = row.querySelector('[data-field="presentation"]')?.innerText.trim() || '';
                        const precio = row.querySelector('[data-field="precio"]')?.innerText.replace('$','').trim() || 0;
                        const stock = row.querySelector('[data-field="stock"]')?.innerText.trim() || 0;
                        try {
                            const response = await fetch(`/admin/products/${id}/inline`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': token,
                                },
                                body: JSON.stringify({
                                    presentation,
                                    precio,
                                    stock,
                                    estado: next,
                                }),
                            });
                            if (response.ok) {
                                btn.dataset.current = next;
                                btn.innerHTML = `
                                    <span class="w-10 h-5 inline-flex items-center rounded-full transition ${next ? 'bg-emerald-500' : 'bg-slate-300'}">
                                        <span class="h-4 w-4 bg-white rounded-full shadow transform transition ${next ? 'translate-x-5' : 'translate-x-1'}"></span>
                                    </span>
                                    <span>${next ? 'Activo' : 'Inactivo'}</span>
                                `;
                            }
                        } catch {
                            // ignore on failure
                        }
                    });
                });

                const searchForm = document.querySelector('form[data-filter]');
                const searchInput = searchForm?.querySelector('input[name="q"]');
                if (searchForm && searchInput) {
                    searchInput.addEventListener('input', () => {
                        const term = searchInput.value.trim().toLowerCase();
                        document.querySelectorAll('[data-product-row]').forEach(row => {
                            const name = row.dataset.name || '';
                            const sku = row.dataset.sku || '';
                            const match = !term || name.includes(term) || sku.includes(term);
                            row.style.display = match ? '' : 'none';
                        });
                    });
                }
            });
        </script>
    @endpush
</x-layout-admin>
