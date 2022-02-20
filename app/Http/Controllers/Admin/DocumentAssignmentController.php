<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DocumentAssignmentDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentAssignmentRequest;
use App\Models\DocumentAssignment;
use App\Repositories\DocumentAssignmentRepository;
use Illuminate\Http\Request;

class DocumentAssignmentController extends Controller
{
    protected $model, $repository;

    public function __construct()
    {
        $this->model = new DocumentAssignment();
        $this->repository = new DocumentAssignmentRepository();
    }

    protected $redirectAfterSave = 'documents.index';
    protected $moduleName = 'DocumentAssignment';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assignID = $request->route('id');
        $documents = DocumentAssignment::where('assignment_id', $assignID)->orderBy('id', 'ASC')->get()->toArray();
        // dd($documents);
        return view('backend.assignment.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('backend.document-assignment.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentAssignmentRequest $request)
    {
        //    dd($request);
        $param = $request->all();
        $saveData = $this->repository->update($param);
        flashDataAfterSave($saveData, $this->moduleName);

        return redirect()->route($this->redirectAfterSave, $param['assignment_id']);
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
        // if (isOnlyDataOwned()) {
        //     $data = $this->model
        //         ->where('created_by', '=', user_info('id'))
        //         ->where('id', '=', $id)
        //         ->firstOrFail();
        // } else {
        //     $data = $this->model->findOrFail($id);
        // }

        // return view('backend.document-assignment.form', compact('data'));
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
        // $param = $request->all();
        // $saveData = $this->repository->update($param, $id);
        // flashDataAfterSave($saveData, $this->moduleName);

        // return redirect()->route($this->redirectAfterSave);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->repository->delete($id);
    }
}
