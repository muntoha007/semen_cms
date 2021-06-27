<?php

namespace App\Repositories;

use App\Models\VocabularyCourseQuestion;
use App\Models\VocabularyGroup;
use App\Models\VocabularyCourseAnswer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VocabularyCourseQuestionRepository
{
    public function createNew($data)
    {

        $question = new VocabularyCourseQuestion;

        $question->code = Str::random(15);
        $question->question_jpn = $data['question_jpn'];
        $question->question_romanji = $data['question_romanji'];
        $question->question_idn = $data['question_idn'];
        $question->vocabulary_course_id = $data['vocabulary_course_id'];
        $question->is_active = isset($value["is_active"]);
        $question->save();

        $qid = $question->id;

        foreach ($data['answer'] as $value) {
            $answer = new VocabularyCourseAnswer;
            $answer->code = Str::random(15);
            $answer->vocabulary_course_question_id = $qid;
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;
            $answer->save();
        }

        $course = VocabularyGroup::where('id', request('vocabulary_course_id'))->first();
        $course->question_count = $course->question_count + 1;

        $course->update();

        return $question;
    }

    public function update($data, $id)
    {

        $question = VocabularyCourseQuestion::find($id);
        $question->question_jpn = $data['question_jpn'];
        $question->question_romanji = $data['question_romanji'];
        $question->question_idn = $data['question_idn'];
        $question->vocabulary_course_id = $data['vocabulary_course_id'];
        $question->is_active = $data['is_active'];

        if ($question->vocabulary_course_id != $data['vocabulary_course_id']) {
            $oldcourse = VocabularyGroup::where('id', $question->vocabulary_course_id)->first();
            $oldcourse->question_count = $oldcourse->question_count - 1;

            $oldcourse->update();

            $newcourse = VocabularyGroup::where('id', request('vocabulary_course_id'))->first();
            $newcourse->question_count = $newcourse->question_count + 1;

            $newcourse->update();
        }

        $question->update();

        foreach ($data['answer'] as $value) {
            $answer = VocabularyCourseAnswer::find($value["id"]);
            $answer->answer_jpn = $value["answer_jpn"];
            $answer->answer_idn = $value["answer_idn"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;

            $answer->update();
        }

        return $question;
    }
}
