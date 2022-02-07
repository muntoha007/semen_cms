<?php

namespace App\Repositories;

use App\Models\DriverVehicle;
use App\Models\DriverVehicles;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VehicleRepository
{
    public function create($data)
    {
        $ldate = date('Y-m-d H:i:s');

        $vehicle = new Vehicle();
        $vehicle->brand = $data['brand'];
        $vehicle->production_year = $data['production_year'];
        $vehicle->plate_number = $data['plate_number'];
        $vehicle->date_plate = $data['date_plate'];
        $vehicle->date_kir = $data['date_kir'];
        $vehicle->capacity = $data['capacity'];
        $vehicle->type = $data['type'];
        $vehicle->status = $data['status'];
        $vehicle->is_active = $data['is_active'];
        $vehicle->created_at = $ldate;
        $vehicle->created_by = @user_info('username');

        $vehicle->save();

        return $vehicle;
    }

    public function update($data, $id)
    {
        $ldate = date('Y-m-d H:i:s');

        $vehicle = Vehicle::find($id);
        $vehicle->brand = $data['brand'];
        $vehicle->production_year = $data['production_year'];
        $vehicle->plate_number = $data['plate_number'];
        $vehicle->date_plate = $data['date_plate'];
        $vehicle->date_kir = $data['date_kir'];
        $vehicle->capacity = $data['capacity'];
        $vehicle->type = $data['type'];
        $vehicle->status = $data['status'];
        $vehicle->is_active = $data['is_active'];
        $vehicle->updated_at = $ldate;
        $vehicle->updated_by = @user_info('username');

        $vehicle->update();

        return $vehicle;
    }

    public function delete($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();

        return $vehicle;
    }

    public function createAssigmentVehicle($data)
    {
        $ldate = date('Y-m-d H:i:s');

        $vehicle = new DriverVehicle();
        $vehicle->driver_id = $data['driver_id'];
        $vehicle->vehicle_id = $data['vehicle_id'];
        $vehicle->notes = $data['notes'];
        $vehicle->handover_date = $ldate;
        $vehicle->created_by = @user_info('username');
        $vehicle->save();

        return $vehicle;
    }

    public function removeAssignment($id)
    {
        $vehicle = DriverVehicle::where('vehicle_id',$id);
        $vehicle->delete();

        return $vehicle;
    }
}
