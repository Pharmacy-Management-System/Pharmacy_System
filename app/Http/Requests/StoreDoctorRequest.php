<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'id' => ['required', 'size:14', Rule::unique('doctors', 'id')->ignore($this->doctor)],
            'pharmacy_id' => ['required', 'exists:pharmacies,id'],
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user_id)],
            'password' => ['required', 'min:6'],
            'avatar_image' => ['mimes:jpg,jpeg'],
        ];
    }

    public function messages(): array
    {
        return [
            'id' => [
                'required' => 'The National ID is Required',
                'unique' => 'The National ID is already exists',
                'size' => 'The National ID must Contain 14 Number'
            ],
            'name' => [
                'required' => 'The Name is Required',
                'min' => 'The Name must be larger than 3 Characters'
            ],
            'email' => [
                'required' => 'The Email is already exists',
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
        ];
    }
}
