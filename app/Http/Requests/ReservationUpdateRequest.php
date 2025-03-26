<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
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
            'session_id' => 'integer|exists:sessions,id',
            'seat_id' => 'integer|exists:seats,id',
            'user_id' => 'integer|exists:users,id',
            'number_of_seat' => 'integer|min:1|max:10',
            'seat_type' => 'string',
        ];
    }
}
