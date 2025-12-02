@extends('layouts.fest')
@section('title','Grandezza Fest 2025 | Festival de vino y música en Zempoala')
@section('description','Únete a la tercera edición de Grandezza Fest en Hacienda San Juan Pueblilla, Zempoala, Hidalgo. Vino, música, gastronomía y más. Entradas $500.')
@section('keywords','Grandezza Fest, festival de vino, vino en Hidalgo, eventos Zempoala, Hacienda San Juan Pueblilla, vino y música, catas de vino, evento gourmet, agosto 2025')
@section('image','https://grandezza.com.mx/img/banner-grandezza.jpg')
@section('url','https://grandezza.com.mx/fest')
@push('heads')
    <!--<script>
        window.onload = function() {
            alert('La venta de boletos para este evento se llevará a cabo diréctamente en la taquilla del evento');
        };
    </script>-->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Grandezza Fest 2025 – Música, vino y naturaleza">
    <meta name="twitter:description"
          content="Este 2 de agosto, vive una experiencia inolvidable en Zempoala. Música, gastronomía y más.">
    <meta name="twitter:image" content="{{asset('/img/banner-grandezza.jpg')}}">
    <script type="application/ld+json">
        @verbatim
        {
          "@context": "https://schema.org",
          "@type": "Event",
          "name": "Grandezza Fest 2025",
          "startDate": "2025-08-02T11:00:00-06:00",
          "endDate": "2025-08-02T23:59:00-06:00",
          "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
          "eventStatus": "https://schema.org/EventScheduled",
          "location": {
            "@type": "Place",
            "name": "Hacienda San Juan Pueblilla",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Domicilio Conocido Sn",
              "addressLocality": "Zempoala",
              "addressRegion": "Hidalgo",
              "postalCode": "24060",
              "addressCountry": "MX"
            }
          },
          "image": [
            "https://grandezza.com.mx/img/banner-grandezza.jpg"
          ],
          "description": "La tercera edición de Grandezza Fest, con catas, degustaciones, música y los mejores exponentes del vino.",
          "url": "https://grandezza.com.mx/fest",
          "organizer": {
            "@type": "Organization",
            "name": "Grandezza",
            "url": "https://grandezza.com.mx"
          }
        }
        @endverbatim
    </script>
    <script>
        function enviarEventoCompra() {
            gtag('event', 'compra_iniciada', {
                'event_category': 'boton',
                'event_label': 'compra grandezza',
                'value': 1
            });
        }

        // Helper function to delay opening a URL until a gtag event is sent.
        // Call it in response to an action that should navigate to a URL.
        function gtagSendEvent(url) {
            var callback = function () {
                if (typeof url === 'string') {
                    window.location = url;
                }
            };
            gtag('event', 'conversion_event_begin_checkout', {
                'event_callback': callback,
                'event_timeout': 2000,
                'items': [{
                    'id': 'producto123',
                    'name': 'Entrada General Grandezza Fest',
                    'quantity': 1,
                    'price': 500.00
                }],
                'currency': 'MXN',
                'value': 500.00
            });
            return false;
        }

    </script>
    <!--<script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script
        src="https://desk.zoho.com/portal/api/feedbackwidget/1156948000000362589?orgId=892657462&displayType=popout"></script>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

