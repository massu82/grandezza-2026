<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Panel | ' . config('app.name', 'Vinatería') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 antialiased font-body">
    <div x-data="{ open: false }" class="min-h-screen flex">
        <aside class="bg-white shadow-md w-64 border-r border-slate-200 hidden md:flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-slate-100">
                <img src="{{ asset('img/logo-dark.webp') }}" alt="Grandezza" class="h-12 w-auto">
            </div>
            <nav class="flex-1 py-6 space-y-1 text-sm">
                <a href="{{ url('/admin') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-home class="w-5 h-5" /> Dashboard
                </a>
                <a href="{{ url('/admin/products') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-cube class="w-5 h-5" /> Productos
                </a>
                <a href="{{ url('/admin/categories') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-rectangle-stack class="w-5 h-5" /> Categorías
                </a>
                <a href="{{ url('/admin/promotions') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-sparkles class="w-5 h-5" /> Promociones
                </a>
                <a href="{{ url('/admin/orders') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-clipboard-document-list class="w-5 h-5" /> Pedidos
                </a>
                <a href="{{ url('/admin/pages') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-document-text class="w-5 h-5" /> Páginas
                </a>
                <a href="{{ url('/admin/leads') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-user-plus class="w-5 h-5" /> Leads
                </a>
                <a href="{{ url('/admin/candidates') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-users class="w-5 h-5" /> Candidatos
                </a>
                <a href="{{ url('/admin/settings') }}" class="px-6 py-2 flex items-center gap-2 hover:bg-light text-slate-700">
                    <x-heroicon-o-cog-6-tooth class="w-5 h-5" /> Ajustes
                </a>
            </nav>
            <div class="p-6 text-xs text-slate-400 border-t border-slate-100">Sesión: {{ auth()->user()->name ?? 'Admin' }}</div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <button class="md:hidden p-2 rounded-md border border-slate-200 text-slate-600" @click="open = !open">
                        <x-heroicon-o-bars-3 class="w-5 h-5" />
                    </button>
                    <div class="text-sm text-slate-500">Panel de administración</div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-sm text-slate-600">{{ auth()->user()->email ?? 'admin@example.com' }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-primary hover:text-secondary">Cerrar sesión</button>
                    </form>
                </div>
            </header>

            <div class="md:hidden" x-show="open" x-transition>
                <div class="bg-white border-b border-slate-200 shadow-sm">
                    <nav class="py-2 space-y-1 text-sm">
                        <a href="{{ url('/admin') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Dashboard</a>
                        <a href="{{ url('/admin/products') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Productos</a>
                        <a href="{{ url('/admin/categories') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Categorías</a>
                        <a href="{{ url('/admin/promotions') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Promociones</a>
                        <a href="{{ url('/admin/orders') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Pedidos</a>
                        <a href="{{ url('/admin/pages') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Páginas</a>
                        <a href="{{ url('/admin/leads') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Leads</a>
                        <a href="{{ url('/admin/candidates') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Candidatos</a>
                        <a href="{{ url('/admin/settings') }}" class="block px-4 py-2 hover:bg-light text-slate-700">Ajustes</a>
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

    <div
        x-data
        x-init="
            @if(session('success'))
                window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: @js(session('success')) } }));
            @endif
            @if(session('error'))
                window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: @js(session('error')) } }));
            @endif
        "
        class="fixed top-4 right-4 z-[1100] w-full max-w-sm space-y-3"
        aria-live="assertive"
    >
        <template x-for="note in $store.notifications?.list || []" :key="note.id">
            <div
                x-show="true"
                x-transition
                class="rounded-lg border px-4 py-3 shadow-lg backdrop-blur bg-white/95 text-sm text-slate-800"
                :class="{
                    'border-emerald-200 text-emerald-800 bg-emerald-50/90': note.type === 'success',
                    'border-secondary/40 text-secondary bg-light/90': note.type === 'error',
                    'border-slate-200 text-slate-800 bg-white/90': !['success','error'].includes(note.type),
                }"
            >
                <div class="flex items-start gap-3">
                    <div class="mt-0.5">
                        <template x-if="note.type === 'success'">✅</template>
                        <template x-if="note.type === 'error'">⚠️</template>
                        <template x-if="!['success','error'].includes(note.type)">ℹ️</template>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold capitalize" x-text="note.type"></p>
                        <p class="mt-0.5" x-text="note.message"></p>
                    </div>
                    <button type="button" class="text-slate-500 hover:text-slate-700" @click="$store.notifications.dismiss(note.id)" aria-label="Cerrar notificación">✕</button>
                </div>
            </div>
        </template>
    </div>

    @stack('scripts')
</body>
</html>
