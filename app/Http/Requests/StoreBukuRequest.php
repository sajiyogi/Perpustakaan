<?php

namespace App\Http\Requests;

use App\Buku;
use Illuminate\Foundation\Http\FormRequest;

class StoreBukuRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('buku_create');
    }

    public function buku()
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