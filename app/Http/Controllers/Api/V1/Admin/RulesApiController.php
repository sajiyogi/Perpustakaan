<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRuleRequest;
use App\Http\Requests\UpdateRuleRequest;
use App\rule;

class RulesApiController extends Controller
{
    public function index()
    {
        $rules = Rule::all();

        return $rules;
    }

    public function store(StoreRuleRequest $request)
    {
        return rule::create($request->all());
    }

    public function update(UpdateRuleRequest $request, Rule $rule)
    {
        return $rule->update($request->all());
    }

    public function show(Rule $rule)
    {
        return $rule;
    }

    public function destroy(Rule $rule)
    {
        return $rule->delete();
    }
}
