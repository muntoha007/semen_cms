<?php

namespace App\Repositories;

use App\Models\PatternMiniCourse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class PatternMiniCourseRepository
{
    public function create($data)
    {

        $course = new PatternMiniCourse();
        $course->code = Str::random(15);
        $course->title = $data['title'];
        $course->pattern_lesson_id = $data['pattern_lesson_id'];
        $course->is_active = 1;
        $course->save();

        return $course;
    }

    public function updatecourse($data, $id)
    {
        $course = PatternMiniCourse::find($id);
        $course->title = $data['title'];
        $course->pattern_lesson_id = $data['pattern_lesson_id'];
        $course->is_active = $data['is_active'];
        $course->update();

        return $course;
    }
}
