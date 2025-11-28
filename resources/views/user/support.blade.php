<x-layout-app>
    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-4">
        <h1 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">Soporte</h1>
        <p class="text-sm text-slate-600">Envíanos tu consulta y te responderemos pronto.</p>

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
            <form method="POST" action="{{ route('panel.support.store') }}" class="space-y-4">
                @csrf
                <x-form-input name="asunto" label="Asunto" required />
                <x-form-textarea name="mensaje" label="Mensaje" rows="5" required />
                <x-button-primary type="submit">Enviar a soporte</x-button-primary>
            </form>
        </div>
    </div>
</x-layout-app>
