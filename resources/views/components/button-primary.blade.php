<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-4 py-2 rounded-lg bg-black text-white text-sm font-semibold hover:bg-rose-900 focus:outline-none focus:ring-2 focus:ring-rose-500 transition']) }}>
    {{ $slot }}
</button>
