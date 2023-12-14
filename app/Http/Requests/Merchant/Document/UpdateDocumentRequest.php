<?php

namespace App\Http\Requests\Merchant\Document;

use App\Helpers\GeneralHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
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
        $user = GeneralHelper::USER();
        $documents = !empty($user->merchantDetail) ? json_decode($user->merchantDetail->document_details) : null ;

        return [
            'cnic'              => !empty($documents->cnic_doc) ? 'mimes:jpeg,jpg,png,pdf|max:2000' : 'required|mimes:jpeg,jpg,png,pdf|max:2000',
            'license'           => !empty($documents->license_doc) ? 'mimes:jpeg,jpg,png,pdf|max:2000' : 'required|mimes:jpeg,jpg,png,pdf|max:2000',
            'registration_form' => (GeneralHelper::USER()->is_school == 1) ? (!empty($documents->registration_form_doc) ? 'mimes:jpeg,jpg,png,pdf|max:2000' : 'required|mimes:jpeg,jpg,png,pdf|max:2000') : '',
        ];
    }
}
