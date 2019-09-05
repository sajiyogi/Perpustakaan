<?php

namespace App\Http\Requests;

use App\Buku;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyBukuRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('buku_delete'), 403, '403 Forbidden') ?? true;
    }

    public function bukus()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bukus,id',
        ];
    }
}
