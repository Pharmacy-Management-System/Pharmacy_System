<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
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
            'name' => ['required', 'min:3'], //
            'email' => ['required', 'email', 'unique:users,email'], //
            'password' => ['required', 'min:6'], //
            'id' => ['required', Rule::unique('clients')->ignore($this->client), 'size:14'], //
            'gender' => ['required', 'in:Male,Female'], //
            'date_of_birth' => ['required', 'date'], //
            'avatar_image' => ['image', 'mimes:jpeg,png', 'max:2048'], //
            'phone' => ['required', 'regex:/^01[0-1]\d{8}$/'], //
            'area_id' => ['required', 'integer', 'exists:areas,id'], //
            'street_name' => ['required', 'string'], //
            'building_no' => ['required', 'numeric'],
            'floor_number' => ['required', 'numeric'],
            'flat_number' => ['required', 'numeric'],
            'email_verified_at' => ['nullable', 'date_format:Y-m-d H:i:s']
        ];
    }

    public function messages(): array
    {
        return [
            'id' => [
                'required' => 'The National ID is Required',
                'unique' => 'The National ID must be Unique',
                'size' => 'The National ID must Contain 14 Number'
            ],
            'email' => [
                'required' => 'The Email is Required',
                'unique' => 'The Email must be Unique',
                'email' => 'The Email must be a valid Email'
            ],
            'name' => [
                'required' => 'The Name is Required',
                'min' => 'The Name must be larger than 3 Characters'
            ],
            'password' => [
                'required' => 'The Password is Required',
                'min' => 'The Password must be larger than 6 Characters'
            ],
            'avatar_image' => [
                'mimes' => 'The Image must be jpg or jpeg Only'
            ],
            'gender' => [
                'required' => 'The Gender is Required',
                'in' => 'The Gender must be Female or Male'
            ],
            'date_of_birth' => [
                'required' => 'The Date of Birth is Required',
                'date' => 'The Date of Birth must be a valid Date'
            ],
            'phone' => [
                'required' => 'The Phone Number is Required',
                'regex' => 'The Phone Number must be a valid Number'
            ],
            'area_id' => [
                'required' => 'The Area ID is Required',
                'integer' => 'The Area ID must be Integer Number',
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
            'email_verified_at' => [
                'date_format' => 'The Email Verification Date must be a valid Date'
            ]

        ];
    }
}
