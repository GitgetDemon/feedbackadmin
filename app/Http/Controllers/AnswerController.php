<?php

namespace App\Http\Controllers;

use App\Answer;
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
      }
      else{
        $user_id = session('id');
        $questionnaire_id = session('published_questionnaire_id');
        $page_id++;
      }
      session(['page_id' => $page_id]);
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

    public function answerProcessor(Request $request)
    {
      /* validálás */




      /* le kell kérni a kérdőív megfelelő lapját és a kérdésekhez a válaszokat párosítani , majd ezek után az egészet elmenteni*/
      $page_id = session('page_id');
      $questionnaire_id = session('published_questionnaire_id');
      $questionnaire = PublishedQuestionnaire::where('id',$questionnaire_id)->first();
      $actualQuestions = $questionnaire->published_questionnaire[0]['pages'][($page_id-1)]['questions'];
      $answer = array();
      foreach ($actualQuestions as $key => $actualQuestion) {
        $id = $actualQuestion['id'];
        $answer[$page_id][$key] = array([
          'id' => $actualQuestion['id'],
          'question' => $actualQuestion['question'],
          'order' => $actualQuestion['order'],
          'page_id' => $actualQuestion['page_id'],
          'answer_type' => $actualQuestion['answer_type'],
          'answer' => $request->$id,
        ]);
      }
      $user_id = session('id');
      $user_old_answer = Answer::where('registered_email_id',$user_id)->first();
      if(empty($user_old_answer))
      {
        Answer::create([
          'registered_email_id' => $user_id,
          'answers' => $answer,
        ]);
      }
      else{
        $answersOfUser = $user_old_answer['answers'];
        $answersOfUser = array_merge($answersOfUser,$answer);
        dd($answersOfUser);
      }


//      $isAnswerValid = array();
//
//      dd($request->attributes);
//      {
//        switch ($actualQuestion['answer_type']){
//          case 'rating':
//            $isAnswerValid[$actualQuestion['id']] = 'required';
//            break;
//          case 'shorttext':
//            $isAnswerValid[$actualQuestion['id']] = 'required';
//            break;
//          case 'longtext':
//            $isAnswerValid[$actualQuestion['id']] = 'required';
//            break;
//          case 'numeric':
//            $isAnswerValid[$actualQuestion['id']] = 'required|integer';
//            break;
//          case 'decide':
//            $isAnswerValid[$actualQuestion['id']] = 'required';
//            break;
//          default:
//            $isAnswerValid[$actualQuestion['id']] = 'required';
//        }
        /* lehet könnyebb lenne hogyha a kérdés létrehozásakor a mező tipusához tartozó validációt már beleírnánk, így itt helyben az is csak egy változó lenne amit a hozzátartozó kérdéshez csatolni lehet
        de viszonylag egyszerű még az ellenörzés ezért helyben tesszem meg */
//      $validInput = $request->validate([$isAnswerValid]);
//      dd($validInput);

    }
}
