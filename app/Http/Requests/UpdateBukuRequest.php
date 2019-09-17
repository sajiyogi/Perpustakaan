<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use App\Buku;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBukuRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('buku_edit');
    }

    public function rules()
    {
       return [
            'judul' => [
                'required',
            ],
            'image' => [
                'sometimes',
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
