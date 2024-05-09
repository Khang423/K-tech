<?php

namespace App\Http\Requests\brand;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'country' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages()
    {
        return [
            //- message rules name
            'required' => ' Bắt buộc phải điền.',
            'string' => 'Vui lòng không nhập số hoặc ký tự đặc biệt'
        ];
    }
}
