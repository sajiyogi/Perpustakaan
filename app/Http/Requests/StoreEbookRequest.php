<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Ebook;
use Illuminate\Foundation\Http\FormRequest;

class StoreEbookRequest extends FormRequest
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
            'file' => [
                'required',
            ],
            'pengarang' => [
                'required',
            ],
            'penerbit' => [
                'required',
            ],

        ];
    }
}
