<?php

namespace App\Repositories;

use App\Models\ParticleCourseQuestion;
use App\Models\ParticleCourse;
use App\Models\ParticleCourseAnswer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParticleCourseQuestionRepository
{
    public function createNew($data)
    {

        $question = new ParticleCourseQuestion;

        $question->code = Str::random(15);
        $question->question_jpn = $data['question_jpn'];
        $question->question_romanji = $data['question_romanji'];
        $question->question_idn = $data['question_idn'];
        $question->particle_course_id = $data['particle_course_id'];
        $question->is_active = isset($value["is_true"]) ? 1 : 0;
        $question->save();

        $qid = $question->id;

        foreach ($data['answer'] as $value) {
            $answer = new ParticleCourseAnswer;
            $answer->code = Str::random(15);
            $answer->particle_course_question_id = $qid;
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_romanji = $value["answer_romanji"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;
            $answer->save();
        }

        $course = ParticleCourse::where('id', request('particle_course_id'))->first();
        $course->question_count = $course->question_count + 1;

        $course->update();

        return $question;
    }

    public function update($data, $id)
    {

        $question = ParticleCourseQuestion::find($id);

        $question->question_jpn = $data['question_jpn'];
        $question->question_romanji = $data['question_romanji'];
        $question->question_idn = $data['question_idn'];
        $question->particle_course_id = $data['particle_course_id'];
        $question->is_active = $data['is_active'];

        if ($question->particle_course_id != $data['particle_course_id']) {
            $oldcourse = ParticleCourse::where('id', $question->particle_course_id)->first();
            $oldcourse->question_count = $oldcourse->question_count - 1;

            $oldcourse->update();

            $newcourse = ParticleCourse::where('id', request('particle_course_id'))->first();
            $newcourse->question_count = $newcourse->question_count + 1;

            $newcourse->update();
        }

        $question->update();

        foreach ($data['answer'] as $value) {
            $answer = ParticleCourseAnswer::find($value["id"]);
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_romanji = $value["answer_romanji"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;

            $answer->update();
        }

        return $question;
    }
}
