<?php

namespace App\Http\Requests;

use App\Buku;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRuleRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('buku_edit');
    }

    public function bukus()
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
