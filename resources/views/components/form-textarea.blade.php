@props(['label' => null, 'name', 'placeholder' => '', 'value' => null, 'rows' => 4, 'required' => false])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">{{ $label }} @if($required)<span class="text-secondary">*</span>@endif</label>
    @endif
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        @required($required)
        {{ $attributes->merge(['class' => 'textarea-control']) }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-xs text-secondary">{{ $message }}</p>
    @enderror
</div>
