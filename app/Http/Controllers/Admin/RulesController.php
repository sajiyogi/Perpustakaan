<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRuleRequest;
use App\Http\Requests\StoreRuleRequest;
use App\Http\Requests\UpdateRuleRequest;
use App\Rule;

class RulesController extends Controller
{
    
    public function index()
    {
        abort_unless(\Gate::allows('rule_access'), 403);

        $rules = Rule::all();

        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('rule_create'), 403);

        return view('admin.rules.create');
    }

    public function store(StoreruleRequest $request)
    {
        abort_unless(\Gate::allows('rule_create'), 403);

        $rule = rule::create($request->all());

        return redirect()->route('admin.rules.index');
    }

    public function edit(rule $rule)
    {
        abort_unless(\Gate::allows('rule_edit'), 403);

        return view('admin.rules.edit', compact('rule'));
    }

    public function update(UpdateruleRequest $request, rule $rule)
    {
        abort_unless(\Gate::allows('rule_edit'), 403);

        $rule->update($request->all());

        return redirect()->route('admin.rules.index');
    }

    public function show(rule $rule)
    {
        abort_unless(\Gate::allows('rule_show'), 403);

        return view('admin.rules.show', compact('rule'));
    }

    public function destroy(rule $rule)
    {
        abort_unless(\Gate::allows('rule_delete'), 403);

        $rule->delete();

        return back();
    }

    public function massDestroy(MassDestroyruleRequest $request)
    {
        rule::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
