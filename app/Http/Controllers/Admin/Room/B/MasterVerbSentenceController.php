<?php

namespace App\Http\Controllers\Admin\Room\B;

use App\Http\Controllers\Controller;
use App\Models\VerbChange;
use App\Models\MasterVerbSentence;
use App\Repositories\VerbSentenceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasterVerbSentenceController extends Controller
{
    public function __construct()
    {
        $this->model = new MasterVerbSentence;
        $this->repository = new VerbSentenceRepository;
    }

    public function index()
    {
        $sentences = MasterVerbSentence::get();
        return view('verb.sentences.index', compact('sentences'));
    }

    public function create()
    {
        $changes = VerbChange::where('is_active', 1)->get();
        $submit = "Create";
        return view('verb.sentences.create', compact('changes', 'submit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "sentence_jpn" => 'required',
            "sentence_romanji" => 'required',
            "sentence_idn" => 'required',
            "verb_change_id" => 'required',
        ]);

        $param = $request->all();
        // dd($param);
        $saveData = $this->repository->createNew($param);

        if (!empty($saveData)) {
            $request->session()->flash('success', 'Data Verb Sentence berhasil di masukan!');
            return redirect()->route('verbs.sentences.index');
        } else {
            $request->session()->flash('error', 'Gagal menyimpan data Verb Sentence!');
            return redirect()->route('verbs.sentences.index');
        }
    }

    public function edit($id)
    {

        return view('verb.sentences.edit', [
            'sentence' => MasterVerbSentence::where('id', $id)->first(),
            'changes' => VerbChange::where('is_active', 1)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "sentence_jpn" => 'required',
            "sentence_romanji" => 'required',
            "sentence_idn" => 'required',
            "verb_change_id" => 'required',
        ]);

        $param = $request->all();

        $updateData = $this->repository->updateDetail($param, $id);

        if (!empty($updateData)) {
            $request->session()->flash('success', 'Data Verb Sentence berhasil di update!');
            return redirect()->route('verbs.sentences.index');
        } else {
            $request->session()->flash('error', 'Gagal update data!');
            return redirect()->route('verbs.sentences.index');
        }
    }
}
