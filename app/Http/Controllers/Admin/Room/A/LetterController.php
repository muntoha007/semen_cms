<?php

namespace App\Http\Controllers\Admin\Room\A;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\LetterCategory;
use Illuminate\Http\Request;
use App\Repositories\LetterRepository;

class LetterController extends Controller
{
    public function __construct()
    {
        $this->model = new Letter;
        $this->repository = new LetterRepository;
    }

    public function index()
    {
        $letters = Letter::get();
        return view('letters.letters.index', compact('letters'));
    }

    public function create()
    {
        $letterCats = LetterCategory::get();
        return view('letters.letters.create', compact('letterCats'));
    }

    public function store(Request $request)
    {
        $param = $request->all();
        // dd($param);
        $saveData = $this->repository->createNew($param);

     	if (!empty($saveData)) {
            $request->session()->flash('success', 'Data Letter berhasil di masukan!');
            return redirect()->route('letters.letters.index');
        } else {
            $request->session()->flash('error', 'Gagal menyimpan data Letter!');
            return redirect()->route('letters.letters.index');
        }

    }

    public function edit($id)
    {
        // dd(Letter::where('id', $id)->first());
        return view('letters.letters.edit', [
            'letter' => Letter::where('id', $id)->first(),
            'letterCats' => LetterCategory::get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "letter" => 'required',
            "romanji" => 'required',
            "category" => 'required',
        ]);

        $param = $request->all();

        $updateData = $this->repository->updateLetter($param, $id);

     	if (!empty($updateData)) {
            $request->session()->flash('success', 'Data Letter berhasil di update!');
            return redirect()->route('letters.letters.index');
        } else {
            $request->session()->flash('error', 'Gagal update data!');
            return redirect()->route('letters.letters.index');
        }
    }
}
