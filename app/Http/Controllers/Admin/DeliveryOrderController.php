<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeliveryOrderDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryOrderRequest;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderDetail;
use App\Models\Driver;
use App\Models\Product;
use App\Repositories\DeliveryOrderRepository;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    protected $model, $repository;

    public function __construct()
    {
        $this->model = new DeliveryOrder();
        $this->repository = new DeliveryOrderRepository();
    }

    protected $redirectAfterSave = 'delivery-order.index';
    protected $moduleName = 'DeliveryOrder';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DeliveryOrderDatatable $dataTable)
    {
        $drivers = Driver::select('drivers.id', 'drivers.full_name')->join('driver_vehicles','drivers.id', '=', 'driver_vehicles.driver_id')
                            ->join('vehicles', 'vehicles.id', 'driver_vehicles.vehicle_id')
                            ->where('vehicles.status', '!=', 'BOOKED')
                            ->get();
        return $dataTable->render('backend.delivery-order.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('backend.delivery-order.form', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryOrderRequest $request)
    {
        //    dd($request);
        $param = $request->all();
        $saveData = $this->repository->create($param);
        flashDataAfterSave($saveData, $this->moduleName);

        return redirect()->route($this->redirectAfterSave);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request)
    {
        //    dd($request);
        $param = $request->all();
        $saveData = $this->repository->assign($param);
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
        $details = DeliveryOrderDetail::where('delivery_order_id', $id)->get();
        $products = Product::get();
        return view('backend.delivery-order.edit-form', compact('data','details','products'));
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
