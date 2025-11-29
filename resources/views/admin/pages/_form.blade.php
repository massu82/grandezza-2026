@csrf
<div class="grid md:grid-cols-2 gap-4">
    <x-form-input name="titulo" label="Título" :value="$page->titulo ?? ''" required />
    <x-form-input name="slug" label="Slug" :value="$page->slug ?? ''" required />
    <x-form-select name="publicado" label="Publicado" :options="[1 => 'Sí', 0 => 'No']" :value="$page->publicado ?? 0" />
</div>
<x-form-textarea name="contenido" label="Contenido" :value="$page->contenido ?? ''" rows="8" />
<div class="flex items-center justify-end gap-2">
    <a href="{{ url('/admin/pages') }}" class="text-sm text-slate-600 hover:underline">Cancelar</a>
    <x-button-primary type="submit" x-bind:disabled="submitting">
        <span x-show="!submitting">Guardar</span>
        <span x-show="submitting">Guardando...</span>
    </x-button-primary>
</div>
