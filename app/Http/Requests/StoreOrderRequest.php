<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
            'order_creator' => ['required'],
            'delivering_address' => ['required'],
            'pharmacy_name' => ['required'],
            'is_insured' => ['required', 'boolean'],
            'status' => ['required', Rule::in(['New', 'Processing', 'WaitingForUserConfirmation', 'Canceled', 'Confirmed', 'Delivered'])],
            'creator_type' => ['required', Rule::in(['user', 'doctor', 'pharmacy'])]
        ];

    }
    public function messages()
    {
        return [
            'order_creator.required' => 'userName is required',
            'delivering_address.required' => 'address is required',
            'pharmacy_name.required' => 'pharmacy name is required',
            'is_insured.required' => 'The "Is insured field is required.',
            'is_insured.boolean' => 'The "Is insured" field must be true or false.',
            'status.required' => 'status is required',
            'creator_type.required' => 'creator type is required',
        ];
    }
}
