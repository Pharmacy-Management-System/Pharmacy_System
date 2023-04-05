<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
            'id'=>['prohibited'],
            'name' => ['required', 'min:3'], //
            'email'=>['prohibited'],
            'gender' => ['required', 'in:Male,Female'], //
            'date_of_birth' => ['required', 'date'], //
            'avatar_image' => ['image', 'mimes:jpeg,png', 'max:2048'], //
            'phone' => ['required', 'regex:/^01[0-1-2-5]\d{8}$/'], //
        ];
    }
    
    public function messages(): array
    {
        return [
            'id' => [
                'prohibited' => 'you are not able to change your id',
            ],
            'email' => [
                'prohibited' => 'you are not able to change your email',
            ]
        ];
    }
}
