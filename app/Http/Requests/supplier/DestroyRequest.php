<?php

namespace App\Http\Requests\supplier;

use App\Models\Supplier;
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
            'supplier' => [
                'required',
                Rule::exists(Supplier::class, 'id')
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['supplier' => $this->route('supplier')]);
    }
}
