<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'member_id' => [
                'required',
            ],
            'brand_id' => [
                'required',
            ],
            'category_id' => [
                'required',
            ],
            'name' => [
                'required',
            ],
            'price' => [
                'nullable',
            ],
            'outsite_image' => [
                'required',
            ],

            'graphic_card' => [
                'required',
            ],
            'cpu' => [
                'required',
            ],
            'ram' => [
                'required',
            ],
            'ram_type' => [
            ]
            ,
            'ram_slot' => [
                'required',
            ],
            'ssd' => [
                'required',
            ]
            ,
            'touchscreen' => [
                'required',
            ],
            'bg_plate' => [
                'required',
            ],
            'scan_frequency' => [
                'required',
            ],
            'screen_size' => [
                'required',
            ],
            'screen_tech' => [
                'nullable',
            ],
            'screen_resolution' => [
                'required',
            ],
            'keyboard_light' => [
                'required',
            ],
            'webcam' => [
                'required',
            ],
            'operating_system' => [
                'required',
            ],
            'bluetooth' => [
                'required',
            ],
            'wifi' => [
                'required',
            ],
            'security' => [
                'required',
            ],
            'connectivity' => [
                'required',
            ],
            'audio_tech' => [
                'required',
            ],
            'describe' => [
                'required',
            ],
            'weight' => [
                'required',
            ],
            'battery' => [
                'required',
            ],
            'cooling_system' => [
                'required',
            ],
            'color' => [
                'required',
            ],
            'material' => [
                'required',
            ],
            'dimension' => [
                'required',
            ],
            'release_date' => [
                'required',
            ],
            'image.*' => [
                'bail',
                'nullable',
                'file',
                'image'
            ]
        ];
    }
}
