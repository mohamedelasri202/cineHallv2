<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationAddRequest extends FormRequest
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

            'session_id' => 'required|integer|min:1',
            'seat_id' => 'required|array|min:1',

            'user_id' => 'required|integer|min:1',
            'seat_type' => 'required|string|in:solo,couple'
        ];
    }
}
