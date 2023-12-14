<?php

namespace App\Http\Requests\Auth;

use App\Helpers\GeneralHelper;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return GeneralHelper::IS_AUTHENTICATED();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users'
        ];
    }

    /**
     * Error Messages
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'email.exists' => 'This email not exists in our system.'
        ];
    }
}
