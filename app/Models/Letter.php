<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $table = 'letters';
    protected $guarded = ['id'];

    public function LetterCategory() {
        return $this->belongsToMany('App\Models\LetterCategory','letters','letter_category_id');
    }
}
