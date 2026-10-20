<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $regra = $this->isMethod('post') ? 'required' : 'sometimes';

        return [
            'titulo' => "$regra|string|max:255",
            'ano' => 'nullable|integer|min:1888|max:2100',
            'genero' => 'nullable|string|max:100',
            'poster' => 'nullable|string|max:500',
            'status' => 'sometimes|in:quero_ver,ja_vi',
            'nota' => 'nullable|integer|between:1,5',
            'comentario' => 'nullable|string',
        ];
    }
}