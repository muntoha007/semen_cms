<?php

namespace App\Repositories;

use App\Models\AbilityCourse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class AbilityCourseRepository
{
    public function create($data)
    {

        $kanji = new AbilityCourse();
        $kanji->code = Str::random(10);
        // $kanji->title = $data['title'];
        $kanji->master_ability_course_id = $data['master_ability_course_id'];
        $kanji->master_ability_course_level_id = $data['master_ability_course_level_id'];
        $kanji->question_count = 0;
        $kanji->is_active = $data['is_active'];
        $kanji->save();

        return $kanji;
    }

    public function update($data, $id)
    {
        $kanji = AbilityCourse::find($id);
        // $kanji->title = $data['title'];
        $kanji->master_ability_course_id = $data['master_ability_course_id'];
        $kanji->master_ability_course_level_id = $data['master_ability_course_level_id'];
        $kanji->is_active = $data['is_active'];
        $kanji->update();

        return $kanji;
    }
}
