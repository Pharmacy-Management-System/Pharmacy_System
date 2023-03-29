<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6']
        ];
    }

    public function messages(): array
    {
        return [
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
        ];
    }
}