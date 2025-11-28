<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Panel | ' . config('app.name', 'Vinatería') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 antialiased" style="font-family: 'Montserrat', system-ui, -apple-system, sans-serif;">
    <div x-data="{ open: false }" class="min-h-screen flex">
        <aside class="bg-white shadow-md w-64 border-r border-slate-200 hidden md:flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-slate-100">
                <div>
                    <div class="text-xl font-semibold text-rose-900" style="font-family: 'Playfair Display', serif;">Grandezza</div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Panel</div>
                </div>
            </div>
            <nav class="flex-1 py-6 space-y-1 text-sm">
                <a href="{{ url('/admin') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Dashboard</a>
                <a href="{{ url('/admin/products') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Productos</a>
                <a href="{{ url('/admin/categories') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Categorías</a>
                <a href="{{ url('/admin/promotions') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Promociones</a>
                <a href="{{ url('/admin/orders') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Pedidos</a>
                <a href="{{ url('/admin/pages') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Páginas</a>
                <a href="{{ url('/admin/leads') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Leads</a>
                <a href="{{ url('/admin/candidates') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Candidatos</a>
                <a href="{{ url('/admin/settings') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-rose-50 text-slate-700">Ajustes</a>
            </nav>
            <div class="p-6 text-xs text-slate-400 border-t border-slate-100">Sesión: {{ auth()->user()->name ?? 'Admin' }}</div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <button class="md:hidden p-2 rounded-md border border-slate-200 text-slate-600" @click="open = !open">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="text-sm text-slate-500">Panel de administración</div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-sm text-slate-600">{{ auth()->user()->email ?? 'admin@example.com' }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-rose-900 hover:text-rose-700">Cerrar sesión</button>
                    </form>
                </div>
            </header>

            <div class="md:hidden" x-show="open" x-transition>
                <div class="bg-white border-b border-slate-200 shadow-sm">
                    <nav class="py-2 space-y-1 text-sm">
                        <a href="{{ url('/admin') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Dashboard</a>
                        <a href="{{ url('/admin/products') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Productos</a>
                        <a href="{{ url('/admin/categories') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Categorías</a>
                        <a href="{{ url('/admin/promotions') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Promociones</a>
                        <a href="{{ url('/admin/orders') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Pedidos</a>
                        <a href="{{ url('/admin/pages') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Páginas</a>
                        <a href="{{ url('/admin/leads') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Leads</a>
                        <a href="{{ url('/admin/candidates') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Candidatos</a>
                        <a href="{{ url('/admin/settings') }}" class="block px-4 py-2 hover:bg-rose-50 text-slate-700">Ajustes</a>
                    </nav>
                </div>
            </div>

            <main class="flex-1 p-4 md:p-6">
                @if(session('success'))
                    <x-flash-message type="success" :message="session('success')" />
                @endif
                @if(session('error'))
                    <x-flash-message type="error" :message="session('error')" />
                @endif
                {{ $slot ?? '' }}
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
