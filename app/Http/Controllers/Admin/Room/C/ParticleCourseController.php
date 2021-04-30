<?php

namespace App\Http\Controllers\Admin\Room\C;

use App\Http\Controllers\Controller;
use App\Models\ParticleCourse;
use App\Models\ParticleEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParticleCourseController extends Controller
{
    public function index()
    {
        $courses = ParticleCourse::get();
        return view('particle.courses.index', compact('courses'));
    }

    public function create()
    {
        $educations = ParticleEducation::where('is_active', 1)->get();
        return view('particle.courses.create', compact('educations'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "title" => 'required',
            "particle_education_id" => 'required',
        ]);

        ParticleCourse::create([
            'code' => Str::random(10),
            'title' => request('title'),
            'particle_education_id' => request('particle_education_id'),
            'is_active' => request('is_active'),
        ]);

        return redirect()->route('particles.courses.index');
    }

    public function edit($id)
    {
        return view('particle.courses.edit', [
            'course' => ParticleCourse::where('id', $id)->first(),
            'educations' => ParticleEducation::where('is_active', 1)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            "title" => 'required',
            "is_active" => 'required',
            "particle_education_id" => 'required',
        ]);

        $letter = ParticleCourse::find($id);
        $letter->title = request('title');
        $letter->particle_education_id = request('particle_education_id');
        $letter->is_active = request('is_active');

        $letter->update();

        return redirect()->route('particles.courses.index');
    }
}
