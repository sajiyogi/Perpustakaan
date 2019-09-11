<?php

namespace App\Http\Requests;

use App\Ebook;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEbookRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('ebook_edit');
    }

    public function ebook()
    {
        return [
           'judul' => [
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
