<?php

namespace App\Http\Controllers\Admin\Room\B;

use App\Http\Controllers\Controller;
use App\Models\VerbCourseQuestion;
use App\Models\LetterCategory;
use App\Models\VerbCourse;
use App\Models\VerbCourseAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VerbCourseQuestionController extends Controller
{
    public function index()
    {
        $questions = VerbCourseQuestion::get();
        return view('verb.questions.index', compact('questions'));
    }

    public function create()
    {
        $verbs = VerbCourse::get();
        return view('verb.questions.create', compact('verbs'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        request()->validate([
            "question_jpn" => 'required',
            "question_romanji" => 'required',
            "question_idn" => 'required',
            "verb_course_id" => 'required',
            "answer" => 'required',
        ]);

        $question = VerbCourseQuestion::create([
            'code' => Str::random(10),
            'question_jpn' => request('question_jpn'),
            'question_romanji' => request('question_romanji'),
            'question_idn' => request('question_idn'),
            'verb_course_id' => request('verb_course_id'),
            'is_active' => 1,
        ]);

        $qid = $question->id;

        foreach ($data['answer'] as $value) {
            $answer = new VerbCourseAnswer;
            $answer->code = Str::random(10);
            $answer->verb_course_question_id = $qid;
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;
            $answer->save();
        }

        $course = VerbCourse::where('id', request('verb_course_id'))->first();
        $course->question_count = $course->question_count+1;

        $course->update();

        return redirect()->route('verbs.questions.index');
    }

    public function edit($id)
    {
        return view('verb.questions.edit', [
            'question' => VerbCourseQuestion::where('id', $id)->first(),
            'verbs' => VerbCourse::get(),
            'answers' => VerbCourseAnswer::where('verb_course_question_id', $id)->get(),
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
            "verb_course_id" => 'required',
            "answer" => 'required',
        ]);

        $question = VerbCourseQuestion::find($id);
        $question->question_jpn = $data['question_jpn'];
        $question->question_romanji = $data['question_romanji'];
        $question->question_idn = $data['question_idn'];
        $question->verb_course_id = $data['verb_course_id'];
        $question->is_active = $data['is_active'];

        $question->update();

        foreach ($data['answer'] as $value) {
            $answer = VerbCourseAnswer::find($value["id"]);
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;

            $answer->update();
        }

        return redirect()->route('verbs.questions.index');
    }
}
