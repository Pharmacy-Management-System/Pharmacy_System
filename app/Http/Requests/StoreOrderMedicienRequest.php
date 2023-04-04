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
            'medicine_id' => ['required','exists:medicines,id'],
            'order_id' => ['required','exists:orders,id'],
            'quantity'=> ['required', 'integer'],
        ];
    }
    public function messages()
    {
        return [
            'quantity'=>[
                'required' => 'quantity is required',
                'integer' => 'quantity must be integer',
            ],

        ];
    }
}
