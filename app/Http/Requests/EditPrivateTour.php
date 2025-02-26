<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPrivateTour extends FormRequest
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
            'tour_name' => 'required|string|max:255',
            'tour_title_id' => 'required|integer',
            'transportation_id' => 'required|integer',



            'tourguide_price' => 'required|numeric|min:0',
            'hotels_price' => 'required|numeric|min:0',
            'profit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'transportation_price' => 'required|numeric|min:0',

        ];
    }
}
