<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registeredSzallitolevel extends Model
{
  protected $guarded = [];

  public function questions()
  {
    return $this->hasOne(Answer::class);
  }

  public function result()
  {
    return $this->hasOne(Rating::class);
  }
}
