<x-layout-admin :title="$promotion->titulo">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 space-y-4">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">{{ $promotion->titulo }}</h1>
                <p class="text-sm text-slate-600">{{ $promotion->descripcion }}</p>
            </div>
            <a href="{{ url('/admin/promotions/'.$promotion->id.'/edit') }}" class="text-sm text-primary hover:underline">Editar</a>
        </div>
        <div class="space-y-2 text-sm">
            <div><strong>Vigencia:</strong> {{ optional($promotion->fecha_inicio)->format('d/m/Y') }} - {{ optional($promotion->fecha_fin)->format('d/m/Y') }}</div>
            <div><strong>Activo:</strong> {{ $promotion->activo ? 'Sí' : 'No' }}</div>
        </div>
        @php
            $bannerBase = $promotion->banner ?? null;
            $isExternal = $bannerBase && str_starts_with($bannerBase, 'http');
            $bannerWebp = $bannerBase && !$isExternal ? asset('storage/promotions/large/'.$bannerBase.'.webp') : null;
            $bannerJpg = $bannerBase && !$isExternal ? asset('storage/promotions/large/'.$bannerBase.'.jpg') : null;
            $bannerUrl = $bannerJpg ?? $bannerWebp ?? ($isExternal ? $bannerBase : null);
        @endphp
        @if($bannerUrl)
            <div class="w-full max-w-4xl">
                <p class="text-sm font-semibold text-slate-700 mb-2">Banner cargado</p>
                <picture class="block rounded-lg overflow-hidden border border-slate-200">
                    @if($bannerWebp)
                        <source srcset="{{ $bannerWebp }}" type="image/webp">
                    @endif
                    @if($bannerJpg)
                        <source srcset="{{ $bannerJpg }}" type="image/jpeg">
                    @endif
                    <img src="{{ $bannerUrl }}" alt="Banner de la promoción" class="w-full h-auto object-cover">
                </picture>
            </div>
        @endif
        <div>
            <h2 class="text-sm font-semibold text-slate-800 mb-2">Productos</h2>
            <ul class="list-disc list-inside text-sm text-slate-700 space-y-1">
                @foreach($promotion->products ?? [] as $product)
                    <li>{{ $product->nombre }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</x-layout-admin>
