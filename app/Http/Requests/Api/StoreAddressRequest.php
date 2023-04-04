<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'area_id' => ['required', 'exists:areas,id'], 
            'street_name' => ['required', 'string'],
            'building_number' => ['required', 'numeric'],
            'floor_number' => ['required', 'numeric'],
            'flat_number' => ['required', 'numeric'],
            'is_main' => ['required','boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'area_id' => [
                'required' => 'The Area ID is Required',
                'exists' => 'The Area ID does not exist'
            ],
            'street_name' => [
                'required' => 'The Street Name is Required',
                'string' => 'The Street Name must be String'
            ],
            'building_no' => [
                'required' => 'The Building Number is Required',
                'numeric' => 'The Building Number must be Number'
            ],
            'floor_number' => [
                'required' => 'The Floor Number is Required',
                'numeric' => 'The Floor Number must be Number'
            ],
            'flat_number' => [
                'required' => 'The Flat Number is Required',
                'numeric' => 'The Flat Number must be Number'
            ],
            'is_main' => [
                'required' => 'You must specify whether it is a main street or not',
                'boolean' => 'Enter only 1 for Main street else 0'
            ],

        ];
    }
}