@endpush
@section('content')

    <!-- Hero -->
    <section class="relative bg-cover bg-center h-screen flex flex-col justify-center items-center text-center"
             style="background-image: url('/img/hacienda.webp');">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        <div class="relative z-10 max-w-4xl px-6 py-12 rounded-xl bg-black bg-opacity-40">
            <img src="/img/grandezza-fest.webp" alt="Grandezza Fest" class="img-fluid px-2 py-2 md:px-6 md:py-3 mt-4">
            <!--<h1 class="text-5xl md:text-7xl font-extrabold mb-4 tracking-wide">Grandezza Fest 2025</h1>-->
            <p class="text-3xl md:text-6xl mb-6 font-alt">Así celebramos el Vino</p>
            <!--<img src="/img/hacienda.webp" alt="Hacienda San Juan Pueblilla" class="-mt-12 img-fluid">-->
            <p class="text-xl md:text-2xl mb-8 tracking-wide">Cuarta edición de Grandezza Fest 2026</p>

            <!-- Countdown -->
            <div id="countdown" class="countdown mb-8"
                 aria-label="Cuenta regresiva para el evento Grandezza Fest">

            </div>

            <a href="#"
               onclick="fbq('track', 'InitiateCheckout'); gtag('event', 'compra_iniciada', {event_category: 'boleto', event_label: 'grandezza_fest'}); gtag('event','conversion_event_begin_checkout')"
               class="inline-block bg-amber-600 hover:bg-amber-600 text-white px-10 py-4 rounded-full text-lg md:text-xl shadow-lg transition">
                Próximamente
            </a>

        </div>
        <!-- Flecha para scroll -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2">
            <a href="#video" class="animate-bounce text-white">
                <!-- Icono de flecha (SVG) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>
    </section>
    <section class="bg-stone-800 py-25 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">

                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/5 text-stone-400">Música en vivo, DJ, lo mejor de la gastronomía y otras
                        sorpresas
                    </dt>
                    <dd class="order-first text-2xl font-semibold tracking-tight text-white sm:text-3xl">Vino, Música y
                        Gastronomía.
                    </dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/5 text-stone-400">Nacionales e internacionales de las mejores marcas</dt>
                    <dd class="order-first text-2xl font-semibold tracking-tight text-white sm:text-3xl">Degustaciones
                        de más de 100 etiquetas
                    </dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base/5 text-stone-400">Las catas se ofrecerán conforme a disponibilidad en los
                        espacios asignados.
                    </dt>
                    <dd class="order-first text-2xl font-semibold tracking-tight text-white sm:text-3xl">Catas guiadas
                        por expertos
                    </dd>
                </div>
            </dl>
        </div>
    </section>
    <!-- Patrocinadores
    <section class="py-16 px-6 bg-stone-800 dark:bg-black">
        <h2 class="text-4xl md:text-5xl mb-6 tracking-wide font-alt text-center">Patrocinadores</h2>
        <div class="swiper mySwiper max-w-7xl">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-01.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-02.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-03.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-04.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-05.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-08.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-09.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-10.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-11.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-12.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-13.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-14.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-15.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-16.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-17.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-18.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-19.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-20.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-21.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-06.webp" alt="Patrocinador"/></div>
                <div class="swiper-slide"><img src="/img/patrocinadores/logo-07.webp" alt="Patrocinador"/></div>
            </div>
        </div>
    </section>-->


    <!-- Video Promocional -->
    <section class="bg-stone-800 py-16 px-6 flex justify-center">
        <div class="w-full max-w-4xl aspect-video rounded-xl overflow-hidden shadow-lg">
            <iframe class="w-full h-full"
                    id="video"
                    src="https://www.youtube.com/embed/5HwWj7zwsu4"
                    title="Grandezza Fest 2025 - Reel"
                    frameborder="0"
                    allow="encrypted-media"
                    allowfullscreen>
            </iframe>
        </div>
    </section>


    <!-- Call to Action / Boletos -->
    <section id="boletos" class="py-20 px-6 bg-stone-900 text-center">
        <h2 class="text-4xl md:text-5xl mb-6 tracking-wide font-alt">Cuarta edición de Grandezza Fest</h2>
        <p class="text-sm md:text-lg max-w-4xl mx-auto mb-8 text-stone-200">
            Descubre el mejor evento dedicado al vino y los licores en un entorno espectacular. Vive catas exclusivas,
            música en vivo, gastronomía de primer nivel y un ambiente único en la Hacienda San Juan Pueblilla.
            Grandezza, tu tienda de vinos y licores favorita, te invita a esta gran celebración.
        </p>
        <a href="#"
           onclick="fbq('track', 'InitiateCheckout'); gtag('event', 'compra_iniciada', {event_category: 'boleto', event_label: 'grandezza_fest'}); gtag('event','conversion_event_begin_checkout')"
           class="inline-block bg-amber-600 text-white px-12 py-5 rounded-full font-regular text-large md:text-2xl shadow-lg hover:bg-amber-700 transition">
            Próximamente
        </a>
    </section>

    <!--<section id="faq" class="bg-white dark:bg-stone-800 py-16 px-4 sm:px-8 lg:px-24">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl md:text-5xl mb-6 tracking-wide font-alt text-center">Preguntas Frecuentes</h2>
            <div class="space-y-6">

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Dónde y cuándo se realiza el
                        evento?</h3>
                    <p class="text-stone-600 dark:text-stone-400">Grandezza Fest 2025 se llevará a cabo el <span
                            class="text-amber-600 dark:text-amber-400">sábado 2 de
                        agosto en la Hacienda San Juan Pueblilla</span>, ubicada en Zempoala, Hidalgo.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Costo del Boleto?</h3>
                    <p class="text-stone-600 dark:text-stone-400">La <span class="text-amber-600 dark:text-amber-400">preventa es de $500 pesos</span>,
                        el dia del evento
                        costará <b>$600 pesos</b>.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿A qué hora comienza y termina
                        el festival?</h3>
                    <p class="text-stone-600 dark:text-stone-400">La inauguración es a las 11:00 a.m. y el evento
                        concluirá aproximadamente a las 11:00 p.m.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Puedo comprar boletos en el
                        lugar?</h3>
                    <p class="text-stone-600 dark:text-stone-400">Si habrá taquilla en el evento, te recomendamos
                        adquirir en preventa tus boletos en línea a través de <a href="https://grandezza.com.mx/fest"
                                                                                 class="text-amber-600 dark:text-amber-400">grandezza.com.mx</a>,
                        ya que el cupo es limitado.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Habrá estacionamiento
                        disponible?</h3>
                    <p class="text-stone-600 dark:text-stone-400">Sí, contamos con <span
                            class="text-amber-600 dark:text-amber-400">estacionamiento sin costo</span> para
                        asistentes. Se
                        asignará por orden de llegada hasta agotar espacios.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Pueden asistir menores de
                        edad?</h3>
                    <p class="text-stone-600 dark:text-stone-400">El evento es para <span
                            class="text-amber-600 dark:text-amber-400">mayores de 18 años</span>. Se solicitará
                        identificación oficial en el acceso.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Qué incluye mi boleto?</h3>
                    <p class="text-stone-600 dark:text-stone-400">Tu boleto incluye acceso al evento, <span
                            class="text-amber-600 dark:text-amber-400">degustaciones de
                        más de 100 etiquetas</span> de vinos nacionales e internacionales, además de música en vivo y
                        sets de
                        DJ. </p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Puedo salir y volver a entrar
                        al evento?</h3>
                    <p class="text-stone-600 dark:text-stone-400">Si, se permite el reingreso al evento.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Qué pasa si llueve?</h3>
                    <p class="text-stone-600 dark:text-stone-400">Grandezza Fest se realiza sin importar las condiciones
                        climáticas. Te sugerimos venir preparado para el clima.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Habrá opciones de
                        alimentos?</h3>
                    <p class="text-stone-600 dark:text-stone-400">Sí, habrá diversas opciones disponibles a través de
                        nuestros socios comerciales, las cuales tendrán un costo adicional. Te invitamos a consultar
                        directamente con cada proveedor dentro del festival.</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-stone-700 dark:text-stone-200">¿Qué debo llevar al
                        evento?</h3>
                    <p class="text-stone-600 dark:text-stone-400">Es recomendable bloqueador solar, identificación
                        oficial y buen ánimo. No está permitido el ingreso con alimentos, bebidas, armas o drogas.</p>
                </div>

            </div>
        </div>
    </section>-->

    <!-- Mapa
    <section class="py-20 px-6 bg-stone-900">
        <h2 class="text-4xl md:text-5xl mb-6 tracking-wide font-alt text-center">¿Cómo llegar?</h2>
        <p class="text-xl md:text-2xl text-center tracking-wide">Hacienda San Juan Pueblilla · Zempoala,
            Hidalgo</p>
        <p class="text-white text-center mb-4">Domicilio Conocido Sn, Pueblilla, 24060 Zempoala, Hgo. <a
                class="btn underline" href="https://maps.app.goo.gl/GW5Z4dh2AMk4kAY98"
                target="_blank"><strong class="text-amber-500">Mapa</strong></a></p>
        <div class="w-full max-w-5xl mx-auto aspect-video rounded-xl overflow-hidden shadow-lg">
            <iframe
                class="w-full h-full"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3750.987015754603!2d-98.65529402300066!3d19.924951981462378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1baa6e0fb8ba1%3A0x27ced92115fc730e!2sHacienda%20San%20Juan%20Pueblilla!5e0!3m2!1ses!2smx!4v1750123853462!5m2!1ses!2smx"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Mapa de Hacienda San Juan Pueblilla"
            ></iframe>
        </div>
    </section>-->
    <!-- Hospedaje
    <section class="py-20 px-6 bg-stone-800">
        <h2 class="text-4xl md:text-5xl mb-6 tracking-wide font-alt text-center">Hospedaje Cercano</h2>
        <p class="text-center max-w-3xl mx-auto mb-12 text-stone-300 text-lg">
            Te recomendamos reservar con anticipación en hoteles y cabañas cercanas a Zempoala para una mejor
            experiencia. Aquí algunas opciones destacadas:
        </p>
        <ul class="max-w-3xl mx-auto space-y-6">
            <li class="bg-stone-800 p-6 rounded-xl shadow-lg flex justify-between items-center">
                <span>Holiday Inn Express Pachuca</span>
                <a href="https://maps.app.goo.gl/VG6sHUns2CvhwUqq6"
                   class="text-stone-500 hover:text-stone-400 font-semibold underline" rel="nofollow" target=" _blank">Ver
                    ubicación</a>
            </li>
            <li class="bg-stone-800 p-6 rounded-xl shadow-lg flex justify-between items-center">
                <span>Acueducto</span>
                <a href="https://maps.app.goo.gl/ygGbuKZrWeubEru97"
                   class="text-stone-500 hover:text-stone-400 font-semibold underline" rel="nofollow" target=" _blank">Ver
                    ubicación</a>
            </li>
            <li class="bg-stone-800 p-6 rounded-xl shadow-lg flex justify-between items-center">
                <span>Casa Azul</span>
                <a href="https://maps.app.goo.gl/TpnKzytbXPqX28K5A"
                   class="text-stone-500 hover:text-stone-400 font-semibold underline" rel="nofollow" target="_blank">Ver
                    ubicación</a>
            </li>
            <li class="bg-stone-800 p-6 rounded-xl shadow-lg flex justify-between items-center">
                <span>Real San Juan</span>
                <a href="https://maps.app.goo.gl/SxFVci5RXSxvzeJ77"
                   class="text-stone-500 hover:text-stone-400 font-semibold underline" rel="nofollow" target="_blank">Ver
                    ubicación</a>
            </li>
            <li class="bg-stone-800 p-6 rounded-xl shadow-lg flex justify-between items-center">
                <span>La Noria</span>
                <a href="https://maps.app.goo.gl/L6kUNHSMDJUPVT5y7"
                   class="text-stone-500 hover:text-stone-400 font-semibold underline" rel="nofollow" target="_blank">Ver
                    ubicación</a>
            </li>
            <li class="bg-stone-800 p-6 rounded-xl shadow-lg flex justify-between items-center">
                <span>Travesia Villas</span>
                <a href="https://maps.app.goo.gl/6ruk9KcT7NuRuh657"
                   class="text-stone-500 hover:text-stone-400 font-semibold underline" rel="nofollow" target="_blank">Ver
                    ubicación</a>
            </li>
        </ul>
    </section>-->
    <!-- Patrocinadores
    <section class="py-16 px-6 bg-stone-800 dark:bg-black">
        <h2 class="text-4xl md:text-5xl mb-6 tracking-wide font-alt text-center">Patrocinadores</h2>
        <div class="grid grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-6 items-center max-w-8xl mx-auto">
            <img src="/img/patrocinadores/logo-05.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-01.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-02.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-03.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-04.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-08.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-09.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-10.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-11.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-12.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-13.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-14.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-15.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-16.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-17.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-18.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-19.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-20.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-21.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-06.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
            <img src="/img/patrocinadores/logo-07.webp" alt="Patrocinador" class="h-22 object-contain mx-auto"/>
        </div>
    </section>-->
    <!--Boton flotante-->
    <a href="#"
       onclick="fbq('track', 'InitiateCheckout'); gtag('event', 'compra_iniciada', {event_category: 'boleto', event_label: 'grandezza_fest'}); gtag('event','conversion_event_begin_checkout')"
       class="hidden fixed ctaButton bottom-8 right-6 z-50 bg-amber-600 hover:bg-amber-700 text-white font-regular py-3 px-5 rounded-full shadow-lg transition-all duration-300 text-sm sm:text-base flex items-center gap-2">
        <!-- Ícono SVG de boleto -->
        <svg width="30px" height="30px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
            <path fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="32"
                  d="M366.05,146a46.7,46.7,0,0,1-2.42-63.42,3.87,3.87,0,0,0-.22-5.26L319.28,33.14a3.89,3.89,0,0,0-5.5,0l-70.34,70.34a23.62,23.62,0,0,0-5.71,9.24h0a23.66,23.66,0,0,1-14.95,15h0a23.7,23.7,0,0,0-9.25,5.71L33.14,313.78a3.89,3.89,0,0,0,0,5.5l44.13,44.13a3.87,3.87,0,0,0,5.26.22,46.69,46.69,0,0,1,65.84,65.84,3.87,3.87,0,0,0,.22,5.26l44.13,44.13a3.89,3.89,0,0,0,5.5,0l180.4-180.39a23.7,23.7,0,0,0,5.71-9.25h0a23.66,23.66,0,0,1,14.95-15h0a23.62,23.62,0,0,0,9.24-5.71l70.34-70.34a3.89,3.89,0,0,0,0-5.5l-44.13-44.13a3.87,3.87,0,0,0-5.26-.22A46.7,46.7,0,0,1,366.05,146Z"/>
            <line fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="32" stroke-linecap="round"
                  x1="250.5"
                  y1="140.44" x2="233.99" y2="123.93"/>
            <line fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="32" stroke-linecap="round"
                  x1="294.52"
                  y1="184.46" x2="283.51" y2="173.46"/>
            <line fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="32" stroke-linecap="round"
                  x1="338.54"
                  y1="228.49" x2="327.54" y2="217.48"/>
            <line fill="none" stroke="#FFFFFF" stroke-miterlimit="10" stroke-width="32" stroke-linecap="round"
                  x1="388.07"
                  y1="278.01" x2="371.56" y2="261.5"/>
        </svg>
        Próximamente
    </a>

    <!-- Incluye Alpine.js si no lo tienes -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- FAB flotante para compartir -->
    <div x-data="{ open: false }" class="fixed bottom-5 left-5 z-50">
        <!-- Botones sociales -->
        <div x-show="open" class="flex flex-col items-end space-y-2 mb-2" x-transition>
            <!-- WhatsApp -->
            <a href="https://api.whatsapp.com/send?text=¡No te pierdas este evento! https://grandezza.com.mx/fest"
               target="_blank"
               class="bg-primary hover:bg-secondary text-white p-3 rounded-full shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M20.52 3.48A11.93 11.93 0 0012 0C5.37 0 0 5.37 0 12a11.9 11.9 0 001.63 6L0 24l6.37-1.66A11.9 11.9 0 0012 24c6.63 0 12-5.37 12-12a11.93 11.93 0 00-3.48-8.52zM12 22c-1.6 0-3.13-.37-4.5-1.05l-.32-.17-3.77.98 1-3.65-.2-.34A9.87 9.87 0 012 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.45-7.24c-.3-.15-1.77-.87-2.05-.96-.27-.1-.47-.15-.66.15s-.76.96-.93 1.16c-.17.2-.34.22-.63.07a8.28 8.28 0 01-2.43-1.5 9.22 9.22 0 01-1.7-2.13c-.18-.3 0-.46.13-.6.13-.13.3-.34.44-.5.15-.17.2-.29.3-.49.1-.2.05-.37-.02-.52-.08-.15-.66-1.6-.91-2.2-.24-.6-.49-.5-.66-.5-.17 0-.37-.02-.57-.02s-.52.07-.8.37c-.27.3-1.04 1.02-1.04 2.5 0 1.47 1.07 2.9 1.22 3.1.15.2 2.11 3.22 5.1 4.51.71.3 1.26.48 1.7.61.72.23 1.37.2 1.88.12.58-.08 1.77-.72 2.02-1.42.25-.7.25-1.29.17-1.42-.09-.13-.27-.2-.57-.35z"/>
                </svg>
            </a>

            <!-- Facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://grandezza.com.mx/fest"
               target="_blank"
               class="bg-primary hover:bg-secondary text-white p-3 rounded-full shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M22.675 0H1.325C.593 0 0 .593 0 1.326v21.348C0 23.406.593 24 1.325 24h11.495v-9.294H9.692V11.01h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.464.099 2.795.143v3.24h-1.918c-1.504 0-1.796.716-1.796 1.765v2.314h3.59l-.467 3.696h-3.123V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.675 0z"/>
                </svg>
            </a>

            <!-- Twitter / X -->
            <a href="https://twitter.com/intent/tweet?text=¡No te pierdas este evento!&url=https://grandezza.com.mx/fest"
               target="_blank"
               class="bg-primary hover:bg-secondary text-white p-3 rounded-full shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M22.46 6c-.77.35-1.6.58-2.46.69a4.22 4.22 0 001.84-2.33 8.27 8.27 0 01-2.65 1.02A4.14 4.14 0 0015.5 4c-2.28 0-4.13 1.86-4.13 4.15 0 .33.03.66.1.97-3.44-.17-6.49-1.83-8.54-4.34a4.15 4.15 0 00-.56 2.09c0 1.44.73 2.7 1.84 3.44a4.08 4.08 0 01-1.87-.52v.05c0 2.01 1.42 3.69 3.3 4.07a4.2 4.2 0 01-1.85.07c.52 1.64 2.02 2.84 3.8 2.88A8.3 8.3 0 012 19.54a11.68 11.68 0 006.29 1.84c7.55 0 11.68-6.26 11.68-11.68l-.01-.53A8.18 8.18 0 0024 5.56a8.3 8.3 0 01-2.36.65 4.1 4.1 0 001.8-2.27z"/>
                </svg>
            </a>
        </div>

        <!-- Botón FAB principal -->
        <button @click="open = !open"
                class="bg-primary hover:bg-secondary text-white p-4 rounded-full shadow-xl focus:outline-none transition-all">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>


    <!-- Footer -->
    <footer class="bg-black text-stone-400 text-center py-8">
        <p>&copy; 2025 Grandezza Fest · Todos los derechos reservados</p>
    </footer>

