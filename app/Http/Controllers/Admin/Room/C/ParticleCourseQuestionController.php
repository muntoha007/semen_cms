<?php

namespace App\Http\Controllers\Admin\Room\C;

use App\Http\Controllers\Controller;
use App\Models\ParticleCourseQuestion;
use App\Models\ParticleCourse;
use App\Models\ParticleCourseAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParticleCourseQuestionController extends Controller
{
    public function index()
    {
        $questions = ParticleCourseQuestion::get();
        return view('particle.questions.index', compact('questions'));
    }

    public function create()
    {
        $partCourses = ParticleCourse::where('is_active', 1)->get();
        return view('particle.questions.create', compact('partCourses'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
// dd($data);
        request()->validate([
            "question_jpn" => 'required',
            "question_romanji" => 'required',
            "question_idn" => 'required',
            "particle_course_id" => 'required',
            "answer" => 'required',
        ]);

        $question = ParticleCourseQuestion::create([
            'code' => Str::random(20),
            'question_jpn' => request('question_jpn'),
            'question_romanji' => request('question_romanji'),
            'question_idn' => request('question_idn'),
            'particle_course_id' => request('particle_course_id'),
            'is_active' => 0,
        ]);

        $qid = $question->id;

        foreach ($data['answer'] as $value) {
            $answer = new ParticleCourseAnswer;
            $answer->code = Str::random(20);
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->answer_romanji = $value["answer_romanji"];
            $answer->particle_course_question_id = $qid;
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;
            $answer->save();
        }

        $course = ParticleCourse::where('id', request('particle_course_id'))->first();
        $course->question_count = $course->question_count+1;

        $course->update();

        return redirect()->route('particles.questions.index');
    }

    public function edit($id)
    {
        return view('particle.questions.edit', [
            'question' => ParticleCourseQuestion::where('id', $id)->first(),
            'partCourses' => ParticleCourse::where('is_active', 1)->get(),
            'answers' => ParticleCourseAnswer::where('particle_course_question_id', $id)->get(),
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
            "particle_course_id" => 'required',
            "answer" => 'required',
        ]);

        $question = ParticleCourseQuestion::find($id);
        $question->question_jpn = $data['question_jpn'];
        $question->question_romanji = $data['question_romanji'];
        $question->question_idn = $data['question_idn'];
        $question->particle_course_id = $data['particle_course_id'];
        $question->is_active = $data['is_active'];

        $question->update();

        foreach ($data['answer'] as $value) {
            $answer = ParticleCourseAnswer::find($value["id"]);
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->answer_romanji = $value["answer_romanji"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;

            $answer->update();
        }

        return redirect()->route('particles.questions.index');
    }
}
