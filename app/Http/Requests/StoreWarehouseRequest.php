<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseRequest extends FormRequest
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
            ],
            'product_id' => [
                'required',
            ],
            'supplier_id' => [
                'required',
            ]
            ,
            'stock_quantity' => [
                'required',
            ],
            'price' => [
                'required',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            //- message rules name
            'required' => ' Bắt buộc phải điền.',
            'name.regex' => 'Họ tên của bạn không hợp lệ.',
            'name.max' => 'Họ Tên không được vượt quá 50 kí tự.',
            'name.min' => 'Họ Tên không được dưới 5 kí tự.',
            //- message rules phone
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'phone.max' => 'Số điện thoại không được vượt quá 11 kí tự.',
            'phone.min' => 'Số điện thoại không được dưới 10 kí tự.',
            'phone.alpha_num' => 'Vui lòng nhập số.',
            //- message rules email
            'email.regex' => 'Email không hợp lệ.',
            //- message rules username
            'username.regex' => 'Tên đăng nhập không hợp lệ.',
            'username.max' => 'Tên đăng nhập không được vượt quá 50 kí tự.',
            'username.min' => 'Tên đăng nhập không được dưới 5 kí tự.',
            'username.unique' => 'Tài khoản đã tồn tại',
            //- message rules password
            'password.regex' => 'Mật khẩu không hợp lệ.',

        ];
    }
}