@endsection

@push('scripts')
    <script>
        // Countdown script
        function countdown() {
            const countdownElement = document.getElementById('countdown');
            const eventDate = new Date('August 2, 2025 12:00:00').getTime();

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = eventDate - now;

                if (distance < 0) {
                    countdownElement.innerHTML = '<!--<p class="text-2xl font-bold text-stone-600 text-white">¡El evento ya comenzó!</p>-->';
                    clearInterval(interval);
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownElement.innerHTML = `
          <div class="bg-amber-600"><span>${days}</span><small>días</small></div>
          <div class="bg-amber-600"><span>${hours.toString().padStart(2, '0')}</span><small>horas</small></div>
          <div class="bg-amber-600"><span>${minutes.toString().padStart(2, '0')}</span><small>minutos</small></div>
          <div class="bg-amber-600"><span>${seconds.toString().padStart(2, '0')}</span><small>segundos</small></div>
        `;
            }

            updateCountdown();
            const interval = setInterval(updateCountdown, 1000);
        }

        countdown();
    </script>
    <!--<script type="text/javascript">
        var exampleCallback = function () {
            console.log('Order complete!');
        };

        window.EBWidgets.createWidget({
            widgetType: 'checkout',
            eventId: '1466057159429',
            modal: true,
            modalTriggerElementId: 'eventbrite-widget-modal-trigger-1466057159429',
            onOrderComplete: exampleCallback
        });
    </script>-->
    <script>
        const ctaButton = document.querySelector('.ctaButton');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 600) {
                ctaButton.classList.remove('hidden');
                ctaButton.classList.add('block');
            } else {
                ctaButton.classList.remove('block');
                ctaButton.classList.add('hidden');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 10,
            freeMode: true,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            lazy: true,

            breakpoints: {
                '@0.00': {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                '@0.75': {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                '@1.00': {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
                '@1.50': {
                    slidesPerView: 6,
                    spaceBetween: 40,
                },
            },
        });
    </script>

@endpush
@section('styles')
    <style type="text/css">
        /* Countdown styles */
        .countdown {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 2rem;
        }

        .countdown > div {

            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            text-align: center;
            min-width: 70px;
            box-shadow: 0 4px 8px rgb(185 28 28 / 0.5);

        }

        .countdown > div span {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .countdown > div small {
            display: block;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #fbdfcc;
        }

        .font-alt {
            color: #bb8a69;
        }

        @media (max-width: 768px) {
            .countdown {
                display: none;
            }

        }

        /* Swiper */
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection
