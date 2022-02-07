<?php

namespace App\Repositories;

use App\Models\Warehouse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WarehouseRepository
{
    public function create($data)
    {
        $ldate = date('Y-m-d H:i:s');

        $warehouse = new Warehouse();
        $warehouse->name = $data['name'];
        $warehouse->phone = $data['phone'];
        $warehouse->address = $data['address'];
        $warehouse->latitude = $data['latitude'];
        $warehouse->longitude = $data['longitude'];
        $warehouse->province_id = $data['province_id'];
        $warehouse->regency_id = $data['regency_id'];
        $warehouse->is_active = $data['is_active'];
        $warehouse->created_at = $ldate;
        $warehouse->created_by = @user_info('username');

        $warehouse->save();

        return $warehouse;
    }

    public function update($data, $id)
    {
        $ldate = date('Y-m-d H:i:s');

        $warehouse = Warehouse::find($id);
        $warehouse->name = $data['name'];
        $warehouse->phone = $data['phone'];
        $warehouse->address = $data['address'];
        $warehouse->latitude = $data['latitude'];
        $warehouse->longitude = $data['longitude'];
        $warehouse->province_id = $data['province_id'];
        $warehouse->regency_id = $data['regency_id'];
        $warehouse->is_active = $data['is_active'];
        $warehouse->updated_at = $ldate;
        $warehouse->updated_by = @user_info('username');

        $warehouse->update();

        return $warehouse;
    }

    public function delete($id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->delete();

        return $warehouse;
    }
}
