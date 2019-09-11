<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Struktur;
use Illuminate\Foundation\Http\FormRequest;

class StoreStrukturRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('buku_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'required',
            ],
            'file' => [
                'required',
            ],
            'jabatan' => [
                'required',
            ],

        ];
    }
}
