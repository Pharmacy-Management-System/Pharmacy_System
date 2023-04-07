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

    public function rules()
    {
        return [
            'user_id' => ['exists:users,id'],
            'delivering_address_id' => ['exists:addresses,id'],
            'pharmacy_id' => ['exists:pharmacies,id'],
            'status' => ['required', Rule::in(['New', 'Processing', 'WaitingForUserConfirmation', 'Canceled', 'Confirmed', 'Delivered'])],
            'creator_type' => ['required', Rule::in(['client', 'doctor', 'pharmacy'])],
        ];

    }
    public function messages()
    {
        return [
            'user_id.required' => 'userName is required',
            'delivering_address_id.required' => 'check client address',
            'status.required' => 'status is required',
            'creator_type.required' => 'creator type is required',
            'pharmacy_id.required' => 'pharmacy is required',
            'doctor_id.required' => 'doctor is required',
        ];
    }
}
