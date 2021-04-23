<?php

namespace App\Http\Controllers\Admin\Room\A;

use App\Http\Controllers\Controller;
use App\Models\LetterCourseQuestion;
use App\Models\LetterCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LetterCourseAnswerController extends Controller
{
    public function index()
    {
        $courses = LetterCourseQuestion::get();
        return view('courses.courses.index', compact('courses'));
    }

    public function create()
    {
        $questions = LetterCategory::get();
        return view('courses.questions.create', compact('questions'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "title" => 'required',
            "category" => 'required',
        ]);

        LetterCourseQuestion::create([
            'code' => Str::random(10),
            'title' => request('title'),
            'course_category_id' => request('category'),
            'is_active' => 1,
        ]);

        return redirect()->route('courses.questions.index');
    }

    public function edit($id)
    {
        // dd(Letter::where('id', $id)->first());
        return view('courses.questions.edit', [
            'course' => LetterCourseQuestion::where('id', $id)->first(),
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

        $letter = LetterCourseQuestion::find($id);
        $letter->title = request('title');
        $letter->course_category_id = request('category');
        $letter->is_active = request('is_active');

        $letter->update();

        return redirect()->route('courses.questions.index');
    }
}
