<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $guarded = [];

  public function page()
  {
    return $this->belongsTo(RegisteredEmail::class);
  }
}
