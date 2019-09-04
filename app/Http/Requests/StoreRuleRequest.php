<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreRuleRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'description' => [
                'required',
            ],
            'pengesah' => [
                'required',
            ],
        ];
    }
}
