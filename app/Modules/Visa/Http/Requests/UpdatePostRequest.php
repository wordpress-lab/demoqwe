<?php

namespace App\Modules\Visa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            //
//            'visa_date'=>'required',
//            'local_ref'=>'required',
////            'visa_number'=>'required',
////            'visa_category_id'=>'required',

        ];
    }
}
