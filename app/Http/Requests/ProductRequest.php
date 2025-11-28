<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'descripcion_corta' => ['nullable', 'string'],
            'descripcion_larga' => ['nullable', 'string'],
            'precio' => ['required', 'numeric', 'min:0'],
            'precio_promocion' => ['nullable', 'numeric', 'min:0'],
            'porcentaje_descuento' => ['nullable', 'integer', 'min:0'],
            'categoria_id' => ['required', 'exists:categories,id'],
            'tipo' => ['required', 'string', 'max:255'],
            'pais' => ['nullable', 'string', 'max:255'],
            'region' => ['nullable', 'string', 'max:255'],
            'uva' => ['nullable', 'string', 'max:255'],
            'anada' => ['nullable', 'integer'],
            'stock' => ['required', 'integer', 'min:0'],
            'sku' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'integer', 'in:0,1'],
            'tags' => ['nullable', 'array'],
            'imagen_principal' => ['nullable', 'string'],
            'galeria' => ['nullable'],
            'destacado' => ['boolean'],
        ];
    }
}
