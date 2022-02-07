<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VehicleDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    protected $model, $repository;

    public function __construct()
    {
        $this->model = new Vehicle();
        $this->repository = new VehicleRepository();
    }

    protected $redirectAfterSave = 'vehicle.index';
    protected $moduleName = 'Vehicle/Kendaraan';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VehicleDatatable $dataTable)
    {
        $drivers = Driver::select('drivers.id', 'drivers.full_name')->leftJoin('driver_vehicles','drivers.id', '=', 'driver_vehicles.driver_id')
        ->whereNull('driver_vehicles.driver_id')
        ->get();
// dd($drivers);
        return $dataTable->render('backend.vehicle.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drivers = Driver::leftJoin('driver_vehicles','drivers.id', '=', 'driver_vehicles.driver_id')
                            ->whereNull('driver_vehicles.driver_id')
                            ->get();
        return view('backend.vehicle.form', compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRequest $request)
    {
        //    dd($request);
        $param = $request->all();
        $saveData = $this->repository->create($param);
        flashDataAfterSave($saveData, $this->moduleName);

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
        if (isOnlyDataOwned()) {
            $data = $this->model
                ->where('created_by', '=', user_info('id'))
                ->where('id', '=', $id)
                ->firstOrFail();
        } else {
            $data = $this->model->findOrFail($id);
        }

        return view('backend.vehicle.form', compact('data'));
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
        $saveData = $this->repository->update($param, $id);
        flashDataAfterSave($saveData, $this->moduleName);

        return redirect()->route($this->redirectAfterSave);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
    }
}
