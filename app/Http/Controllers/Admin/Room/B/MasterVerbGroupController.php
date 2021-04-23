<?php

namespace App\Http\Controllers\Admin\Room\B;

use App\Http\Controllers\Controller;
use App\Models\MasterVerbGroup;
use App\Models\MasterVerbLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasterVerbGroupController extends Controller
{
    public function index()
    {
        $groups = MasterVerbGroup::get();
        $levels = MasterVerbLevel::get();
        return view('verb.groups.index', compact('groups', 'levels'));
    }

    public function create()
    {
        // $levels = MasterVerbLevel::get();
        // return view('verb.groups.form-control', compact('levels'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "name" => 'required',
            "level" => 'required',
        ]);

        MasterVerbGroup::create([
            'code' => Str::random(20),
            'name' => request('name'),
            'master_verb_level_id' => request('level'),
            'is_active' => 1,
        ]);

        return redirect()->route('verbs.groups.index');
    }

    public function edit($id)
    {
        // dd(Letter::where('id', $id)->first());
        return view('verb.groups.edit', [
            'group' => MasterVerbGroup::where('id', $id)->first(),
            'levels' => MasterVerbLevel::get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => 'required',
            "is_active" => 'required',
            "level" => 'required',
        ]);

        $group = MasterVerbGroup::find($id);
        $group->name = request('name');
        $group->master_verb_level_id = request('level');
        $group->is_active = request('is_active');

        $group->update();

        return redirect()->route('verbs.groups.index');
    }
}
