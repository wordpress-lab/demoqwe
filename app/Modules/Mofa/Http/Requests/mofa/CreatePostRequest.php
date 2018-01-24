<?php

namespace App\Modules\Mofa\Http\Requests\mofa;

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
            'mofa_date'=>'required',
            'pax_ref'=>'required',
            'mofa_number'=>'required',


        ];
    }
}
