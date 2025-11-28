<x-layout-public title="Carrito | Grandezza">
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Tu carrito</h1>
            <a href="{{ url('/vinos') }}" class="text-sm text-rose-900 hover:text-rose-700">Seguir comprando</a>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
            <div class="divide-y divide-slate-100">
                @forelse(($cartItems ?? []) as $item)
                    <div class="p-4 grid grid-cols-1 md:grid-cols-[1fr_auto_auto] items-center gap-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ $item['imagen'] ?? $item['options']['imagen'] ?? 'https://images.unsplash.com/photo-1527169402691-feff5539e52c?auto=format&fit=crop&w=200&q=80' }}" alt="{{ $item['nombre'] ?? $item['name'] ?? 'Producto' }}" class="w-16 h-16 rounded-lg object-cover">
                            <div>
                                <div class="text-sm font-semibold text-rose-950">{{ $item['nombre'] ?? $item['name'] ?? 'Producto' }}</div>
                                <div class="text-xs text-slate-500">{{ $item['categoria'] ?? $item['options']['categoria'] ?? '' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 justify-start md:justify-center">
                            <form method="POST" action="{{ url('/carrito/actualizar') }}" class="flex items-center gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] ?? $item['id'] }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] ?? $item['qty'] ?? 1 }}" min="1" class="w-16 rounded-md border-slate-300 text-sm text-center">
                                <x-button-primary type="submit">Actualizar</x-button-primary>
                            </form>
                            <form method="POST" action="{{ url('/carrito/eliminar') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] ?? $item['id'] }}">
                                <button class="text-sm text-rose-900 hover:underline">Eliminar</button>
                            </form>
                        </div>
                        <div class="text-left md:text-right md:min-w-[140px]">
                            <div class="text-sm text-slate-600">Subtotal</div>
                            <div class="text-lg font-semibold text-rose-900">${{ number_format($item['subtotal'] ?? ($item['price'] ?? $item['precio'] ?? 0), 2) }}</div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-500 text-sm">No tienes productos en tu carrito.</div>
                @endforelse
            </div>
        </div>

        @if(isset($cartItems) && count($cartItems))
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="text-sm text-slate-600">Total: <span class="text-xl font-semibold text-rose-900">${{ number_format($cartTotal ?? 0, 2) }}</span></div>
                <a href="{{ url('/checkout') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-rose-900 text-white text-sm font-semibold hover:bg-rose-800 focus:outline-none focus:ring-2 focus:ring-rose-300" data-gtm-event="begin_checkout" data-meta-event="InitiateCheckout">Continuar al checkout</a>
            </div>
        @endif

        @if(isset($cartItemsPagination))
            <x-pagination :paginator="$cartItemsPagination" />
        @endif
    </section>

    <x-concierge-cta />
</x-layout-public>
