<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterCategory extends Model
{

    protected $table = 'letter_categories';
    protected $guarded = ['id'];

    // public function LetterCategory() {
    //     return $this->belongsToMany('App\Models\LetterCategory','letters','letter_category_id');
    // }
}
