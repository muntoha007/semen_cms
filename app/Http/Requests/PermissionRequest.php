<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;

class PermissionRequest extends BaseRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'permissions' => 'required'
        ];
    }

   protected function failedValidation(Validator $validator)
   {
       return parent::failedValidation($validator); // TODO: Change the autogenerated stub
   }
}