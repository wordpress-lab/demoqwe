<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        foreach($this->request->get('account') as $key => $val)
        {
            $rules['account.'.$key] = 'required';
        }

        foreach($this->request->get('description') as $key => $val)
        {
            $rules['description.'.$key] = 'required';
        }

        foreach($this->request->get('contact_id') as $key => $val)
        {
            $rules['contact_id.'.$key] = 'required';
        }

        foreach($this->request->get('tax_id') as $key => $val)
        {
            $rules['tax_id.'.$key] = 'required';
        }

        foreach($this->request->get('debit') as $key => $val)
        {
            $rules['debit.'.$key] = 'numeric';
        }

        foreach($this->request->get('credit') as $key => $val)
        {
            $rules['credit.'.$key] = 'numeric';
        }
        
        return $rules;
    }
}
