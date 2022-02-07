<?php

namespace App\Repositories;

use App\Models\Hub;
use Illuminate\Support\Str;

class HubRepository
{
    public function create($data)
    {
        $ldate = date('Y-m-d H:i:s');

        $hub = new Hub();
        $hub->name = $data['name'];
        $hub->address = $data['address'];
        $hub->area = $data['area'];
        $hub->category = $data['category'];
        $hub->is_active = $data['is_active'];
        $hub->longitude = $data['longitude'];
        $hub->latitude = $data['latitude'];
        $hub->created_at = $ldate;
        $hub->created_by = @user_info('username');

        $hub->save();

        return $hub;
    }

    public function update($data, $id)
    {
        $ldate = date('Y-m-d H:i:s');

        $hub = Hub::find($id);
        $hub->name = $data['name'];
        $hub->address = $data['address'];
        $hub->area = $data['area'];
        $hub->category = $data['category'];
        $hub->is_active = $data['is_active'];
        $hub->longitude = $data['longitude'];
        $hub->latitude = $data['latitude'];
        $hub->updated_at = $ldate;
        $hub->updated_by = @user_info('username');

        $hub->update();

        return $hub;
    }

    public function delete($id)
    {
        $hub = Hub::find($id);
        $hub->delete();

        return $hub;
    }
}
