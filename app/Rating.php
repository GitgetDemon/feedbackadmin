<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
  protected $guarded = [];

  protected $casts = [
    'result' => 'array',
  ];

  public function registered()
  {
    return $this->belongsTo(registeredSzallitolevel::class);
  }
}
