<?php

namespace App\Http\Controllers;

use App\PublishedQuestionnaire;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function questionProcessor(Request $request)
    {
      $endOfQuestionnaire = false;
      $page_id = session('page_id');
      $numberOfPages = session('number_of_pages');

      /* ha nincs page_idje az azt jelenti hogy az első oldalon van */

      /* TODO: Amikor elmentjük már a válaszokat ,akkor azt is belekell venni az ellenörzésbe. bár a folyamat már magát hajtja előre, de ellenörizni kell hogy az adott lap kérdéssorra válaszolt-e már, minden lépésnél, ez azért szükséges hogy 2x ugyanazt a kérdéssort ne tudja kitölteni */
      if(!empty($page_id))
      {
        $user_id = session('id');
        $questionnaire_id = session('published_questionnaire_id');
        $page_id = 1;
        session(['page_id' => $page_id]);
      }
      else{
        $user_id = session('id');
        $questionnaire_id = session('published_questionnaire_id');
        $page_id++;
      }

      if($page_id == $numberOfPages)
      {
        $endOfQuestionnaire = true;
      }

      $questionnaire = PublishedQuestionnaire::where('id',$questionnaire_id)->first();

      /*kénytelen vagyok ilyen idióta modon megoldani, a count és az arrayek számozásának különbsége miatt*/
      $actualPage = $questionnaire->published_questionnaire[0]['pages'][($page_id-1)];

      $percent = floatval(round(($page_id/$numberOfPages)*100));

//      dd($page_id,$numberOfPages,$endOfQuestionnaire,$questionnaire,$actualPage);
      return view('frontend.questionnaire',compact('actualPage','numberOfPages','percent'));

    }
}
