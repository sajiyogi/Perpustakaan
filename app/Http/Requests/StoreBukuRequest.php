<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Buku;
use Illuminate\Foundation\Http\FormRequest;

class StoreBukuRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('buku_create');
    }

    public function rules()
    {
        return [
            'judul' => [
                'required',
            ],
            'image' => [
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
