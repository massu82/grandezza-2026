<x-layout-admin title="Editar producto">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-primary mb-4" style="font-family: 'Playfair Display', serif;">Editar producto</h1>
        <form method="POST" action="{{ url('/admin/products/'.$product->id) }}" class="space-y-4" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.products._form', ['product' => $product])
        </form>
    </div>
</x-layout-admin>
