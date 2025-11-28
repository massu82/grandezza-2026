@props(['label' => null, 'name', 'placeholder' => '', 'value' => null, 'rows' => 4, 'required' => false])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">{{ $label }} @if($required)<span class="text-rose-700">*</span>@endif</label>
    @endif
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        @required($required)
        {{ $attributes->merge(['class' => 'w-full rounded-lg border border-slate-800/40 focus:border-slate-900 focus:ring-2 focus:ring-rose-600 text-sm bg-white text-slate-900 placeholder-slate-500']) }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-xs text-rose-700">{{ $message }}</p>
    @enderror
</div>
