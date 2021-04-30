<?php

namespace App\Http\Controllers\Admin\Room\D;

use App\Http\Controllers\Controller;
use App\Models\PatternChapter;
use App\Models\PatternLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatternLessonController extends Controller
{
    public function index()
    {
        $lessons = PatternLesson::get();
        $chapters = PatternChapter::where('is_active', 1)->get();
        return view('pattern.lessons.index', compact('lessons', 'chapters'));
    }

    public function create()
    {
        // $levels = PatternChapter::get();
        // return view('pattern.words.form-control', compact('levels'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "name" => 'required',
            "pattern_chapter_id" => 'required',
        ]);

        PatternLesson::create([
            'code' => Str::random(20),
            'name' => request('name'),
            'pattern_chapter_id' => request('pattern_chapter_id'),
            'is_active' => request('is_active'),
        ]);

        return back();
    }

    public function edit($id)
    {
        return view('pattern.lessons.edit', [
            'lesson' => PatternLesson::where('id', $id)->first(),
            'chapters' => PatternChapter::where('is_active', 1)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => 'required',
            "pattern_chapter_id" => 'required',
            "is_active" => 'required',
        ]);

        $lesson = PatternLesson::find($id);
        $lesson->name = request('name');
        $lesson->pattern_chapter_id = request('pattern_chapter_id');
        $lesson->is_active = request('is_active');

        $lesson->update();

        return redirect()->route('patterns.lessons.index');
    }
}
