<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use App\Struktur;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStrukturRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('struktur_edit');
    }

    public function struktur()
    {
        return [
           'nama' => [
                'required',
            ],
            'jabatan' => [
                'required',
            ],
        ];
    }
}
