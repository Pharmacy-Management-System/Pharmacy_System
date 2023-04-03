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
            'password' => ['required', 'min:6','confirmed'], //
            'id' => ['required', Rule::unique('clients')->ignore($this->client), 'size:14'], //
            'gender' => ['required', 'in:Male,Female'], //
            'date_of_birth' => ['required', 'date'], //
            'avatar_image' => ['image', 'mimes:jpeg,png', 'max:2048'], //
            'phone' => ['required', 'regex:/^01[0-1-2-5]\d{8}$/'], //
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
                'min' => 'The Password must be larger than 6 Characters',
                'confirmed'=>"The Password must be confirmed"
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
            'email_verified_at' => [
                'date_format' => 'The Email Verification Date must be a valid Date'
            ]

        ];
    }
}
