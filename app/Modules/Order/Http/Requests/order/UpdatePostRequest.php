<?php

namespace App\Modules\Order\Http\Requests\order;

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
            'order_date'=>'required',
            'customer_id'=>'required',
            'package_id'=>'required',
            'registerSerial_id'=>'required',
            'passportNumber'=>'required',
            'issue_date'=>'required',
        ];
    }
}
