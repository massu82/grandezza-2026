@props(['promotion'])

<div class="bg-light border border-primary/15 rounded-2xl p-6 flex flex-col md:flex-row gap-4 items-center">
    @php
        $bannerBase = $promotion->banner ?? null;
        $isExternal = $bannerBase && str_starts_with($bannerBase, 'http');
        $bannerWebp = $bannerBase && !$isExternal ? asset('storage/promotions/large/'.$bannerBase.'.webp') : null;
        $bannerJpg = $bannerBase && !$isExternal ? asset('storage/promotions/large/'.$bannerBase.'.jpg') : null;
        $fallback = $isExternal
            ? $bannerBase
            : 'https://images.unsplash.com/photo-1508057198894-247b23fe5ade?auto=format&fit=crop&w=900&q=80';
        $bannerUrl = $bannerJpg ?? $bannerWebp ?? $fallback;
    @endphp
    <div class="flex-1">
        <p class="text-xs uppercase tracking-wide text-secondary mb-2">Promoción</p>
        <h3 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">{{ $promotion->titulo }}</h3>
        <p class="text-sm text-slate-600 mt-2">{{ $promotion->descripcion }}</p>
        <a href="{{ url('/promociones') }}" class="inline-flex mt-4 items-center gap-2 text-sm font-semibold text-primary hover:text-secondary">
            Ver vinos en promoción
            <span aria-hidden="true">→</span>
        </a>
    </div>
    <div class="w-full md:w-56 h-36 rounded-xl overflow-hidden">
        <picture>
            @if($bannerWebp)
                <source srcset="{{ $bannerWebp }}" type="image/webp">
            @endif
            @if($bannerJpg)
                <source srcset="{{ $bannerJpg }}" type="image/jpeg">
            @endif
            <img loading="lazy" src="{{ $bannerUrl }}" alt="{{ $promotion->titulo }}" class="w-full h-full object-cover">
        </picture>
    </div>
</div>
