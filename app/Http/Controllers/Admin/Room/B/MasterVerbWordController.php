<?php

namespace App\Http\Controllers\Admin\Room\B;

use App\Http\Controllers\Controller;
use App\Models\MasterVerbGroup;
use App\Models\MasterVerbLevel;
use App\Models\MasterVerbWord;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasterVerbWordController extends Controller
{
    public function index()
    {
        $words = MasterVerbWord::get();
        $levels = MasterVerbLevel::get();
        $groups = MasterVerbGroup::get();
        return view('verb.words.index', compact('words', 'levels', 'groups'));
    }

    public function create()
    {
        // $levels = MasterVerbLevel::get();
        // return view('verb.words.form-control', compact('levels'));
    }

    public function store(Request $request)
    {

        dd($request);
        request()->validate([
            "name" => 'required',
            "word_japan" => 'required',
            "word_romanji" => 'required',
            "word_idn" => 'required',
            "master_verb_level_id" => 'required',
            "master_verb_group_id" => 'required',
        ]);

        MasterVerbWord::create([
            'code' => Str::random(20),
            'name' => request('name'),
            'word_japan' => request('word_japan'),
            'word_romanji' => request('word_romanji'),
            'word_idn' => request('word_idn'),
            'master_verb_level_id' => request('master_verb_level_id'),
            'master_verb_group_id' => request('master_verb_group_id'),
            'is_active' => request('is_active'),
        ]);

        return redirect()->route('verbs.words.index');
    }

    public function edit($id)
    {
        return view('verb.words.edit', [
            'word' => MasterVerbWord::where('id', $id)->first(),
            'levels' => MasterVerbLevel::get(),
            'groups' => MasterVerbGroup::get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => 'required',
            "word_japan" => 'required',
            "word_romanji" => 'required',
            "word_idn" => 'required',
            "is_active" => 'required',
        ]);

        $word = MasterVerbWord::find($id);
        $word->name = request('name');
        $word->word_japan = request('word_japan');
        $word->word_romanji = request('word_romanji');
        $word->word_idn = request('word_idn');
        $word->master_verb_level_id = request('master_verb_level_id');
        $word->master_verb_group_id = request('master_verb_group_id');
        $word->is_active = request('is_active');

        $word->update();

        return redirect()->route('verbs.words.index');
    }
}
