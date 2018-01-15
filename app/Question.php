<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
  protected $guarded = [];

  public function page()
  {
    return $this->belongsTo(Page::class);
  }
}
