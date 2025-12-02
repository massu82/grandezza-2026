@csrf
<div class="grid md:grid-cols-2 gap-4">
    <x-form-input name="titulo" label="Título" :value="$promotion->titulo ?? ''" required />
    <div class="space-y-2">
        <div class="flex items-center gap-2 text-sm font-medium text-slate-700" x-data="{ open: false }">
            <span>Banner (1600 x 500 px)</span>
            <button
                type="button"
                class="w-5 h-5 inline-flex items-center justify-center rounded-full bg-primary text-white text-[10px] leading-none focus:outline-none focus:ring-2 focus:ring-accent"
                @mouseenter="open = true"
                @mouseleave="open = false"
                @focus="open = true"
                @blur="open = false"
            >?</button>
            <div
                x-cloak
                x-show="open"
                class="absolute mt-8 px-3 py-2 text-xs text-slate-700 bg-white border border-slate-200 rounded-lg shadow-md"
            >
                Tamaño requerido 1600x500 px (JPEG/PNG/WEBP, máx. 2MB).
            </div>
        </div>
        <input
            type="file"
            name="banner"
            accept="image/jpeg,image/png,image/webp"
            class="block w-full text-sm text-slate-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-white hover:file:bg-secondary border border-slate-300 rounded-lg focus:border-primary focus:ring-accent"
        >
        @if(!empty($promotion->banner))
            <p class="text-xs text-slate-500">Actual: {{ $promotion->banner }}</p>
        @endif
        @error('banner')
            <p class="text-xs text-secondary">{{ $message }}</p>
        @enderror
    </div>
    <x-form-textarea name="descripcion" label="Descripción" :value="$promotion->descripcion ?? ''" />
    <x-form-input name="fecha_inicio" type="datetime-local" label="Fecha inicio" :value="isset($promotion) && $promotion->fecha_inicio ? $promotion->fecha_inicio->format('Y-m-d\TH:i') : ''" />
    <x-form-input name="fecha_fin" type="datetime-local" label="Fecha fin" :value="isset($promotion) && $promotion->fecha_fin ? $promotion->fecha_fin->format('Y-m-d\TH:i') : ''" />
    <x-form-select name="activo" label="Activo" :options="[1 => 'Sí', 0 => 'No']" :value="$promotion->activo ?? 1" />
</div>
<div class="flex items-center justify-end gap-2">
    <a href="{{ url('/admin/promotions') }}" class="text-sm text-slate-600 hover:underline">Cancelar</a>
    <x-button-primary type="submit" x-bind:disabled="submitting">
        <span x-show="!submitting">Guardar</span>
        <span x-show="submitting">Guardando...</span>
    </x-button-primary>
</div>
