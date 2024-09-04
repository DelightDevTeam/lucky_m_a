<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|string',
            'password' => 'required|min:6|confirmed',
            'phone' => ['required', 'regex:/^[0-9]+$/'],
            'referral_code' =>'required|exists:users,referral_code',
            'payment_type_id' => 'required',
            'account_name' => 'required|min:3|string',
            'account_number' => ['required', 'regex:/^[0-9]+$/'],
        ];
    }
}
