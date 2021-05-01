<?php

namespace App\Http\Controllers\Admin\Room\B;

use App\Http\Controllers\Controller;
use App\Models\VerbChange;
use App\Models\MasterVerbLevel;
use App\Models\MasterVerbWord;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VerbChangeController extends Controller
{
    public function index()
    {
        $changes = VerbChange::get();
        $words = MasterVerbWord::where('is_active', 1)->get();
        return view('verb.changes.index', compact('changes', 'words'));
    }

    public function create()
    {
        // $levels = MasterVerbLevel::get();
        // return view('verb.groups.form-control', compact('levels'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "name" => 'required',
            "word_jpn" => 'required',
            "word_romanji" => 'required',
            "word_idn" => 'required',
            "master_verb_word_id" => 'required',
            "sentence_jpn_highlight" => 'required',
            "word_romanji_highlight" => 'required',
        ]);

        VerbChange::create([
            'code' => Str::random(20),
            'name' => request('name'),
            'word_jpn' => request('word_jpn'),
            'word_romanji' => request('word_romanji'),
            'word_idn' => request('word_idn'),
            'type_jpn' => request('type_jpn'),
            'type_idn' => request('type_idn'),
            'master_verb_word_id' => request('master_verb_word_id'),
            'word_romanji_highlight' => request('word_romanji_highlight'),
            'sentence_jpn_highlight' => request('sentence_jpn_highlight'),
            'is_active' =>  request('is_active'),
        ]);

        return back();
    }

    public function edit($id)
    {
        // dd(Letter::where('id', $id)->first());
        return view('verb.changes.edit', [
            'change' => VerbChange::where('id', $id)->first(),
            'words' => MasterVerbWord::where('is_active', 1)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => 'required',
            "word_jpn" => 'required',
            "word_romanji" => 'required',
            "word_idn" => 'required',
            "master_verb_word_id" => 'required',
            "is_active" => 'required',
            "sentence_jpn_highlight" => 'required',
            "word_romanji_highlight" => 'required',
        ]);

        $change = VerbChange::find($id);
        $change->name = request('name');
        $change->word_jpn = request('word_jpn');
        $change->word_romanji = request('word_romanji');
        $change->word_idn = request('word_idn');
        $change->type_jpn = request('type_jpn');
        $change->type_idn = request('type_idn');
        $change->master_verb_word_id = request('master_verb_word_id');
        $change->sentence_jpn_highlight = request('sentence_jpn_highlight');
        $change->word_romanji_highlight = request('word_romanji_highlight');
        $change->is_active = request('is_active');

        $change->update();

        return redirect()->route('verbs.changes.index');
    }
}
