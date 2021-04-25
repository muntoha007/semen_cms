<?php

namespace App\Http\Controllers\Admin\Room\B;

use App\Http\Controllers\Controller;
use App\Models\VerbCourse;
use App\Models\MasterVerbLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VerbCourseController extends Controller
{
    public function index()
    {
        $courses = VerbCourse::get();
        return view('verb.courses.index', compact('courses'));
    }

    public function create()
    {
        $levels = MasterVerbLevel::get();
        return view('verbs.courses.create', compact('levels'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "title" => 'required',
            "master_verb_level_id" => 'required',
        ]);

        VerbCourse::create([
            'code' => Str::random(10),
            'title' => request('title'),
            'master_verb_level_id' => request('master_verb_level_id'),
            'is_active' => 1,
        ]);

        return redirect()->route('verbs.courses.index');
    }

    public function edit($id)
    {
        return view('verb.courses.edit', [
            'course' => VerbCourse::where('id', $id)->first(),
            'levels' => MasterVerbLevel::get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => 'required',
            "is_active" => 'required',
            "master_verb_level_id" => 'required',
        ]);

        $letter = VerbCourse::find($id);
        $letter->title = request('title');
        $letter->master_verb_level_id = request('master_verb_level_id');
        $letter->is_active = request('is_active');

        $letter->update();

        return redirect()->route('verbs.courses.index');
    }
}
