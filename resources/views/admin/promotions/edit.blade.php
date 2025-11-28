<x-layout-admin title="Editar promoción">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-primary mb-4" style="font-family: 'Playfair Display', serif;">Editar promoción</h1>
        <form method="POST" action="{{ url('/admin/promotions/'.$promotion->id) }}" class="space-y-4">
            @method('PUT')
            @include('admin.promotions._form', ['promotion' => $promotion])
        </form>
    </div>
</x-layout-admin>
