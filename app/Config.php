<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $guarded = array();
    //    // Cast json fields automatically.
    protected $casts = [
      'content' => 'array',
    ];

    public function scopeCategory($query,$category){
      return $query->where('category','=',$category)->orderBy('created_at','desc')->limit(1);
    }
}
