@php
    $items = collect(session('cart', []))->map(function ($item) {
        $price = $item['precio_promocion'] ?? $item['precio'] ?? 0;
        return [
            'product_id' => $item['product_id'],
            'nombre' => $item['nombre'] ?? 'Producto',
            'categoria' => $item['categoria'] ?? '',
            'quantity' => $item['quantity'] ?? 1,
            'precio' => $item['precio'] ?? 0,
            'precio_promocion' => $item['precio_promocion'] ?? null,
            'imagen' => $item['imagen'] ?? 'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=200&q=80',
            'subtotal' => $price * ($item['quantity'] ?? 1),
        ];
    })->values();
    $total = $items->sum('subtotal');
@endphp

<div x-cloak x-show="cartOpen" class="fixed inset-0 z-50 flex justify-end">
    <div class="absolute inset-0 bg-black/50" @click="cartOpen = false"></div>
    <div class="relative bg-white w-full sm:w-[420px] max-w-md h-full shadow-2xl border-l border-slate-200 flex flex-col"
         x-data="cartDrawerComponent(@js($items), @js($total), '{{ csrf_token() }}')" x-init="registerInstance()">
        <div class="px-4 py-4 border-b border-slate-200 flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-rose-700">Carrito</p>
                <h3 class="text-lg font-semibold text-slate-900">Tus vinos</h3>
            </div>
            <button @click="cartOpen = false" class="text-slate-500 hover:text-rose-900">
                ✕
            </button>
        </div>
        <div class="flex-1 overflow-y-auto">
            <template x-if="items.length === 0">
                <div class="px-4 py-6 text-sm text-slate-500">Tu carrito está vacío.</div>
            </template>
            <template x-for="item in items" :key="item.product_id">
                <div class="px-4 py-3 border-b border-slate-100 flex gap-3 items-center">
                    <img :src="item.imagen" :alt="item.nombre" class="w-14 h-14 rounded-lg object-cover">
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-slate-900" x-text="item.nombre"></div>
                        <div class="text-xs text-slate-500" x-text="item.categoria"></div>
                        <div class="text-sm text-rose-900 font-semibold" x-text="formatCurrency(item.subtotal)"></div>
                        <div class="mt-2 flex items-center gap-2 text-xs">
                            <input type="number" min="1" class="w-16 rounded-md border-slate-300 text-sm text-center" x-model.number="item.quantity" @change="updateItem(item)">
                            <button class="px-3 py-1 rounded-md bg-black text-white text-xs font-semibold hover:bg-rose-900" type="button" @click="updateItem(item)">Actualizar</button>
                            <button class="text-xs text-rose-900 hover:underline" type="button" @click="removeItem(item)">Eliminar</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="p-4 border-t border-slate-200 space-y-3">
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-600">Total</span>
                <span class="text-xl font-semibold text-rose-900" x-text="formatCurrency(total)"></span>
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/carrito') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg border border-slate-300 text-sm font-semibold text-slate-900 hover:border-rose-900 hover:text-rose-900">Ver carrito</a>
                <a href="{{ url('/checkout') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-black text-white text-sm font-semibold hover:bg-rose-900">Checkout</a>
            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            function cartDrawerComponent(initialItems, initialTotal, csrfToken) {
                return {
                    items: initialItems,
                    total: initialTotal,
                    loading: false,
                    registerInstance() {
                        window.cartDrawerController = window.cartDrawerController || {
                            instances: [],
                            update(items, total) {
                                this.instances.forEach(i => i.setData(items, total));
                                window.dispatchEvent(new Event('cart-open'));
                            }
                        };
                        window.cartDrawerController.instances.push(this);
                    },
                    setData(items, total) {
                        this.items = items;
                        this.total = total;
                    },
                    formatCurrency(value) {
                        return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(value || 0);
                    },
                    async updateItem(item) {
                        this.loading = true;
                        try {
                            const response = await fetch('/carrito/actualizar', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: new URLSearchParams({
                                    product_id: item.product_id,
                                    quantity: item.quantity,
                                }),
                            });
                            const data = await response.json();
                            this.setData(data[0], data[1]);
                        } catch (e) {
                            console.error(e);
                        } finally {
                            this.loading = false;
                        }
                    },
                    async removeItem(item) {
                        this.loading = true;
                        try {
                            const response = await fetch('/carrito/eliminar', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: new URLSearchParams({
                                    product_id: item.product_id,
                                }),
                            });
                            const data = await response.json();
                            this.setData(data[0], data[1]);
                        } catch (e) {
                            console.error(e);
                        } finally {
                            this.loading = false;
                        }
                    },
                };
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const handler = async (form) => {
                    const btn = form.querySelector('button[type="submit"]');
                    btn?.setAttribute('disabled', 'disabled');
                    try {
                        const response = await fetch(form.action, {
                            method: form.method,
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]')?.value || '',
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams(new FormData(form)),
                        });
                        const data = await response.json();
                        if (window.cartDrawerController) {
                            window.cartDrawerController.update(data[0], data[1]);
                        }
                    } catch (e) {
                        form.submit(); // fallback full submit
                    } finally {
                        btn?.removeAttribute('disabled');
                    }
                };

                document.addEventListener('submit', (e) => {
                    const form = e.target;
                    if (form.matches('[data-cart-form]')) {
                        e.preventDefault();
                        handler(form);
                    }
                });
            });
        </script>
    @endpush
@endonce
