<?php

namespace App\Http\Controllers\Admin\Room\D;

use App\Http\Controllers\Controller;
use App\Models\PatternCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatternCourseController extends Controller
{
    public function index()
    {
        $courses = PatternCourse::get();
        return view('pattern.courses.index', compact('courses'));
    }

    public function create()
    {
        // $lessons = PatternLesson::where('is_active', 1)->get();
        // return view('particle.courses.create', compact('lessons'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "title" => 'required',
            // "particle_lesson_id" => 'required',
        ]);

        PatternCourse::create([
            'code' => Str::random(10),
            'title' => request('title'),
            'is_active' => request('is_active'),
            // // 'particle_lesson_id' => request('particle_lesson_id'),
        ]);

        return redirect()->route('patterns.courses.index');
    }

    public function edit($id)
    {
        return view('pattern.courses.edit', [
            'course' => PatternCourse::where('id', $id)->first(),
            // 'educations' => PatternLesson::where('is_active', 1)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            "title" => 'required',
            "is_active" => 'required',
            // "particle_lesson_id" => 'required',
        ]);

        $course = PatternCourse::find($id);
        $course->title = request('title');
        $course->is_active = request('is_active');
        // // $course->particle_lesson_id = request('particle_lesson_id');

        $course->update();

        return redirect()->route('patterns.courses.index');
    }
}
