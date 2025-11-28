<x-layout-public title="Contacto | Grandezza">
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white border border-slate-200 rounded-xl shadow-sm p-6">
                <h1 class="text-3xl font-semibold text-rose-950 mb-2" style="font-family: 'Playfair Display', serif;">Hablemos</h1>
                <p class="text-sm text-slate-600 mb-4">Envíanos un mensaje y nuestro equipo te ayudará a elegir el vino perfecto.</p>
                <form method="POST" action="{{ url('/contacto') }}" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <x-form-input name="nombre" label="Nombre" required />
                        <x-form-input name="email" type="email" label="Email" required />
                        <x-form-input name="telefono" label="Teléfono" />
                        <x-form-select name="servicio" label="Servicio" :options="['asesoria' => 'Asesoría de vinos', 'eventos' => 'Eventos', 'corporativo' => 'Corporativo']" placeholder="Selecciona" />
                    </div>
                    <x-form-textarea name="mensaje" label="Mensaje" rows="5" required />
                    <input type="hidden" name="turnstile_token" id="turnstile_token">
                    <x-turnstile />
                    <x-button-primary type="submit" data-gtm-event="generate_lead" data-meta-event="Lead">Enviar mensaje</x-button-primary>
                </form>

                <div class="mt-8 border-t border-slate-200 pt-6">
                    <h2 class="text-xl font-semibold text-rose-950 mb-2" style="font-family: 'Playfair Display', serif;">Pedidos Dock / Empresas / Proveedores</h2>
                    <p class="text-sm text-slate-600 mb-4">Si necesitas surtir eventos, compras corporativas o eres proveedor, comparte tus datos y nos pondremos en contacto.</p>
                    <form method="POST" action="{{ url('/contacto') }}" class="space-y-3">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-3">
                            <x-form-input name="empresa" label="Empresa / Marca" />
                            <x-form-input name="rol" label="Rol o cargo" />
                        </div>
                        <x-form-input name="correo_empresa" type="email" label="Email corporativo" />
                        <x-form-textarea name="mensaje_corporativo" label="Requerimiento" rows="4" />
                        <input type="hidden" name="turnstile_token" id="turnstile_token_empresa">
                        <x-turnstile />
                        <x-button-primary type="submit" data-gtm-event="generate_lead" data-meta-event="Lead">Enviar solicitud corporativa</x-button-primary>
                    </form>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-4">
                    <h2 class="text-lg font-semibold text-rose-950 mb-2" style="font-family: 'Playfair Display', serif;">Visítanos</h2>
                    <p class="text-sm text-slate-700">Av. Vino 123, CDMX</p>
                    <p class="text-sm text-slate-700">Tel: (55) 1234 5678</p>
                    <p class="text-sm text-slate-700 mb-2">Email: hola@grandezza.mx</p>
                    <p class="text-xs text-slate-500">Horarios: Lun-Sáb 11:00 - 20:00</p>
                </div>
                <div class="rounded-xl overflow-hidden border border-slate-200 shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.492520889273!2d-99.1628167!3d19.4326071!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff36267c2d6b%3A0x2ca214a1f0c7e8e3!2sCentro%20Hist%C3%B3rico%20de%20la%20Ciudad%20de%20M%C3%A9xico%2C%2006000%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1700000000000!5m2!1ses-419!2smx"
                        width="100%" height="260" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <x-concierge-cta />
</x-layout-public>
