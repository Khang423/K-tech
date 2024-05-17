<?php

namespace App\Http\Requests\customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'max:50',
                'min:2',
                'regex:/^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+ [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*/',            ],
            'phone' => [
                'required',
                'alpha_num',
                'regex:/^(?:0|\+84)[1-9]\d{8,9}$/',
                'max:11',
                'min:10',
            ],
            'email' => [
                'required',
                'regex:/^[a-z\d]+@[a-z]+(?:\.[a-z]+)+$/i',
                Rule::unique('customers')->ignore($this->customers),
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*`~?<>”’:;[\]{}\|\/\-_=+]).{8,}$/',
            ],
            'avatar' => [
                'nullable',
            ],
            'gender' => [
                'required',
            ]
            ,'birthdate' => [
                'required',
            ]
            ,'address' => [
                'required',
            ]
            ,'city_id' => [
                'required',
            ]
            ,'district_id' => [
                'required',
            ]
            ,'wards_id' => [
                'required',
            ],
        ];
    }

    public function messages():array
    {
        return[
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
            'email.unique' => 'Email đã được sử dụng.',
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
