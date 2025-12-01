<x-layout-admin title="Editar categoría">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-primary mb-4" style="font-family: 'Playfair Display', serif;">Editar categoría</h1>
        <form
            method="POST"
            action="{{ url('/admin/categories/'.$category->id) }}"
            class="space-y-4"
            x-data='categoryForm({ initialSlug: @js(old("slug", $category->slug ?? "")), initialName: @js(old("nombre", $category->nombre ?? "")) })'
            enctype="multipart/form-data"
            @submit="start($event)"
        >
            @method('PUT')
            @include('admin.categories._form', ['category' => $category, 'showSlug' => true])
        </form>
    </div>
</x-layout-admin>
