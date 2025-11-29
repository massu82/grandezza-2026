@props(['type' => 'success', 'message' => null])

@php
    $colors = [
        'success' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
        'error' => 'bg-light text-secondary border-secondary/30',
        'info' => 'bg-slate-50 text-slate-800 border-slate-200',
    ];
    $classes = $colors[$type] ?? $colors['info'];
@endphp

@if($message)
    <div
        x-data
        x-init="
            window.dispatchEvent(new CustomEvent('notify', {
                detail: { type: '{{ $type }}', message: @js($message) }
            }));
        "
        class="hidden"
    ></div>
@endif
