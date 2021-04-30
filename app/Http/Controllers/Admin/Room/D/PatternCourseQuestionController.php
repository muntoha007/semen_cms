<?php

namespace App\Http\Controllers\Admin\Room\D;

use App\Http\Controllers\Controller;
use App\Models\PatternCourseQuestion;
use App\Models\PatternCourse;
use App\Models\PatternCourseAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatternCourseQuestionController extends Controller
{
    public function index()
    {
        $questions = PatternCourseQuestion::get();
        return view('pattern.questions.index', compact('questions'));
    }

    public function create()
    {
        $patCourses = PatternCourse::where('is_active', 1)->get();
        return view('pattern.questions.create', compact('patCourses'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
// dd($data);
        request()->validate([
            "question_jpn" => 'required',
            "question_romanji" => 'required',
            "question_idn" => 'required',
            "pattern_course_id" => 'required',
            "answer" => 'required',
        ]);

        $question = PatternCourseQuestion::create([
            'code' => Str::random(20),
            'question_jpn' => request('question_jpn'),
            'question_romanji' => request('question_romanji'),
            'question_idn' => request('question_idn'),
            'pattern_course_id' => request('pattern_course_id'),
            'is_active' => 0,
        ]);

        $qid = $question->id;

        foreach ($data['answer'] as $value) {
            $answer = new PatternCourseAnswer;
            $answer->code = Str::random(20);
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->answer_romanji = $value["answer_romanji"];
            $answer->pattern_course_question_id = $qid;
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;
            $answer->save();
        }

        $course = PatternCourse::where('id', request('pattern_course_id'))->first();
        $course->question_count = $course->question_count+1;

        $course->update();

        return redirect()->route('patterns.questions.index');
    }

    public function edit($id)
    {
        return view('pattern.questions.edit', [
            'question' => PatternCourseQuestion::where('id', $id)->first(),
            'patCourses' => PatternCourse::where('is_active', 1)->get(),
            'answers' => PatternCourseAnswer::where('pattern_course_question_id', $id)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $request->validate([
            "question_jpn" => 'required',
            "question_romanji" => 'required',
            "question_idn" => 'required',
            "pattern_course_id" => 'required',
            "answer" => 'required',
        ]);

        $question = PatternCourseQuestion::find($id);
        $question->question_jpn = $data['question_jpn'];
        $question->question_romanji = $data['question_romanji'];
        $question->question_idn = $data['question_idn'];
        $question->pattern_course_id = $data['pattern_course_id'];
        $question->is_active = $data['is_active'];

        $question->update();

        foreach ($data['answer'] as $value) {
            $answer = PatternCourseAnswer::find($value["id"]);
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->answer_romanji = $value["answer_romanji"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;

            $answer->update();
        }

        return redirect()->route('patterns.questions.index');
    }
}
