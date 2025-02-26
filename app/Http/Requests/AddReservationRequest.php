<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddReservationRequest extends FormRequest
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
            'private_tour_id' => 'required|integer',
            'user_id' => 'required|integer',
            'number_of_people' => 'required|integer',

        ];
    }
}
