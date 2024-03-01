<?php

namespace App\Http\Requests\Merchant\Customer;

use App\Helpers\GeneralHelper;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
        'name'  => 'required',
        'email' => 'required|email',
        'mobile_number' => 'required|min:13|max:13|regex:/^\+2519[0-9]{8}$/',
        'recurringInvoice' => isset($this->recurringDays) ? 'required' : '',
        'recurringDays' => isset($this->recurringInvoice) ? 'required' : '',
    ];
}

/**
 * @return string[]
 */
public function messages()
{
    return [
        'mobile_number.regex' => "Please enter the phone in Ethiopian format. Example: +251912345678",
    ];
}
}
