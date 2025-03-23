<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionupdateRequest extends FormRequest
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
            'film_id' => 'integer|min:1',
            'room' => 'nullable|string|max:255',
            'start_time' => 'nullable|date_format:Y-m-d H:i:s',  // Add format for clarity
            'session_type' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',  // Corrected 'languge' to 'language'
        ];
    }
}
