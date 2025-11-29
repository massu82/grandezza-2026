<x-layout-public :title="$page->titulo">
    <section class="w-full bg-gradient-to-b from-zinc-900 via-zinc-950 to-zinc-900 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <p class="text-xs uppercase tracking-[0.2em] text-accent">Página</p>
            <h1 class="text-3xl font-semibold text-white" style="font-family: 'Playfair Display', serif;">{{ $page->titulo }}</h1>
        </div>
    </section>
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-4">
        <div class="prose prose-zinc max-w-none">
            {!! nl2br(e($page->contenido)) !!}
        </div>
    </section>

    <x-concierge-cta />
</x-layout-public>
