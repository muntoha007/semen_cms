<?php

namespace App\Repositories;

use App\Models\ParticleMiniCourse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class ParticleMiniCourseRepository
{
    public function create($data)
    {

        $course = new ParticleMiniCourse();
        $course->code = Str::random(10);
        $course->title = $data['title'];
        $course->particle_education_id = $data['particle_education_id'];
        $course->is_active = 1;
        $course->save();

        return $course;
    }

    public function updatecourse($data, $id)
    {
        $course = ParticleMiniCourse::find($id);
        $course->title = $data['title'];
        $course->particle_education_id = $data['particle_education_id'];
        $course->is_active = $data['is_active'];
        $course->update();

        return $course;
    }
}
