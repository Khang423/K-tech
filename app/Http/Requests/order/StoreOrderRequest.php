<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'receive_name' => [
                'required'
            ],
            'receive_phone' => [
                'required'
            ],
            'address' => [
                'required'
            ],
            'city_id' => [
                'required'
            ],
            'district_id' => [
                'required'
            ],
            'wards_id' => [
                'required'
            ],
        ];
    }
}
