<?php

namespace App\Http\Controllers\Admin\Room\D;

use App\Http\Controllers\Controller;
use App\Models\PatternChapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatternChapterController extends Controller
{
    public function index()
    {
        $chapters = PatternChapter::get();
        return view('pattern.chapters.index', compact('chapters'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        request()->validate([
            "name" => 'required',
        ]);

        PatternChapter::create([
            'code' => Str::random(20),
            'name' => request('name'),
            'is_active' => request('is_active'),
        ]);

        return back();
    }

    public function edit($id)
    {
        return view('pattern.chapters.edit', [
            'chapter' => PatternChapter::where('id', $id)->first(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => 'required',
        ]);

        $chapter = PatternChapter::find($id);
        $chapter->name = request('name');
        $chapter->is_active = request('is_active');

        $chapter->update();

        return redirect()->route('patterns.chapters.index');
    }
}
