<?php

namespace App\Http\Requests\Merchant\Customer;

use App\Helpers\GeneralHelper;
use Illuminate\Foundation\Http\FormRequest;

class ImportCustomerRequest extends FormRequest
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
        'import_file'   =>  'required|mimes:csv,txt',
    ];
    }
}
