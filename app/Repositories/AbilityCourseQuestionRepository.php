<?php

namespace App\Repositories;

use App\Models\AbilityCourseQuestion;
use App\Models\AbilityCourse;
use App\Models\AbilityCourseAnswer;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AbilityCourseQuestionRepository
{
    public function createNew($data)
    {

        $client = new Client([
            'base_uri' => env('CLOUD_S3_UPLOAD'),
            // default timeout 5 detik
            'timeout'  => 5,
        ]);

        $question = new AbilityCourseQuestion;

         // for image
         $image = base64_encode(file_get_contents($data['question_img']));
         $response_img = $client->request('POST', '/api/v1/cdn', [
             'json' => [
                 'bucket' => 'ability',
                 'image' => $image
             ]
         ]);

         $body_img = $response_img->getBody();
         $img_url = json_decode($body_img);

        $question->code = Str::random(15);
        $question->question_jpn = $data['question_jpn'];
        $question->question_img = $img_url->data->path;
        $question->ability_course_id = $data['ability_course_id'];
        $question->is_active = isset($value["is_active"]);
        $question->save();

        $qid = $question->id;

        foreach ($data['answer'] as $value) {
            $answer = new AbilityCourseAnswer;
            $answer->code = Str::random(15);
            $answer->ability_course_question_id = $qid;
            $answer->answer = $value["answer"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;
            $answer->save();
        }

        $course = AbilityCourse::where('id', request('ability_course_id'))->first();
        $course->question_count = $course->question_count + 1;

        $course->update();

        return $question;
    }

    public function update($data, $id)
    {

        $client = new Client([
            'base_uri' => env('CLOUD_S3_UPLOAD'),
            // default timeout 5 detik
            'timeout'  => 5,
        ]);

        $question = AbilityCourseQuestion::find($id);

        if (isset($data['question_img'])) {
            $response_img_del = $client->request('DELETE', '/api/v1/cdn/' . $question->question_img);

            // for image
            $image = base64_encode(file_get_contents($data['question_img']));
            $response_img = $client->request('POST', '/api/v1/cdn', [
                'json' => [
                    'bucket' => 'ability',
                    'image' => $image
                ]
            ]);
            $body_img = $response_img->getBody();
            $img_url = json_decode($body_img);
            $question->question_img = $img_url->data->path;
        }

        $question->question_jpn = $data['question_jpn'];
        $question->ability_course_id = $data['ability_course_id'];
        $question->is_active = $data['is_active'];

        if ($question->ability_course_id != $data['ability_course_id']) {
            $oldcourse = AbilityCourse::where('id', $question->ability_course_id)->first();
            $oldcourse->question_count = $oldcourse->question_count - 1;

            $oldcourse->update();

            $newcourse = AbilityCourse::where('id', request('ability_course_id'))->first();
            $newcourse->question_count = $newcourse->question_count + 1;

            $newcourse->update();
        }

        $question->update();

        foreach ($data['answer'] as $value) {
            $answer = AbilityCourseAnswer::find($value["id"]);
            $answer->answer = $value["answer"];
            $answer->is_true = isset($value["is_true"]) ? 1 : 0;

            $answer->update();
        }

        return $question;
    }
}
