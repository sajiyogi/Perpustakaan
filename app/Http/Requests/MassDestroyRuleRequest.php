<?php

namespace App\Http\Requests;

use App\Rule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyRuleRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('rule_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rules,id',
        ];
    }
}
