<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'region_provinces';
    protected $guarded = ['id'];

    public function getProvinces()
    {
        return static::select('id', 'name', 'longitude', 'latitude')
            ->get();
    }
}
