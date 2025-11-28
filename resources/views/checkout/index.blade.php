<x-layout-public title="Checkout | Grandezza">
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl shadow-sm p-6 space-y-4">
                <h1 class="text-2xl font-semibold text-rose-950 mb-2" style="font-family: 'Playfair Display', serif;">Checkout</h1>
                <p class="text-sm text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-lg px-4 py-2">Entrega únicamente por recolección en tienda. Pago al recoger.</p>
                <form method="POST" action="{{ url('/checkout') }}" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <x-form-input name="nombre_cliente" label="Nombre completo" required />
                        <x-form-input name="email_cliente" type="email" label="Email" required />
                        <x-form-input name="telefono_cliente" label="Teléfono" required />
                        <x-form-input name="codigo_postal" label="Código postal" />
                    </div>
                    <x-form-textarea name="notas_cliente" label="Comentarios" placeholder="Indicaciones especiales" />
                    <x-turnstile />
                    <div class="flex items-center gap-3">
                        <x-button-primary type="submit" data-gtm-event="purchase" data-meta-event="Purchase">Confirmar pedido</x-button-primary>
                        <span class="text-xs text-slate-500">Al confirmar aceptas nuestros términos y privacidad.</span>
                    </div>
                </form>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-rose-950 mb-3" style="font-family: 'Playfair Display', serif;">Resumen</h2>
                <div class="space-y-4">
                    @forelse(($cartItems ?? []) as $item)
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-semibold text-slate-800">{{ $item->name ?? '' }}</div>
                                <div class="text-xs text-slate-500">Cant: {{ $item->qty ?? 1 }}</div>
                            </div>
                            <div class="text-sm font-semibold text-rose-900">${{ number_format($item->subtotal ?? ($item->price ?? 0), 2) }}</div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">No hay productos en el carrito.</p>
                    @endforelse
                    <div class="border-t border-slate-200 pt-4 flex items-center justify-between">
                        <span class="text-sm text-slate-600">Total</span>
                        <span class="text-xl font-semibold text-rose-900">${{ number_format($cartTotal ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-concierge-cta />
</x-layout-public>
