<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class  AuthCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'email' => [
                'required',
                Rule::unique('customers')->ignore($this->customers),
            ],
            'name' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ];
    }
    public function messages():array
    {
        return[
            'required' => 'Bắt buộc phải điền không được bỏ trống.',
            'email.unique'=>' Gmail đã được sử dụng.'
        ];
    }
}
