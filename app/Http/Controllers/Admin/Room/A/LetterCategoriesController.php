<?php

namespace App\Http\Controllers\Admin\Room\A;

use App\Http\Controllers\Controller;
use App\Models\LetterCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LetterCategoriesController extends Controller
{
    public function index()
    {
        $letterCats = LetterCategory::get();
        return view('letters.categories.index', compact('letterCats'));
    }

    public function create()
    {
        $letterCats = LetterCategory::get();
        return view('letters.categories.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);

        LetterCategory::create([
            'code' => Str::random(10),
            'name' => request('name'),
            'is_active' => 1,
        ]);

        return back();
    }

    public function edit($id)
    {
        return view('letters.categories.edit', [
            'letterCat' => LetterCategory::where('id', $id)->first(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $letterCat = LetterCategory::find($id);
        $letterCat->is_active = $request['is_active'];
        $letterCat->name = $request['name'];

        $letterCat->update();

        return redirect()->route('letters.categories.index');
    }
}
