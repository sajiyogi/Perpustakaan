<?php

namespace App\Http\Requests;

use App\Majalah;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyMajalahRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('majalah_delete'), 403, '403 Forbidden') ?? true;
    }

    public function majalah()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:majalahs,id',
        ];
    }
}
