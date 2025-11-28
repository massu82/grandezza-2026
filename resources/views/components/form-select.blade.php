@props(['label' => null, 'name', 'options' => [], 'value' => null, 'placeholder' => null, 'required' => false])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">{{ $label }} @if($required)<span class="text-rose-700">*</span>@endif</label>
    @endif
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @required($required)
        {{ $attributes->merge(['class' => 'w-full rounded-lg border border-slate-800/40 focus:border-slate-900 focus:ring-2 focus:ring-rose-600 text-sm bg-white text-slate-900']) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="text-xs text-rose-700">{{ $message }}</p>
    @enderror
</div>
