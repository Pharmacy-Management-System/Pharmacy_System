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
            'user_id' => ['required', 'exists:users,id'],
            // 'doctor_id'=>['nullable','exists:doctors,id'],
            // // 'delivering_address' => ['required'],
            // 'pharmacy_name' => ['exists:pharmacies,id'],
            'is_insured' => ['required', 'boolean'],
            'status' => ['required', Rule::in(['New', 'Processing', 'WaitingForUserConfirmation', 'Canceled', 'Confirmed', 'Delivered'])],
            'creator_type' => ['required', Rule::in(['client', 'doctor', 'pharmacy'])],
        ];

    }
    public function messages()
    {
        return [
            'user_id.required' => 'userName is required',
            'delivering_address.required' => 'address is required',
        'is_insured'=>[
            'required' => 'The "Is insured" field is required.',
            'boolean' => 'The "Is insured" field must be true or false.',
        ],
            'status.required' => 'status is required',
            'creator_type.required' => 'creator type is required',
        ];
    }
}
