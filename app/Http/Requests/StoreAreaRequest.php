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
        return false;
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
            'area_id' => ['required', 'integer', 'unsigned', 'min:3', 'max:7'],
            'name' => ['required', 'string', 'min:5', 'max:10'],
            'address' => ['required', 'string', 'min:7', 'max:15'],
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
                'required' => 'The Area ID field is required.',
                'unique' => 'The Area ID field must be an integer.',
                'integer' => 'The Area ID field must be an integer.',
                'unsigned' => 'The Area ID field must be a positive number.',
                'min' => 'The Area ID field must be at least 3 digits long.',
                'max' => 'The Area ID field must not exceed 7 digits.',
            ],
            'name' => [
                'required' => 'The Name field is required.',
                'string' => 'The Name field must be a string.',
                'min' => 'The Name field must be at least 5 characters long.',
                'max' => 'The Name field must not exceed 10 characters.',
            ],
            'address' => [
                'required' => 'The Address field is required.',
                'string' => 'The Address field must be a string.',
                'min' => 'The Address field must be at least 7 characters long.',
                'max' => 'The Address field must not exceed 15 characters.',
            ],
        ];
    }
}
