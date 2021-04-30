<?php

namespace App\Http\Controllers\Admin\Room\C;

use App\Http\Controllers\Controller;
use App\Models\ParticleEducation;
use App\Models\ParticleEducationDetail;
use App\Repositories\EducationDetailRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParticleEducationDetailController extends Controller
{
    public function __construct()
    {
        $this->model = new ParticleEducationDetail;
        $this->repository = new EducationDetailRepository;
    }

    public function index()
    {
        $details = ParticleEducationDetail::get();
        return view('particle.educations.details.index', compact('details'));
    }

    public function create()
    {
        $educations = ParticleEducation::where('is_active', 1)->get();
        $submit = "Create";
        return view('particle.educations.details.create', compact('educations', 'submit'));
    }

    public function store(Request $request)
    {
        $param = $request->all();
        // dd($param);
        $saveData = $this->repository->createNew($param);

        if (!empty($saveData)) {
            $request->session()->flash('success', 'Data Education Detail berhasil di masukan!');
            return redirect()->route('particles.educations.details.index');
        } else {
            $request->session()->flash('error', 'Gagal menyimpan data Education Detail!');
            return redirect()->route('particles.educations.details.index');
        }
    }

    public function edit($id)
    {

        return view('particle.educations.details.edit', [
            'detail' => ParticleEducationDetail::where('id', $id)->first(),
            'educations' => ParticleEducation::where('is_active', 1)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "sentence_jpn" => 'required',
            "sentence_romanji" => 'required',
            "sentence_idn" => 'required',
            "particle_education_id" => 'required',
        ]);

        $param = $request->all();

        $updateData = $this->repository->updateDetail($param, $id);

        if (!empty($updateData)) {
            $request->session()->flash('success', 'Data Education Detail berhasil di update!');
            return redirect()->route('particles.educations.details.index');
        } else {
            $request->session()->flash('error', 'Gagal update data!');
            return redirect()->route('particles.educations.details.index');
        }
    }
}
