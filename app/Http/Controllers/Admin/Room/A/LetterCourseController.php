<?php

namespace App\Http\Controllers\Admin\Room\A;

use App\Http\Controllers\Controller;
use App\Models\LetterCourse;
use App\Models\LetterCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LetterCourseController extends Controller
{
    public function index()
    {
        $courses = LetterCourse::get();
        return view('letters.courses.index', compact('courses'));
    }

    public function create()
    {
        $courseCats = LetterCategory::get();
        return view('letters.courses.create', compact('courseCats'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "title" => 'required',
            "category" => 'required',
        ]);

        LetterCourse::create([
            'code' => Str::random(10),
            'title' => request('title'),
            'course_category_id' => request('category'),
            'is_active' => 1,
        ]);

        return redirect()->route('letters.courses.index');
    }

    public function edit($id)
    {
        // dd(Letter::where('id', $id)->first());
        return view('letters.courses.edit', [
            'course' => LetterCourse::where('id', $id)->first(),
            'courseCats' => LetterCategory::get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => 'required',
            "is_active" => 'required',
            "category" => 'required',
        ]);

        $letter = LetterCourse::find($id);
        $letter->title = request('title');
        $letter->course_category_id = request('category');
        $letter->is_active = request('is_active');

        $letter->update();

        return redirect()->route('letters.courses.index');
    }
}
