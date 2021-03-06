<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublishedQuestionnaire extends Model
{
  protected $guarded = [];

  protected $casts = [
    'published_questionnaire' => 'array',
  ];

    public function questionnaire()
  {
    return $this->belongsTo(Questionnaire::class);
  }

  public function scopeNewest($query){
    return $query->orderBy('created_at','desc')->limit(1);
  }

}
