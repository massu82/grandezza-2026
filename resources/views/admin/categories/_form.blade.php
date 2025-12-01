@csrf
@php($showSlug = $showSlug ?? false)

<div class="grid gap-4 @if($showSlug) md:grid-cols-2 @endif">
    <x-form-input name="nombre" label="Nombre" :value="$category->nombre ?? ''" required x-on:input="onNameInput($event)" />
    @if($showSlug)
        <x-form-input name="slug" label="Slug" :value="$category->slug ?? ''" x-model="slug" x-on:input="onSlugInput($event)" />
    @endif
    <input type="hidden" name="slug" x-model="slug">
</div>
<x-form-textarea name="descripcion" label="Descripción" :value="$category->descripcion ?? ''" />
<div class="space-y-2">
    <div class="flex items-center gap-2 text-sm font-medium text-slate-700" x-data="{ open: false }">
        <span>Imagen</span>
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
            Dimensión recomendada: 1600x900 px (JPEG/PNG/WEBP, máx. 1MB)
        </div>
    </div>
    <input
        type="file"
        name="imagen"
        accept="image/jpeg,image/png,image/webp"
        class="block w-full text-sm text-slate-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-white hover:file:bg-secondary border border-slate-300 rounded-lg focus:border-primary focus:ring-accent"
    >
    @if(!empty($category->imagen))
        <p class="text-xs text-slate-500">Actual: {{ $category->imagen }}</p>
    @endif
</div>
<div class="flex items-center justify-end gap-2">
    <a href="{{ url('/admin/categories') }}" class="text-sm text-slate-600 hover:underline">Cancelar</a>
    <x-button-primary type="submit" x-bind:disabled="submitting">
        Guardar
        <span x-show="submitting" class="text-xs ml-2" x-cloak>(Guardando...)</span>
    </x-button-primary>
</div>
