<?php

namespace App\Http\Controllers\Admin\Room\C;

use App\Http\Controllers\Controller;
use App\Models\ParticleEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParticleEducationController extends Controller
{
    public function index()
    {
        $educations = ParticleEducation::get();
        return view('particle.educations.index', compact('educations'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        request()->validate([
            "title" => 'required',
            "letter" => 'required',
            "description" => 'required',
        ]);

        ParticleEducation::create([
            'code' => Str::random(20),
            'letter' => request('letter'),
            'title' => request('title'),
            'description' => request('description'),
            'is_active' => request('is_active'),
        ]);

        return back();
    }

    public function edit($id)
    {
        return view('particle.educations.edit', [
            'education' => ParticleEducation::where('id', $id)->first(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => 'required',
            "letter" => 'required',
            "description" => 'required',
        ]);

        $particle = ParticleEducation::find($id);
        $particle->title = request('title');
        $particle->letter = request('letter');
        $particle->description = request('description');
        $particle->is_active = request('is_active');

        $particle->update();

        return redirect()->route('particles.educations.index');
    }
}
