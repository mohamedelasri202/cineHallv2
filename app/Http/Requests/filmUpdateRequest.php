<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class filmUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'description' => 'string',
            'image' => 'string|max:255',
            'duree' => 'integer|min:1',
            'minimum_age' => 'integer|min:1',
            'trailer' => 'string|max:255',
            'genre' => 'string|max:255',
        ];
    }
}
