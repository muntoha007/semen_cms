<?php

namespace App\Http\Controllers\Admin\Room\B;

use App\Http\Controllers\Controller;
use App\Models\MasterVerbLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasterVerbLevelController extends Controller
{
    public function index()
    {
        $levels = MasterVerbLevel::get();
        return view('verb.levels.index', compact('levels'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        request()->validate([
            "name" => 'required',
        ]);

        MasterVerbLevel::create([
            'code' => Str::random(15),
            'name' => request('name'),
            'is_active' => 1,
        ]);

        return back();
    }

    public function edit($id)
    {
        return view('verb.levels.edit', [
            'level' => MasterVerbLevel::where('id', $id)->first(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => 'required',
            "is_active" => 'required',
        ]);

        $level = MasterVerbLevel::find($id);
        $level->name = request('name');
        $level->is_active = request('is_active');

        $level->update();

        return redirect()->route('letters.courses.index');
    }
}
