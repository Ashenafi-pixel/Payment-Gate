<?php

namespace App\Http\Requests\Merchant\Profile;

use App\Helpers\GeneralHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        return [
            'profile_image' =>  'mimes:jpeg,jpg,png',
            'name'  =>  'required',
            'mobile_number' =>  'required|min:12|max:20'
        ];
    }
}
