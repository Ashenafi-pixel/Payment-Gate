<?php

namespace App\Http\Requests\Admin\Gateway;

use App\Helpers\GeneralHelper;
use Illuminate\Foundation\Http\FormRequest;

class CreateGatewayRequest extends FormRequest
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
            'name'          =>  'required',
            'currency_name' =>  'required',
            'gateway_logo'  =>  'mimes:jpeg,jpg,png|max:2000',
        ];
    }
}
