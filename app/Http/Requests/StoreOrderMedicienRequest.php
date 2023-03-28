<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderMedicienRequest extends FormRequest
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
            'quantity'=> ['required', 'integer', 'min:1'],
        ];
    }
    public function messages()
    {
        return [
            'quantity.required' => 'quantity is required',
            'quantity.integer' => 'quantity must be integer',
            'quantity.min' => 'quantity must be greater than 0',
        ];
    }
}
