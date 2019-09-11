<?php

namespace App\Http\Requests;

use App\Ebook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyEbookRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('ebook_delete'), 403, '403 Forbidden') ?? true;
    }

    public function ebook()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ebooks,id',
        ];
    }
}
