<?php

namespace App\Http\Requests\category;

use App\Models\Category;
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
            'category' => [
                'required',
                Rule::exists(Category::class, 'id')
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['category' => $this->route('category')]);
    }
}
