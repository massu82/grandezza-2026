@csrf
<div class="grid md:grid-cols-2 gap-4">
    <x-form-input name="nombre" label="Nombre" :value="$category->nombre ?? ''" required />
    <x-form-input name="slug" label="Slug" :value="$category->slug ?? ''" required />
</div>
<x-form-textarea name="descripcion" label="Descripción" :value="$category->descripcion ?? ''" />
<div class="flex items-center justify-end gap-2">
    <a href="{{ url('/admin/categories') }}" class="text-sm text-slate-600 hover:underline">Cancelar</a>
    <x-button-primary type="submit" x-bind:disabled="submitting">
        <span x-show="!submitting">Guardar</span>
        <span x-show="submitting">Guardando...</span>
    </x-button-primary>
</div>
