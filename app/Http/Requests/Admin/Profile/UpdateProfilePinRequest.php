<?php

namespace App\Http\Requests\Admin\Profile;

use App\Helpers\GeneralHelper;
use App\Rules\MatchOldPin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePinRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $auth_user = GeneralHelper::USER();
        return [
            'old_pin' =>  ['sometimes','required', new MatchOldPin($auth_user)],
            'pin'     =>  ['required', 'digits:6','numeric'],
        ];
    }
}
