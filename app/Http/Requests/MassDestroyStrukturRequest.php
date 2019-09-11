<?php

namespace App\Http\Requests;

use App\Struktur;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyStrukturRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('struktur_delete'), 403, '403 Forbidden') ?? true;
    }

    public function struktur()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:strukturs,id',
        ];
    }
}
