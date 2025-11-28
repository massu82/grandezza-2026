@props(['promotion'])

<div class="bg-rose-50 border border-rose-100 rounded-2xl p-6 flex flex-col md:flex-row gap-4 items-center">
    <div class="flex-1">
        <p class="text-xs uppercase tracking-wide text-rose-700 mb-2">Promoción</p>
        <h3 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">{{ $promotion->titulo }}</h3>
        <p class="text-sm text-slate-600 mt-2">{{ $promotion->descripcion }}</p>
        <a href="{{ url('/promociones') }}" class="inline-flex mt-4 items-center gap-2 text-sm font-semibold text-rose-900 hover:text-rose-700">
            Ver vinos en promoción
            <span aria-hidden="true">→</span>
        </a>
    </div>
    <div class="w-full md:w-56 h-36 rounded-xl overflow-hidden">
        <img loading="lazy" src="{{ $promotion->banner ?? 'https://images.unsplash.com/photo-1508057198894-247b23fe5ade?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $promotion->titulo }}" class="w-full h-full object-cover">
    </div>
</div>
