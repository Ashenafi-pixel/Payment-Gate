<?php

namespace App\Http\Requests\Customer\Document;

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
        return [
            'cnic'              => isset($user->customerDetail) ? 'mimes:jpeg,jpg,png,webp,pdf|max:2000' :'required|mimes:jpeg,jpg,png,webp,pdf|max:2000',
            'license'           => isset($user->customerDetail) ? 'mimes:jpeg,jpg,png,webp,pdf|max:2000' :'required|mimes:jpeg,jpg,png,webp,pdf|max:2000',
        ];
    }
}
