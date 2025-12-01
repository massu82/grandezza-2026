<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-0">
    <div class="rounded-2xl border border-zinc-700 bg-gradient-to-r from-zinc-800 via-zinc-900 to-zinc-800 text-white p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-lg">
        <div class="space-y-2">
            <p class="text-xs uppercase tracking-[0.2em] text-zinc-200 inline-flex items-center gap-2">
                <x-heroicon-o-sparkles class="w-5 h-5" /> Servicio concierge
            </p>
            <h3 class="text-2xl font-semibold text-zinc-100" style="font-family: 'Playfair Display', serif;">¿Buscas el vino perfecto?</h3>
            <p class="text-sm text-zinc-200">Recibe recomendaciones personalizadas y armado de pedidos exclusivos. Nuestro sommelier te ayuda por chat o llamada.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ url('/contacto') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-zinc-100 text-zinc-900 text-sm font-semibold hover:bg-zinc-200 transition">Hablar con concierge</a>
            <a href="https://wa.me/5215512345678" target="_blank" rel="noopener" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-zinc-300 text-sm font-semibold text-white hover:bg-zinc-700 transition gap-2" data-gtm-event="whatsapp_click" data-meta-event="Contact">
                <x-social-icon name="whatsapp" class="w-5 h-5 invert" />
                WhatsApp
            </a>
        </div>
    </div>
</section>
