<?php
/**
 * Created by PhpStorm.
 * User: Frigy Zoli
 * Date: 2018. 01. 06.
 * Time: 12:57
 */

namespace App\Lib\Formatters;


class QuestionFormatter
{
  public function format($answer_type)
  {
    switch ($answer_type){
      case 'rating':
        return 'Értékelés';
        break;
      case 'shorttext':
        return 'Rövid szöveges válasz';
        break;
      case 'longtext':
        return 'Hosszú szöveges válasz';
        break;
      case 'numeric':
        return 'Numerikus válasz';
        break;
      case 'decide':
        return 'Igen/Nem válasz';
        break;
      default:
        return 'Értékelés';
    }
  }
}