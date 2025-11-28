<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->routeIs('admin.orders.update')) {
            return [
                'estado' => ['required', 'string', 'max:50'],
                'notas_internas' => ['nullable', 'string'],
            ];
        }

        return [
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'email_cliente' => ['required', 'email'],
            'telefono_cliente' => ['required', 'string', 'max:50'],
            'notas_cliente' => ['nullable', 'string'],
        ];
    }
}
