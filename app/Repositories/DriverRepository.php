<?php

namespace App\Repositories;

use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DriverRepository
{
    public function create($data)
    {
        $ldate = date('Y-m-d H:i:s');

        $driver = new Driver();
        $driver->full_name = $data['full_name'];
        $driver->identity_number = $data['identity_number'];
        $driver->phone = $data['phone'];
        $driver->email = $data['email'];
        $driver->address = $data['address'];
        $driver->password = Hash::make($data['password']);
        $driver->is_active = $data['is_active'];
        $driver->created_at = $ldate;
        $driver->created_by = @user_info('username');

        $driver->save();

        return $driver;
    }

    public function update($data, $id)
    {
        $ldate = date('Y-m-d H:i:s');

        $driver = Driver::find($id);
        $driver->full_name = $data['full_name'];
        $driver->identity_number = $data['identity_number'];
        $driver->phone = $data['phone'];
        $driver->email = $data['email'];
        $driver->address = $data['address'];
        $driver->is_active = $data['is_active'];
        $driver->updated_at = $ldate;
        $driver->updated_by = @user_info('username');

        $driver->update();

        return $driver;
    }

    public function delete($id)
    {
        $driver = Driver::find($id);
        $driver->delete();

        return $driver;
    }
}
