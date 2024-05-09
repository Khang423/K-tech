<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'username' => [
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
        ];
    }
}
