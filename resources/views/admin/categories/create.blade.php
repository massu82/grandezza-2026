<x-layout-admin title="Crear categoría">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-primary mb-4" style="font-family: 'Playfair Display', serif;">Nueva categoría</h1>
        <form method="POST" action="{{ url('/admin/categories') }}" class="space-y-4">
            @include('admin.categories._form')
        </form>
    </div>
</x-layout-admin>
