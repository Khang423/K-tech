<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'phone' => [
                'required',
            ],
            'email' => [
                'required',
            ],
            'username' => [
                'required',
                'string',
                '',
            ],
            'password' => [
                'required',
            ],
            'confirm_password' => [

            ],
            'roles_id' => [
                'required',
            ],
        ];
    }
}
