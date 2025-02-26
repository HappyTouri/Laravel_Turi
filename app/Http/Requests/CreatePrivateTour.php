<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePrivateTour extends FormRequest
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
            'cooperator_id' => 'required|integer',
            'destination_id' => 'required|integer',
            'from' => 'required|date',
            'till' => 'required|date|after_or_equal:from',
            'number_of_days' => 'required|integer|min:1',
            'hotels_price' => 'required|numeric|min:0',
            'profit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'tour_name' => 'required|string|max:255',
            'tour_title_id' => 'required|integer',
            'transportation_id' => 'required|integer',
            'transportation_price' => 'required|numeric|min:0',
            'website' => 'boolean',

            // Validate each item in tourDetails
            'tourDetails' => 'required|array|min:1',
            'tourDetails.*.accommodation' => 'required|boolean',
            'tourDetails.*.accommodation_id' => 'nullable|integer',
            'tourDetails.*.accommodation_price' => 'required|numeric|min:0',
            'tourDetails.*.date' => 'required|date',
            'tourDetails.*.tourguide' => 'required|boolean',


            // // Validate roomsCategories for each item in tourDetails
            // 'tourDetails.*.roomsCategories' => 'required|array|min:1',
            // 'tourDetails.*.roomsCategories.*.id' => 'required|integer',
            // 'tourDetails.*.roomsCategories.*.name' => 'required|string|max:255',
            // 'tourDetails.*.roomsCategories.*.price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'cooperator_id.required' => 'The cooperator ID is required.',
            'destination_id.required' => 'The destination ID is required.',
            'from.required' => 'The start date is required.',
            'till.required' => 'The end date is required.',
            'number_of_days.required' => 'The number of days is required.',
            'tourDetails.*.roomsCategories.*.id.required' => 'Each room category must have an ID.',
            'tourDetails.*.roomsCategories.*.name.required' => 'Each room category must have a name.',
            'tourDetails.*.roomsCategories.*.price.required' => 'Each room category must have a price.',
            // add more custom messages as needed
        ];
    }
}
