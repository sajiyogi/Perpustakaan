<?php

namespace App\Http\Requests;

use App\Majalah;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMajalahRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('majalah_edit');
    }

    public function majalah()
    {
        return [
           'judul' => [
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
