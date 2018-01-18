<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredEmail extends Model
{
  protected $guarded = [];

  public function questions()
  {
    return $this->hasOne(Answer::class);
  }
}
