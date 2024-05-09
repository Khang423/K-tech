<?php

namespace App\Http\Requests\admin;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestroyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'admin' => [
                'required',
                Rule::exists(Member::class, 'id')
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['admin' => $this->route('admin')]);
    }
}
