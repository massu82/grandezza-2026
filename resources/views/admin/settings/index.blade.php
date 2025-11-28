<x-layout-admin title="Ajustes">
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 space-y-4">
        <h1 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">Ajustes generales</h1>
        <form method="POST" action="{{ url('/admin/settings') }}" class="space-y-4">
            @csrf
            @method('PUT')
            <x-form-input name="telefono" label="Teléfono de contacto" :value="$settings['telefono'] ?? ''" />
            <x-form-input name="email" label="Email de contacto" :value="$settings['email'] ?? ''" />
            <x-form-input name="direccion" label="Dirección" :value="$settings['direccion'] ?? ''" />
            <x-form-textarea name="horarios" label="Horarios" :value="$settings['horarios'] ?? ''" />
            <div class="flex items-center justify-end">
                <x-button-primary type="submit">Guardar ajustes</x-button-primary>
            </div>
        </form>
    </div>
</x-layout-admin>
