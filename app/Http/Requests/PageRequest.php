<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'contenido' => ['nullable', 'string'],
            'publicado' => ['boolean'],
        ];
    }
}
