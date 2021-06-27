<?php

namespace App\Repositories;

use App\Models\course;
use App\Models\VocabularyGroup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class VocabularyGroupRepository
{
    public function create($data)
    {

        $course = new VocabularyGroup();
        $course->code = Str::random(10);
        $course->title = $data['title'];
        $course->is_active = $data['is_active'];
        $course->save();

        return $course;
    }

    public function update($data, $id)
    {
        $course = VocabularyGroup::find($id);
        $course->title = $data['title'];
        $course->is_active = $data['is_active'];
        $course->update();

        return $course;
    }
}
