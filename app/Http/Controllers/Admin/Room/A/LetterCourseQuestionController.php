<?php

namespace App\Http\Controllers\Admin\Room\A;

use App\Http\Controllers\Controller;
use App\Models\LetterCourseQuestion;
use App\Models\LetterCategory;
use App\Models\LetterCourse;
use App\Models\LetterCourseAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LetterCourseQuestionController extends Controller
{
    public function index()
    {
        $questions = LetterCourseQuestion::get();
        return view('letters.questions.index', compact('questions'));
    }

    public function create()
    {
        $letters = LetterCourse::get();
        return view('letters.questions.create', compact('letters'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        request()->validate([
            "question" => 'required',
            "letter" => 'required',
            "answer" => 'required',
        ]);



        $question = LetterCourseQuestion::create([
            'code' => Str::random(10),
            'question' => request('question'),
            'letter_course_id' => request('letter'),
            'is_active' => 1,
        ]);

        $qid = $question->id;

        foreach ($data['answer'] as $value) {
            $answer = new LetterCourseAnswer;
            $answer->code = Str::random(10);
            $answer->letter_course_question_id = $qid;
            $answer->answer = $value["answer"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;
            $answer->save();
        }

        $course = LetterCourse::where('id', request('letter'))->first();
        $course->question_count = $course->question_count+1;

        $course->update();

        return redirect()->route('letters.questions.index');
    }

    public function edit($id)
    {
        return view('letters.questions.edit', [
            'question' => LetterCourseQuestion::where('id', $id)->first(),
            'letters' => LetterCourse::get(),
            'answers' => LetterCourseAnswer::where('letter_course_question_id', $id)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $request->validate([
            "question" => 'required',
            "letter" => 'required',
            "answer" => 'required',
        ]);

        $question = LetterCourseQuestion::find($id);
        $question->question = $data['question'];
        $question->letter_course_id = $data['letter'];
        $question->is_active = $data['is_active'];

        $question->update();

        foreach ($data['answer'] as $value) {
            $answer = LetterCourseAnswer::find($value["id"]);
            $answer->answer = $value["answer"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;

            $answer->update();
        }

        return redirect()->route('letters.questions.index');
    }
}
