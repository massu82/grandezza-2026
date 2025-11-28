@props(['label' => null, 'name', 'type' => 'text', 'placeholder' => '', 'value' => null, 'required' => false])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">{{ $label }} @if($required)<span class="text-rose-700">*</span>@endif</label>
    @endif
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @required($required)
        {{ $attributes->merge(['class' => 'input-control']) }}
    >
    @error($name)
        <p class="text-xs text-rose-700">{{ $message }}</p>
    @enderror
</div>
