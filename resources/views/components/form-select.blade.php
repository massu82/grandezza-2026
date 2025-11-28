@props(['label' => null, 'name', 'options' => [], 'value' => null, 'placeholder' => null, 'required' => false])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">{{ $label }} @if($required)<span class="text-secondary">*</span>@endif</label>
    @endif
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @required($required)
        {{ $attributes->merge(['class' => 'select-control']) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="text-xs text-secondary">{{ $message }}</p>
    @enderror
</div>
