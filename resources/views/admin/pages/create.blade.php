<x-layout-admin title="Crear página">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-primary mb-4" style="font-family: 'Playfair Display', serif;">Nueva página</h1>
        <form method="POST" action="{{ url('/admin/pages') }}" class="space-y-4">
            @include('admin.pages._form')
        </form>
    </div>
</x-layout-admin>
