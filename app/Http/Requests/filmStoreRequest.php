<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class filmStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'duree' => 'required|integer|min:1',
            'minimum_age' => 'required|integer|min:1',
            'trailer' => 'required|string|max:255',
            'genre' => 'required|string|max:255',


        ];
    }
}
