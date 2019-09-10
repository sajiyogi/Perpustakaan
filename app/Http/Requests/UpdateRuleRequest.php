<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRuleRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('product_edit');
    }

    public function Rule()
    {
        return [
           'judul' => [
                'required',
            ],
            'image' => [
                'required',
            ],
            'id_kategori' => [
                'required',
            ],
            'pengarang' => [
                'required',
            ],
            'penerbit' => [
                'required',
            ],
            'jumlah' => [
                'required',
            ],
        ];
    }
}
