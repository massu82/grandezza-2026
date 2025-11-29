<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/webp" href="{{ asset('img/favicon.webp') }}">

    <title>{{ $title ?? config('app.name', 'Vinatería') }}</title>
    <meta name="description" content="{{ $metaDescription ?? '' }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
@php
    $isNavidad = now()->month === 12;
    $cartCount = collect(session('cart', []))->sum('quantity') ?: 0;
@endphp
<body class="bg-white text-zinc-900 antialiased font-body">
    <div
        class="min-h-screen flex flex-col"
        x-data="{
            ageVerified: localStorage.getItem('ageVerified') === 'true',
            cookiesAccepted: localStorage.getItem('cookiesAccepted') === 'true',
            cartOpen: false,
        }"
        @cart-open.window="cartOpen = true"
        x-init="
            $watch('ageVerified', v => { if(v) localStorage.setItem('ageVerified','true'); });
            $watch('cookiesAccepted', v => { if(v) localStorage.setItem('cookiesAccepted','true'); });
        "
    >
        <div x-cloak x-show="!ageVerified" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 space-y-4 text-center">
                <p class="text-sm uppercase tracking-[0.2em] text-secondary">Verificación</p>
                <h2 class="text-2xl font-semibold text-primary" style="font-family: 'Playfair Display', serif;">¿Tienes edad legal para consumir alcohol?</h2>
                <p class="text-sm text-zinc-600">Debes confirmar que eres mayor de edad para ingresar.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button @click="ageVerified = true" class="btn-primary">
                        Sí, soy mayor de edad
                    </button>
                    <a href="https://www.alcohol.org/es/" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-zinc-200 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                        No, salir
                    </a>
                </div>
                <p class="text-xs text-zinc-500">Al continuar aceptas nuestros términos y aviso de privacidad.</p>
            </div>
        </div>
        <div x-data="{ open: false }" class="sticky top-0 z-50 w-full bg-white">
            <div class="bg-zinc-950 text-white text-xs tracking-[0.18em] uppercase">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-10 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 text-accent">
                        <a href="#" aria-label="Instagram" class="hover:text-white">
                            <img src="{{ asset('icons/instagram.svg') }}" alt="Instagram" class="w-5 h-5 invert">
                        </a>
                        <a href="#" aria-label="Facebook" class="hover:text-white">
                            <img src="{{ asset('icons/facebook.svg') }}" alt="Facebook" class="w-5 h-5 invert">
                        </a>
                        <a href="#" aria-label="X" class="hover:text-white">
                            <img src="{{ asset('icons/icons-x.svg') }}" alt="X" class="w-5 h-5 invert">
                        </a>
                    </div>
                    <div class="text-white">Evita el exceso</div>
                </div>
            </div>
            <div class="bg-zinc-100 text-accent text-sm py-2 border-b border-zinc-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2">
                    <x-heroicon-s-shopping-bag class="w-5 h-5" aria-hidden="true" />
                    <span class="font-semibold">Compra en línea y recoge en tienda</span>
                </div>
            </div>
            <div class="relative bg-white border-b border-zinc-200">
                <header>
                    @if($isNavidad)
                        <div class="bg-accent/10 text-dark text-sm py-2">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-2">
                                <span aria-hidden="true">🎄</span>
                                <span class="font-semibold">Felices fiestas: compra en línea y recoge en tienda.</span>
                                <span aria-hidden="true">🎁</span>
                            </div>
                        </div>
                    @endif
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <a href="{{ url('/') }}" class="flex items-center gap-2">
                            <img src="{{ asset('img/logo-dark.webp') }}" alt="Grandezza" class="h-12 w-auto">
                            <span class="sr-only">Grandezza</span>
                        </a>
                        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-zinc-900 uppercase tracking-wide">
                            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
                            <a href="{{ url('/vinos') }}" class="hover:text-primary transition">Vinos</a>
                            <a href="{{ url('/categorias') }}" class="hover:text-primary transition">Categorías</a>
                            <a href="{{ url('/nosotros') }}" class="hover:text-primary transition">Nosotros</a>
                            <a href="{{ url('/contacto') }}" class="hover:text-primary transition">Contacto</a>
                            <form action="{{ url('/vinos') }}" method="GET" class="relative">
                                <input type="text" name="q" placeholder="Buscar vinos" class="pl-3 pr-9 py-2 rounded-full border border-zinc-300 bg-white text-sm text-dark focus:border-primary focus:ring-accent">
                                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-zinc-600 hover:text-primary">
                                    <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                                </button>
                            </form>
                            <button type="button" @click="cartOpen = true" class="relative inline-flex items-center gap-2 px-3 py-2 rounded-full bg-black text-white hover:bg-primary transition" aria-label="Carrito">
                                <x-heroicon-o-shopping-bag class="w-5 h-5" />
                                @if($cartCount > 0)
                                    <span class="absolute -top-1 -right-1 inline-flex items-center justify-center w-5 h-5 rounded-full bg-accent text-zinc-900 text-xs font-bold">{{ $cartCount }}</span>
                                @endif
                            </button>
                        </nav>
                        <div class="md:hidden">
                            <button @click="open = !open" class="p-2 rounded-md border border-zinc-200 text-zinc-600 focus:outline-none focus:ring-2 focus:ring-accent">
                                <x-heroicon-o-bars-3 class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </div>
                <div class="md:hidden border-t border-zinc-200 px-4 py-2">
                    <form action="{{ url('/vinos') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Buscar vinos" class="w-full pl-3 pr-9 py-2 rounded-full border border-zinc-300 bg-white text-sm text-dark focus:border-primary focus:ring-accent">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-zinc-600 hover:text-primary">
                            <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                        </button>
                    </form>
                </div>
                <div x-show="open" x-transition class="md:hidden bg-white border-t border-zinc-200">
                    <div class="px-4 py-3 space-y-3">
                        <a href="{{ url('/') }}" class="block py-2 text-zinc-900 hover:text-primary">Home</a>
                        <a href="{{ url('/vinos') }}" class="block py-2 text-zinc-900 hover:text-primary">Vinos</a>
                        <a href="{{ url('/categorias') }}" class="block py-2 text-zinc-900 hover:text-primary">Categorías</a>
                        <a href="{{ url('/nosotros') }}" class="block py-2 text-zinc-900 hover:text-primary">Nosotros</a>
                        <a href="{{ url('/contacto') }}" class="block py-2 text-zinc-900 hover:text-primary">Contacto</a>
                        <button type="button" @click="cartOpen = true" class="relative block text-left w-full py-2 text-zinc-900 hover:text-primary inline-flex items-center gap-2" aria-label="Carrito">
                            <x-heroicon-o-shopping-bag class="w-5 h-5" />
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 inline-flex items-center justify-center w-5 h-5 rounded-full bg-accent text-zinc-900 text-xs font-bold">{{ $cartCount }}</span>
                            @endif
                        </button>
                        <form action="{{ url('/vinos') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Buscar vinos" class="w-full pl-3 pr-9 py-2 rounded-full border border-zinc-300 bg-white text-sm text-dark focus:border-primary focus:ring-accent">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-zinc-600 hover:text-primary">
                                <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                            </button>
                        </form>
                    </div>
                </div>
            </header>
        </div>

        <main class="flex-1 bg-light">
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

        <footer class="bg-gradient-to-b from-zinc-900 via-zinc-950 to-zinc-900 text-white mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <img src="{{ asset('img/logo-white.webp') }}" alt="Grandezza" class="h-12 w-auto">
                    </div>
                    <p class="text-sm text-zinc-200/80">Selección curada de vinos premium con recolección en tienda.</p>
                </div>
                <div>
                    <h4 class="text-sm uppercase tracking-wide text-accent mb-3">Contacto</h4>
                    <ul class="space-y-2 text-sm text-zinc-100">
                        <li class="flex items-center gap-2">
                            <x-heroicon-o-phone class="w-5 h-5" />
                            <span>Tel: {{ $appSettings['telefono'] ?? '(55) 1234 5678' }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <x-heroicon-o-envelope class="w-5 h-5" />
                            <span>Email: {{ $appSettings['email'] ?? 'hola@grandezza.mx' }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <x-heroicon-o-map-pin class="w-5 h-5" />
                            <span>Dirección: {{ $appSettings['direccion'] ?? 'Av. Vino 123, CDMX' }}</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <x-heroicon-o-clock class="w-5 h-5" />
                            <span>Horarios: {{ $appSettings['horarios'] ?? 'Lun-Sáb 11:00 - 20:00' }}</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm uppercase tracking-wide text-accent mb-3">Explorar</h4>
                    <ul class="space-y-2 text-sm text-zinc-100">
                        <li><a class="hover:text-accent transition" href="{{ url('/vinos') }}">Vinos</a></li>
                        <li><a class="hover:text-accent transition" href="{{ url('/categorias') }}">Categorías</a></li>
                        <li><a class="hover:text-accent transition" href="{{ url('/promociones') }}">Promociones</a></li>
                        <li><a class="hover:text-accent transition" href="{{ url('/bolsa') }}">Bolsa de trabajo</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm uppercase tracking-wide text-accent mb-3">Legal</h4>
                    <ul class="space-y-2 text-sm text-zinc-100">
                        <li><a class="hover:text-accent transition" href="{{ url('/terminos') }}">Términos</a></li>
                        <li><a class="hover:text-accent transition" href="{{ url('/privacidad') }}">Privacidad</a></li>
                    </ul>
                    <div class="mt-4 flex gap-3 text-accent">
                        <a href="#" aria-label="Instagram" class="hover:text-white transition flex items-center">
                            <img src="{{ asset('icons/instagram.svg') }}" alt="Instagram" class="w-5 h-5 invert">
                        </a>
                        <a href="#" aria-label="Facebook" class="hover:text-white transition flex items-center">
                            <img src="{{ asset('icons/facebook.svg') }}" alt="Facebook" class="w-5 h-5 invert">
                        </a>
                        <a href="#" aria-label="X" class="hover:text-white transition flex items-center">
                            <img src="{{ asset('icons/icons-x.svg') }}" alt="X" class="w-5 h-5 invert">
                        </a>
                        <a href="#" aria-label="WhatsApp" class="hover:text-white transition flex items-center">
                            <img src="{{ asset('icons/whatsapp.svg') }}" alt="WhatsApp" class="w-5 h-5 invert">
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-zinc-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between text-xs text-zinc-300">
                    <span>© {{ date('Y') }} Grandezza Vinatería. Todos los derechos reservados.</span>
                    <span class="mt-2 sm:mt-0">Hecho con gusto por el equipo Grandezza.</span>
                </div>
            </div>
        </footer>

        <div x-cloak x-show="!cookiesAccepted" class="fixed inset-x-0 bottom-0 z-40">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-4">
                <div class="bg-white border border-zinc-200 shadow-xl rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold text-primary">Usamos cookies 🍪</p>
                        <p class="text-sm text-zinc-600">Utilizamos cookies para mejorar tu experiencia, analizar el tráfico y personalizar contenido. Revisa nuestro aviso de privacidad.</p>
                        <div class="flex gap-3 text-xs text-primary">
                            <a href="{{ url('/privacidad') }}" class="hover:underline">Privacidad</a>
                            <a href="{{ url('/terminos') }}" class="hover:underline">Términos</a>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3 justify-end">
                        <button @click="cookiesAccepted = true" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-accent">
                            Aceptar
                        </button>
                        <button @click="cookiesAccepted = true" class="px-4 py-2 rounded-lg border border-zinc-200 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                            Rechazar
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <x-cart-drawer />
    </div>

    <div x-data="{ visible: false }" x-init="window.addEventListener('scroll', () => { visible = window.scrollY > 240; })" class="fixed bottom-6 right-6 z-[999]">
        <button
            x-show="visible"
            x-transition
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="flex items-center justify-center w-10 h-10 bg-zinc-800 text-white text-base font-semibold rounded-full shadow-lg hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-zinc-300 focus:ring-offset-2 focus:ring-offset-white"
            aria-label="Volver arriba"
            type="button"
        >
            ↑
        </button>
    </div>

    @stack('scripts')
</body>
</html>
