<x-layout-public title="404 | Página no encontrada">
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center space-y-6">
        <p class="text-xs uppercase tracking-[0.2em] text-rose-700">Error 404</p>
        <h1 class="text-4xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Página no encontrada</h1>
        <p class="text-sm text-slate-600">Lo sentimos, el recurso que buscas no existe o fue movido.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-black text-white text-sm font-semibold hover:bg-rose-900 transition">Volver al inicio</a>
            <a href="{{ url('/vinos') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-slate-300 text-sm font-semibold text-slate-900 hover:border-rose-900 hover:text-rose-900 transition">Explorar vinos</a>
        </div>
    </section>
</x-layout-public>
