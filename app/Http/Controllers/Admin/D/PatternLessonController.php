<?php

namespace App\Http\Controllers\Admin\D;

use App\DataTables\PatternLessonDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatternLessonRequest;
use App\Models\PatternLesson;
use App\Models\PatternChapter;
use App\Repositories\PatternLessonRepository;
use Illuminate\Http\Request;

class PatternLessonController extends Controller
{
    protected $model, $repository;
    public function __construct()
    {
        $this->model = new PatternLesson();
        $this->repository = new PatternLessonRepository();
    }

    protected $redirectAfterSave = 'pattern-lessons.index';
    protected $moduleName = 'Pattern Lesson';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PatternLessonDatatable $datatable)
    {
        return $datatable->render('backend.pattern.lessons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chapters = PatternChapter::where('is_active', 1)->get();
        return view('backend.pattern.lessons.form', compact('chapters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatternLessonRequest $request)
    {
        $param = $request->all();
        $saveData = $this->repository->create($param);
        flashDataAfterSave($saveData,$this->moduleName);

        return redirect()->route($this->redirectAfterSave);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(isOnlyDataOwned()){
            $data = $this->model
                ->where('created_by','=',user_info('id'))
                ->where('id','=',$id)
                ->firstOrFail();
        } else {
            $data = $this->model->findOrFail($id);
        }
        $chapters = PatternChapter::where('is_active', 1)->get();
        return view('backend.pattern.lessons.form',compact('data','chapters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $param = $request->all();
        $saveData = $this->repository->update($param,$id);
        flashDataAfterSave($saveData,$this->moduleName);

        return redirect()->route($this->redirectAfterSave);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $this->repository->delete($id);
    // }
}
