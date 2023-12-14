<?php

namespace App\Http\Requests\Merchant\Student;

use App\Helpers\GeneralHelper;
use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'email'         =>  'required',
            'mobile_number' =>  'required|numeric',
            'address'       =>  'required',
            'father_name'   =>  'required',
            'class'         =>  'required',
            'section'       =>  'required',
        ];
    }
}
