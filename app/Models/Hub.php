<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    protected $table = 'hubs';
    protected $guarded = ['id'];

    public function getHubs()
    {
        return static::select('id', 'name', 'address', 'category', 'area')
            ->get();
    }
}
