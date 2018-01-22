<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $guarded = [];

  protected $casts = [
    'answers' => 'array',
  ];

  public function page()
  {
    return $this->belongsTo(RegisteredEmail::class);
  }
}
