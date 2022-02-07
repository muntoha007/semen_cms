<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $guarded = ['id'];

    public function getDrivers()
    {
        return static::select('id', 'identity_number', 'full_name', 'address', 'phone', 'email', 'is_active')
            ->get();
    }
}
