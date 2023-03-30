<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'id'=> ['required','size:14','unique:doctors,national_id,'.$this->doctor],
            'email'=> ['required','email','unique:doctors,email,'.$this->doctor],
            'name' => ['required'],
            'password' => ['required','min:6'],
            'avatar_image' => ['mimes:jpg,jpeg'],
            'pharmacy_id' => ['required|exists:pharmacies,pharmacy_id'],
            'is_banned' => ['required']
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
                'required' => 'The Name is Required'
            ],
            'password' => [
                'required' => 'The Password is Required',
                'min' => 'The Password must be larger than 6 Characters'
            ],
            'avatar_image' => [
                'mimes' => 'An Image must be jpg or jpeg Only'
            ]
        ];
    }
}