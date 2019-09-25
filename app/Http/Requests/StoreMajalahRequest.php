<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Majalah;
use Illuminate\Foundation\Http\FormRequest;

class StoreMajalahRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('majalah_create');
    }

    public function rules()
    {
        return [
            'judul' => [
                'required',
            ],
            'file' => [
                'required',
            ],
            'penyusun' => [
                'required',
            ],
            'kategori' => [
                'required',
            ],

        ];
    }
}
