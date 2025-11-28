@csrf
<div class="grid md:grid-cols-2 gap-4">
    <x-form-input name="nombre" label="Nombre" :value="$product->nombre ?? ''" required />
    <x-form-input name="slug" label="Slug" :value="$product->slug ?? ''" required />
    <x-form-select name="categoria_id" label="Categoría" :options="$categorias ?? []" :value="$product->categoria_id ?? null" placeholder="Selecciona" required />
    <x-form-input name="tipo" label="Tipo" :value="$product->tipo ?? ''" required />
    <x-form-input name="pais" label="País" :value="$product->pais ?? ''" />
    <x-form-input name="region" label="Región" :value="$product->region ?? ''" />
    <x-form-input name="uva" label="Uva" :value="$product->uva ?? ''" />
    <x-form-input name="anada" label="Añada" type="number" :value="$product->anada ?? ''" />
    <x-form-input name="precio" label="Precio" type="number" step="0.01" :value="$product->precio ?? ''" required />
    <x-form-input name="precio_promocion" label="Precio promoción" type="number" step="0.01" :value="$product->precio_promocion ?? ''" />
    <x-form-input name="porcentaje_descuento" label="% descuento" type="number" :value="$product->porcentaje_descuento ?? ''" />
    <x-form-input name="stock" label="Stock" type="number" :value="$product->stock ?? 0" required />
    <x-form-input name="sku" label="SKU" :value="$product->sku ?? ''" required />
    <x-form-select name="estado" label="Estado" :options="[1 => 'Activo', 0 => 'Inactivo']" :value="$product->estado ?? 1" />
    <x-form-select name="destacado" label="Destacado" :options="[1 => 'Sí', 0 => 'No']" :value="$product->destacado ?? 0" />
    <x-form-input name="imagen_principal" label="Imagen principal (URL)" :value="$product->imagen_principal ?? ''" />
    <x-form-textarea name="galeria" label="Galería (JSON)" :value="isset($product) ? json_encode($product->galeria) : ''" />
</div>
<x-form-textarea name="descripcion_corta" label="Descripción corta" :value="$product->descripcion_corta ?? ''" />
<x-form-textarea name="descripcion_larga" label="Descripción larga" :value="$product->descripcion_larga ?? ''" rows="6" />
<div class="flex items-center justify-end gap-2">
    <a href="{{ url('/admin/products') }}" class="text-sm text-slate-600 hover:underline">Cancelar</a>
    <x-button-primary type="submit">Guardar</x-button-primary>
</div>
