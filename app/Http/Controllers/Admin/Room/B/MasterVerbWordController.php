<?php

namespace App\Http\Controllers\Admin\Room\B;

use App\Http\Controllers\Controller;
use App\Models\MasterVerbWord;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MasterVerbWordController extends Controller
{
    public function index()
    {
        $words = MasterVerbWord::get();
        return view('verb.words.index', compact('words'));
    }

    public function create()
    {
        // $levels = MasterVerbLevel::get();
        // return view('verb.words.form-control', compact('levels'));
    }

    public function store(Request $request)
    {

        request()->validate([
            "name" => 'required',
            "word_japan" => 'required',
            "word_romanji" => 'required',
            "word_idn" => 'required',
        ]);

        MasterVerbWord::create([
            'code' => Str::random(20),
            'name' => request('name'),
            'word_japan' => request('word_japan'),
            'word_romanji' => request('word_romanji'),
            'word_idn' => request('word_idn'),
            'is_active' => 1,
        ]);

        return redirect()->route('verbs.words.index');
    }

    public function edit($id)
    {
        // dd(Letter::where('id', $id)->first());
        return view('verb.words.edit', [
            'word' => MasterVerbWord::where('id', $id)->first(),
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
        $word->is_active = request('is_active');

        $word->update();

        return redirect()->route('verbs.words.index');
    }
}
