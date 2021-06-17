<?php

namespace App\Repositories;

use App\Models\LetterCourseQuestion;
use App\Models\LetterCategory;
use App\Models\LetterCourse;
use App\Models\LetterCourseAnswer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LetterQuestionRepository
{
    public function createNew($data)
    {

        $question = new LetterCourseQuestion;

        $question->code = Str::random(15);
        $question->question = $data['question'];
        $question->letter_course_id = $data['letter_course_id'];
        $question->is_active = isset($value["is_active"]);
        $question->save();

        $qid = $question->id;

        foreach ($data['answer'] as $value) {
            $answer = new LetterCourseAnswer;
            $answer->code = Str::random(15);
            $answer->letter_course_question_id = $qid;
            $answer->answer = $value["answer"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;
            $answer->save();
        }

        $course = LetterCourse::where('id', request('letter_course_id'))->first();
        $course->question_count = $course->question_count+1;

        $course->update();

        return $question;
    }

    public function updateLetter($data, $id)
    {

        $question = LetterCourseQuestion::find($id);
        $question->question = $data['question'];
        $question->letter_course_id = $data['letter_course_id'];
        $question->is_active = $data['is_active'];

        if ($question->letter_course_id != $data['letter_course_id']) {
            $oldcourse = LetterCourse::where('id', $question->letter_course_id)->first();
            $oldcourse->question_count = $oldcourse->question_count - 1;

            $oldcourse->update();

            $newcourse = LetterCourse::where('id', request('letter_course_id'))->first();
            $newcourse->question_count = $newcourse->question_count + 1;

            $newcourse->update();
        }

        $question->update();

        foreach ($data['answer'] as $value) {
            $answer = LetterCourseAnswer::find($value["id"]);
            $answer->answer = $value["answer"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;

            $answer->update();
        }

        return $question;
    }
}
