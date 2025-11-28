<x-layout-public title="Bolsa de trabajo | Grandezza">
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h1 class="text-3xl font-semibold text-rose-950 mb-3" style="font-family: 'Playfair Display', serif;">Únete al equipo</h1>
                <p class="text-sm text-slate-600 mb-4">Buscamos personas apasionadas por el vino, el servicio y la hospitalidad. Comparte tus datos y cuéntanos por qué quieres trabajar con nosotros.</p>
                <ul class="space-y-2 text-sm text-slate-700">
                    <li><strong>Áreas:</strong> Ventas boutique, logística, sommeliers, marketing.</li>
                    <li><strong>Ubicación:</strong> CDMX, híbrido según rol.</li>
                    <li><strong>Contacto:</strong> talent@grandezza.mx</li>
                </ul>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
                <form method="POST" action="{{ url('/bolsa') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <x-form-input name="nombre" label="Nombre completo" required />
                    <x-form-input name="email" type="email" label="Email" required />
                    <x-form-input name="telefono" label="Teléfono" />
                    <x-form-input name="puesto" label="Puesto de interés" required />
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-700" for="cv">Subir CV (PDF)</label>
                        <input type="file" id="cv" name="cv" accept="application/pdf" class="block w-full text-sm text-slate-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-black file:text-white hover:file:bg-rose-900 border border-slate-300 rounded-lg focus:border-rose-700 focus:ring-rose-700">
                        @error('cv')
                            <p class="text-xs text-rose-700">{{ $message }}</p>
                        @enderror
                    </div>
                    <x-form-textarea name="mensaje" label="Mensaje" rows="4" placeholder="Cuéntanos sobre tu experiencia" />
                    <input type="hidden" name="turnstile_token" id="turnstile_token_bolsa">
                    <x-turnstile />
                    <x-button-primary type="submit" data-gtm-event="generate_lead" data-meta-event="Lead">Enviar aplicación</x-button-primary>
                </form>
            </div>
        </div>
    </section>

    <x-concierge-cta />
</x-layout-public>
