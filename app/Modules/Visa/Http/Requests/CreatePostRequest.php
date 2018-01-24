<?php

namespace App\Modules\Visa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'visa_date'=>'required',
            'local_ref'=>'required',
            'visa_number'=>'required',
            'img_url'=>'required',
            'flag_num'=>'required',
            'registerSerial'=>'required|unique:visaentrys',
        ];
    }

}
