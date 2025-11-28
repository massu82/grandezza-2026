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
    <div class="space-y-2">
        <label class="block text-sm font-medium text-slate-700">Imagen principal</label>
        <input type="file" name="imagen_principal" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-slate-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-black file:text-white hover:file:bg-rose-900 border border-slate-300 rounded-lg focus:border-rose-700 focus:ring-rose-700">
        @if(!empty($product->imagen_principal))
            <p class="text-xs text-slate-500">Actual: {{ $product->imagen_principal }}</p>
        @endif
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-medium text-slate-700">Galería</label>
        <input type="file" name="galeria[]" multiple accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-slate-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-black file:text-white hover:file:bg-rose-900 border border-slate-300 rounded-lg focus:border-rose-700 focus:ring-rose-700">
        @if(!empty($product->galeria))
            <p class="text-xs text-slate-500">Actual: {{ is_array($product->galeria) ? implode(', ', $product->galeria) : $product->galeria }}</p>
        @endif
    </div>
</div>
<x-form-textarea name="descripcion_corta" label="Descripción corta" :value="$product->descripcion_corta ?? ''" />
<x-form-textarea name="descripcion_larga" label="Descripción larga" :value="$product->descripcion_larga ?? ''" rows="6" />
<div class="flex items-center justify-end gap-2">
    <a href="{{ url('/admin/products') }}" class="text-sm text-slate-600 hover:underline">Cancelar</a>
    <x-button-primary type="submit">Guardar</x-button-primary>
</div>
