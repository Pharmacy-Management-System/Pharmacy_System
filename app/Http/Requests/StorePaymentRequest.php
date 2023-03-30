<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'id'=> ['required','unique:payments,id'],
            'method' => ['required,in:cash,card'],
            'order_id' => ['required|exists:orders,id'],
        ];
    }
    public function messages(): array
    {
        return [
            'id' => [
                'required' => 'Payment ID is Required',
            ],
            'method' => [
                'required' => 'Payment method is Required',
                'in' => 'Payment method must be cash or card',
            ]
        ];
    }
}
