<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    //
  protected $guarded = [];

  public function pages()
  {
    return $this->hasMany(Page::class);
  }

  public function publishedQuestionnaires()
  {
    return $this->hasMany(PublishedQuestionnaire::class);
  }
}
