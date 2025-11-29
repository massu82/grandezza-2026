<x-layout-public title="Bolsa de trabajo | Grandezza">
    <section class="w-full bg-gradient-to-b from-zinc-900 via-zinc-950 to-zinc-900 text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <p class="text-xs uppercase tracking-[0.2em] text-accent">Talento</p>
            <h1 class="text-3xl font-semibold text-white mb-3" style="font-family: 'Playfair Display', serif;">Únete al equipo</h1>
            <p class="text-sm text-zinc-200 mb-2">Buscamos personas apasionadas por el vino, el servicio y la hospitalidad.</p>
        </div>
    </section>
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <p class="text-sm text-zinc-600 mb-4">Comparte tus datos y cuéntanos por qué quieres trabajar con nosotros.</p>
                <ul class="space-y-2 text-sm text-zinc-700">
                    <li><strong>Áreas:</strong> Ventas boutique, logística, sommeliers, marketing.</li>
                    <li><strong>Ubicación:</strong> CDMX, híbrido según rol.</li>
                    <li><strong>Contacto:</strong> talent@grandezza.mx</li>
                </ul>
            </div>
            <div class="bg-white border border-zinc-200 rounded-xl shadow-sm p-6">
                <form method="POST" action="{{ url('/bolsa') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <x-form-input name="nombre" label="Nombre completo" required />
                    <x-form-input name="email" type="email" label="Email" required />
                    <x-form-input name="telefono" label="Teléfono" />
                    <x-form-input name="puesto" label="Puesto de interés" required />
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-zinc-700" for="cv">Subir CV (PDF)</label>
                        <input type="file" id="cv" name="cv" accept="application/pdf" class="block w-full text-sm text-zinc-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-white hover:file:bg-secondary border border-zinc-300 rounded-lg focus:border-primary focus:ring-accent">
                        @error('cv')
                            <p class="text-xs text-secondary">{{ $message }}</p>
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
