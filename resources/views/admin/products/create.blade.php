<x-layout-admin title="Crear producto">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-primary mb-4" style="font-family: 'Playfair Display', serif;">Nuevo producto</h1>
        <form method="POST" action="{{ url('/admin/products') }}" class="space-y-4" enctype="multipart/form-data" x-data="formState()" @submit="start($event)">
            @include('admin.products._form')
        </form>
    </div>
</x-layout-admin>
