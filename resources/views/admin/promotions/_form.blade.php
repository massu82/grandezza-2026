@csrf
<div class="grid md:grid-cols-2 gap-4">
    <x-form-input name="titulo" label="Título" :value="$promotion->titulo ?? ''" required />
    <x-form-input name="banner" label="Banner (URL)" :value="$promotion->banner ?? ''" />
    <x-form-textarea name="descripcion" label="Descripción" :value="$promotion->descripcion ?? ''" />
    <x-form-input name="fecha_inicio" type="datetime-local" label="Fecha inicio" :value="isset($promotion) && $promotion->fecha_inicio ? $promotion->fecha_inicio->format('Y-m-d\TH:i') : ''" />
    <x-form-input name="fecha_fin" type="datetime-local" label="Fecha fin" :value="isset($promotion) && $promotion->fecha_fin ? $promotion->fecha_fin->format('Y-m-d\TH:i') : ''" />
    <x-form-select name="activo" label="Activo" :options="[1 => 'Sí', 0 => 'No']" :value="$promotion->activo ?? 1" />
</div>
<div class="flex items-center justify-end gap-2">
    <a href="{{ url('/admin/promotions') }}" class="text-sm text-slate-600 hover:underline">Cancelar</a>
    <x-button-primary type="submit">Guardar</x-button-primary>
</div>
