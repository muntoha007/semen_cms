<?php

namespace App\Repositories;

use App\Models\PatternCourse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class PatternCourseRepository
{
    public function create($data)
    {

        $course = new PatternCourse();
        $course->code = Str::random(15);
        $course->title = $data['title'];
        // $course->particle_education_id = $data['particle_education_id'];
        $course->is_active = 1;
        $course->save();

        return $course;
    }

    public function updatecourse($data, $id)
    {
        $course = PatternCourse::find($id);
        $course->title = $data['title'];
        // $course->particle_education_id = $data['particle_education_id'];
        $course->is_active = $data['is_active'];
        $course->update();

        return $course;
    }
}
