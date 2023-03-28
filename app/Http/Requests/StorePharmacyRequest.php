<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyRequest extends FormRequest
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
            'pharmacy_id'=> ['required','size:14','unique:pharmacies,pharmacy_id,'.$this->pharmacy],
            'email'=> ['required','email','unique:pharmacies,email,'.$this->pharmacy],
            'name' => ['required'],
            'password' => ['required','min:6'],
            'avatar' => ['mimes:jpg,jpeg'],
            'area_id' => ['required|exists:areas,area_id'],
            'priority' => ['required','integer']
        ];
    }

    public function messages(): array
    {
        return [
            'pharmacy_id' => [
                'required' => 'The Pharmacy ID is Required',
                'unique' => 'The Pharmacy ID must be Unique',
                'size' => 'The Pharmacy ID must Contain 14 Number'
            ],
            'email' => [
                'required' => 'The Email is Required',
                'unique' => 'The Email must be Unique',
                'email' => 'The Email must be a valid Email'
            ],
            'name' => [
                'required' => 'The Name is Required'
            ],
            'password' => [
                'required' => 'The Password is Required',
                'min' => 'The Password must be larger than 6 Characters'
            ],
            'avatar' => [
                'mimes' => 'An Image must be jpg or jpeg Only'
            ],
            'priority' => [
                'required' => 'The Priority is Required',
                'integer' => 'The Priority must be Integer'
            ],
        ];
    }
}