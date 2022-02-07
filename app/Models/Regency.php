<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    protected $table = 'region_regencies';
    protected $guarded = ['id'];

    public function getRegencies()
    {
        return static::select('id', 'name', 'longitude', 'latitude')
            ->get();
    }
}
