<?php

namespace App\Http\Requests;

use App\Restaurant;
use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'     => [
                'required',
            ],
            'email'    => [
                'required',
            ],
            'code' => [
                'required',
            ],
            'number'  => [
                'required',
                'integer',
            ]
        ];
    }
}
