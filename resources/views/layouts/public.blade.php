<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Vinatería') }}</title>
    <meta name="description" content="{{ $metaDescription ?? '' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        .swiper-pagination-bullet {
            background: #d6d6d6;
            opacity: 1;
        }
        .swiper-pagination-bullet-active {
            background: #7f1d1d;
        }
        .swiper-button-next,
        .swiper-button-prev {
            color: #7f1d1d;
        }
    </style>

    @stack('styles')

    <!-- Google Analytics 4 -->
    @if(env('GA_MEASUREMENT_ID'))
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ env('GA_MEASUREMENT_ID') }}');
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA_MEASUREMENT_ID') }}"></script>
    @endif

    <!-- Meta Pixel -->
    @if(env('META_PIXEL_ID'))
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ env('META_PIXEL_ID') }}');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ env('META_PIXEL_ID') }}&ev=PageView&noscript=1"/></noscript>
    @endif
</head>
<body class="bg-white text-slate-900 antialiased" style="font-family: 'Montserrat', system-ui, -apple-system, sans-serif;">
    <div
        class="min-h-screen flex flex-col"
        x-data="{
            ageVerified: localStorage.getItem('ageVerified') === 'true',
            cookiesAccepted: localStorage.getItem('cookiesAccepted') === 'true',
            cartOpen: false
        }"
        x-init="
            $watch('ageVerified', v => { if(v) localStorage.setItem('ageVerified','true'); });
            $watch('cookiesAccepted', v => { if(v) localStorage.setItem('cookiesAccepted','true'); });
        "
    >
        <div x-cloak x-show="!ageVerified" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 space-y-4 text-center">
                <p class="text-sm uppercase tracking-[0.2em] text-rose-700">Verificación</p>
                <h2 class="text-2xl font-semibold text-rose-950" style="font-family: 'Playfair Display', serif;">¿Tienes edad legal para consumir alcohol?</h2>
                <p class="text-sm text-slate-600">Debes confirmar que eres mayor de edad para ingresar.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button @click="ageVerified = true" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-rose-900 text-white text-sm font-semibold hover:bg-rose-800 focus:outline-none focus:ring-2 focus:ring-rose-300">
                        Sí, soy mayor de edad
                    </button>
                    <a href="https://www.alcohol.org/es/" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        No, salir
                    </a>
                </div>
                <p class="text-xs text-slate-500">Al continuar aceptas nuestros términos y aviso de privacidad.</p>
            </div>
        </div>
        <div class="bg-black text-white text-xs tracking-[0.18em] uppercase">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-10 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 text-rose-200">
                    <a href="#" aria-label="Instagram" class="hover:text-white">IG</a>
                    <a href="#" aria-label="Facebook" class="hover:text-white">FB</a>
                    <a href="#" aria-label="TikTok" class="hover:text-white">TT</a>
                </div>
                <div class="text-rose-100">Evita el exceso</div>
            </div>
        </div>
        <div x-data="{ open: false }" class="relative">
            <header class="bg-white sticky top-0 z-40 border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <a href="{{ url('/') }}" class="flex items-center gap-2">
                            <div class="h-10 w-10 rounded-full bg-rose-900 text-white flex items-center justify-center font-semibold" style="font-family: 'Playfair Display', serif;">
                                V
                            </div>
                            <div class="flex flex-col leading-tight">
                                <span class="text-lg font-semibold text-rose-900" style="font-family: 'Playfair Display', serif;">Grandezza</span>
                                <span class="text-xs uppercase tracking-wide text-slate-500">Vinatería</span>
                            </div>
                        </a>
                        <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-900">
                            <a href="{{ url('/') }}" class="hover:text-rose-900 transition">Home</a>
                            <a href="{{ url('/vinos') }}" class="hover:text-rose-900 transition">Vinos</a>
                            <a href="{{ url('/categorias') }}" class="hover:text-rose-900 transition">Categorías</a>
                            <a href="{{ url('/nosotros') }}" class="hover:text-rose-900 transition">Nosotros</a>
                            <a href="{{ url('/contacto') }}" class="hover:text-rose-900 transition">Contacto</a>
                            <form action="{{ url('/vinos') }}" method="GET" class="relative">
                                <input type="text" name="q" placeholder="Buscar vinos" class="pl-3 pr-9 py-2 rounded-full border border-slate-300 bg-white text-sm text-slate-900 focus:border-rose-700 focus:ring-rose-700">
                                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-600 hover:text-rose-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <circle cx="11" cy="11" r="7" stroke-width="1.5"></circle>
                                        <path d="m20 20-3.5-3.5" stroke-width="1.5" stroke-linecap="round"></path>
                                    </svg>
                                </button>
                            </form>
                            <button type="button" @click="cartOpen = true" class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-black text-white hover:bg-rose-900 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                Carrito
                            </button>
                        </nav>
                        <div class="md:hidden">
                            <button @click="open = !open" class="p-2 rounded-md border border-slate-200 text-slate-600 focus:outline-none focus:ring-2 focus:ring-rose-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="md:hidden border-t border-slate-200 px-4 py-2">
                    <form action="{{ url('/vinos') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Buscar vinos" class="w-full pl-3 pr-9 py-2 rounded-full border border-slate-300 bg-white text-sm text-slate-900 focus:border-rose-700 focus:ring-rose-700">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-600 hover:text-rose-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="7" stroke-width="1.5"></circle>
                                <path d="m20 20-3.5-3.5" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                        </button>
                    </form>
                </div>
                <div x-show="open" x-transition class="md:hidden bg-white border-t border-slate-200">
                    <div class="px-4 py-3 space-y-3">
                        <a href="{{ url('/') }}" class="block py-2 text-slate-900 hover:text-rose-900">Home</a>
                        <a href="{{ url('/vinos') }}" class="block py-2 text-slate-900 hover:text-rose-900">Vinos</a>
                        <a href="{{ url('/categorias') }}" class="block py-2 text-slate-900 hover:text-rose-900">Categorías</a>
                        <a href="{{ url('/nosotros') }}" class="block py-2 text-slate-900 hover:text-rose-900">Nosotros</a>
                        <a href="{{ url('/contacto') }}" class="block py-2 text-slate-900 hover:text-rose-900">Contacto</a>
                        <button type="button" @click="cartOpen = true" class="block text-left w-full py-2 text-slate-900 hover:text-rose-900 inline-flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            Carrito
                        </button>
                        <form action="{{ url('/vinos') }}" method="GET" class="relative">
                            <input type="text" name="q" placeholder="Buscar vinos" class="w-full pl-3 pr-9 py-2 rounded-full border border-slate-300 bg-white text-sm text-slate-900 focus:border-rose-700 focus:ring-rose-700">
                            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-600 hover:text-rose-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <circle cx="11" cy="11" r="7" stroke-width="1.5"></circle>
                                    <path d="m20 20-3.5-3.5" stroke-width="1.5" stroke-linecap="round"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
        </div>

        <main class="flex-1">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                @if(session('success'))
                    <x-flash-message type="success" :message="session('success')" />
                @endif
                @if(session('error'))
                    <x-flash-message type="error" :message="session('error')" />
                @endif
            </div>
            {{ $slot ?? '' }}
        </main>

        <footer class="bg-black text-white mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="h-10 w-10 rounded-full bg-rose-900 text-white flex items-center justify-center font-semibold" style="font-family: 'Playfair Display', serif;">V</div>
                        <div class="text-lg font-semibold" style="font-family: 'Playfair Display', serif;">Grandezza</div>
                    </div>
                    <p class="text-sm text-slate-200/80">Selección curada de vinos premium con recolección en tienda.</p>
                </div>
                <div>
                    <h4 class="text-sm uppercase tracking-wide text-slate-200 mb-3">Contacto</h4>
                    <ul class="space-y-2 text-sm text-slate-100">
                        <li>Tel: (55) 1234 5678</li>
                        <li>Email: hola@grandezza.mx</li>
                        <li>Dirección: Av. Vino 123, CDMX</li>
                        <li>Horarios: Lun-Sáb 11:00 - 20:00</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm uppercase tracking-wide text-slate-200 mb-3">Explorar</h4>
                    <ul class="space-y-2 text-sm text-slate-100">
                        <li><a class="hover:text-rose-300 transition" href="{{ url('/vinos') }}">Vinos</a></li>
                        <li><a class="hover:text-rose-300 transition" href="{{ url('/categorias') }}">Categorías</a></li>
                        <li><a class="hover:text-rose-300 transition" href="{{ url('/promociones') }}">Promociones</a></li>
                        <li><a class="hover:text-rose-300 transition" href="{{ url('/bolsa') }}">Bolsa de trabajo</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm uppercase tracking-wide text-slate-200 mb-3">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-100">
                        <li><a class="hover:text-rose-300 transition" href="{{ url('/terminos') }}">Términos</a></li>
                        <li><a class="hover:text-rose-300 transition" href="{{ url('/privacidad') }}">Privacidad</a></li>
                    </ul>
                    <div class="mt-4 flex gap-3 text-rose-200">
                        <a href="#" aria-label="Instagram" class="hover:text-rose-400 transition">IG</a>
                        <a href="#" aria-label="Facebook" class="hover:text-rose-400 transition">FB</a>
                        <a href="#" aria-label="TikTok" class="hover:text-rose-400 transition">TT</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-300">
                    <span>© {{ date('Y') }} Grandezza Vinatería. Todos los derechos reservados.</span>
                    <span class="mt-2 sm:mt-0">Hecho con gusto por el equipo Grandezza.</span>
                </div>
            </div>
        </footer>

        <div x-cloak x-show="!cookiesAccepted" class="fixed inset-x-0 bottom-0 z-40">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-4">
                <div class="bg-white border border-slate-200 shadow-xl rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold text-rose-950">Usamos cookies 🍪</p>
                        <p class="text-sm text-slate-600">Utilizamos cookies para mejorar tu experiencia, analizar el tráfico y personalizar contenido. Revisa nuestro aviso de privacidad.</p>
                        <div class="flex gap-3 text-xs text-rose-900">
                            <a href="{{ url('/privacidad') }}" class="hover:underline">Privacidad</a>
                            <a href="{{ url('/terminos') }}" class="hover:underline">Términos</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3 justify-end">
                        <button @click="cookiesAccepted = true" class="px-4 py-2 rounded-lg bg-rose-900 text-white text-sm font-semibold hover:bg-rose-800 focus:outline-none focus:ring-2 focus:ring-rose-300">
                            Aceptar
                        </button>
                        <button @click="cookiesAccepted = true" class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Rechazar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <x-cart-drawer />
    </div>

    @stack('scripts')
</body>
</html>
