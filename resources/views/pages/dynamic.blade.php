<x-layout-public :title="$page->titulo">
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-4">
        <h1 class="text-3xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">{{ $page->titulo }}</h1>
        <div class="prose prose-slate max-w-none">
            {!! nl2br(e($page->contenido)) !!}
        </div>
    </section>

    <x-concierge-cta />
</x-layout-public>
