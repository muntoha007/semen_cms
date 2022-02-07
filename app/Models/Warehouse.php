<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    protected $guarded = ['id'];

    public function getWarehouses()
    {
        return static::select('id', 'name', 'address', 'phone', 'regency_id', 'province_id', 'longitude', 'latitude', 'is_active')
            ->get();
    }
}
