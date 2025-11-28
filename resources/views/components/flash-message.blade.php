@props(['type' => 'success', 'message' => null])

@php
    $colors = [
        'success' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'error' => 'bg-rose-50 text-rose-800 border-rose-200',
        'info' => 'bg-slate-50 text-slate-800 border-slate-200',
    ];
    $classes = $colors[$type] ?? $colors['info'];
@endphp

@if($message)
    <div class="rounded-lg border px-4 py-3 text-sm {{ $classes }}">
        {{ $message }}
    </div>
@endif
