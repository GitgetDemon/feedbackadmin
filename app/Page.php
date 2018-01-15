<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
  protected $guarded = [];

  public function questions()
  {
    return $this->hasMany(Question::class);
  }

  public function questionnaire()
  {
    return $this->belongsTo(Questionnaire::class);
  }
}
