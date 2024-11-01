<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            '_verification_token'  =>   'required|string',
            'password'             =>   'required|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return [
            '_verification_token.required'  =>  'Verification token is missing.',
        ];
    }
}
