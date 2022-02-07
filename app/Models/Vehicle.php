<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $guarded = ['id'];

    public function getVehicles()
    {
        return static::select('id', 'brand', 'production_year', 'plate_number', 'date_plate', 'date_kir', 'capacity', 'type', 'status', 'is_active')
            ->get();
    }
}
