<x-layout-admin title="Editar página">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-rose-950 mb-4" style="font-family: 'Playfair Display', serif;">Editar página</h1>
        <form method="POST" action="{{ url('/admin/pages/'.$page->id) }}" class="space-y-4">
            @method('PUT')
            @include('admin.pages._form', ['page' => $page])
        </form>
    </div>
</x-layout-admin>
