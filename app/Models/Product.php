<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = ['id'];

    public function getProducts()
    {
        return static::select('id', 'name', 'category', 'description')
            ->get();
    }
}
