<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'id'=> ['required','size:14',Rule::unique('pharmacies', 'id')->ignore($this->pharmacy)],
            'pharmacy_name' => ['required', 'min:3'],
            'name' => ['required', 'min:3'],
            'email' => [Rule::unique('users', 'email')->ignore($this->user_id),'required'],
            'password' => ['required', 'min:6'],
            'avatar_image' => ['mimes:jpg,jpeg'],
            'area_id' => ['required','exists:areas,id'],
            'priority' => ['required','integer']
        ];
    }

    public function messages(): array
    {
        return [
            'id' => [
                'required' => 'The Pharmacy ID is Required',
                'unique' => 'The Pharmacy ID must be Unique',
                'size' => 'The Pharmacy ID must Contain 14 Number'
            ],
            'pharmacy_name' => [
                'required' => 'The Pharmacy Name is Required',
                'min' => 'The Pharmacy Name must be larger than 3 Characters'
            ],
            'name' => [
                'required' => 'The Name is Required',
                'min' => 'The Name must be larger than 3 Characters'
            ],
            'email' => [
                'required' => 'The Email is Required',
                'unique' => 'The Email must be Unique',
                'email' => 'The Email must be a valid Email'
            ],
            'password' => [
                'required' => 'The Password is Required',
                'min' => 'The Password must be larger than 6 Characters'
            ],
            'avatar_image' => [
                'mimes' => 'An Image must be jpg or jpeg Only'
            ],
            'priority' => [
                'required' => 'The Priority is Required',
                'integer' => 'The Priority must be Integer'
            ],
        ];
    }
}
