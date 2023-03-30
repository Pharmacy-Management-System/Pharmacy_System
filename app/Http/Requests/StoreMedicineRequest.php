<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineRequest extends FormRequest
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
            'id'=> ['required','unique:medicines,id'],
            'name' => ['required','string'],
            'type' => ['required','string'],
            'quantity' => ['required','integer','min:1'],
            'price' => ['required','double']
        ];
    }
    public function messages(): array
    {
        return [
            'id' => [
                'required' => 'Medicine ID is Required',
                'unique' => 'Medicine ID must be Unique',
            ],
            'name' => [
                'required' => 'Name is Required'
            ],
            'type' => [
                'required' => 'Type is Required'
            ],
            'quantity' => [
                'required' => 'Quantity is Required',
                'integer' => 'Quantity must be an integer number',
                'min' => 'Quantity must be at least 1'
            ],
            'price' => [
                'required' => 'Price is Required',
            ]
        ];
    }
}

