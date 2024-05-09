<?php

namespace App\Http\Requests\customer;

use App\Models\Customer;
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
            'customer' => [
                'required',
                Rule::exists(Customer::class, 'id')
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['customer' => $this->route('customer')]);
    }
}
