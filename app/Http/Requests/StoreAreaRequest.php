<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAreaRequest extends FormRequest
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
            //
            'area_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }

     /**
     * Get the validation error messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'area_id' => [
                'required' => 'Postal Code field is required.',
                'unique' => 'Postal Code field must be an integer.',
                'integer' => 'Postal Code field must be an integer.',
            ],
            'name' => [
                'required' => 'The Name field is required.',
                'string' => 'The Name field must be a string.',
                
            ],
            'address' => [
                'required' => 'The Address field is required.',
                'string' => 'The Address field must be a string.',
                
            ],
        ];
    }
}
