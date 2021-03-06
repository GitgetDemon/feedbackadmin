<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Config;
use App\Notifications\feedbackMail;
use App\PublishedQuestionnaire;
use App\Rating;
use App\registeredSzallitolevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AnswerController extends Controller
{
    public function questionProcessor(Request $request)
    {
      $user_id = session('id');
      if(empty($user_id))
      {
        return redirect()->route('guest.greetingsShow');
      }
      $result =  Rating::where('registered_szallitolevel_id',$user_id)->first();
      if(!empty($result->result))
      {
        return redirect()->route('guest.greetingsShow');
      }
      $page_id = session('page_id');
      $numberOfPages = session('number_of_pages');

      /* ha nincs page_idje az azt jelenti hogy az első oldalon van */

      /* TODO: Amikor elmentjük már a válaszokat ,akkor azt is belekell venni az ellenörzésbe. bár a folyamat már magát hajtja előre, de ellenörizni kell hogy az adott lap kérdéssorra válaszolt-e már, minden lépésnél, ez azért szükséges hogy 2x ugyanazt a kérdéssort ne tudja kitölteni */
      if(empty($page_id))
      {
        $questionnaire_id = session('published_questionnaire_id');
        $page_id = 1;
        session(['page_id' => $page_id]);
      }
      else{
        $questionnaire_id = session('published_questionnaire_id');
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
      $endOfQuestionnaire = false;
      $numberOfPages = session('number_of_pages');
      $page_id = session('page_id');
      $questionnaire_id = session('published_questionnaire_id');


      $questionnaire = PublishedQuestionnaire::where('id',$questionnaire_id)->first();
      $actualQuestions = $questionnaire->published_questionnaire[0]['pages'][($page_id-1)]['questions'];


      /* validálás */
      $validationRules = array();
      foreach ($actualQuestions as $key => $actualQuestion) {
        $validationRules['id-' . $actualQuestion['id']] = $this->rulesForQuestionType($actualQuestion['answer_type']);
      }
      $validInputs = $request->validate(
        $validationRules
      );

      if($page_id == $numberOfPages)
      {
        $endOfQuestionnaire = true;
      }

      $answer = array();
      foreach ($validInputs as $key => $validInput) {
        $id = substr($key,3);
        $rightAnswer = $this->searchForQuestion($actualQuestions,$id);
        $answer[$page_id][$id] = ([
          'id' => $id,
          'question' => $rightAnswer['question'],
          'order' => $rightAnswer['order'],
          'page_id' => $rightAnswer['page_id'],
          'answer_type' => $rightAnswer['answer_type'],
          'answer' => $validInput,
        ]);
      }

      $user_id = session('id');
      $user_old_answer = Answer::where('registered_szallitolevel_id',$user_id)->first();
      if(empty($user_old_answer))
      {
        Answer::create([
          'registered_szallitolevel_id' => $user_id,
          'answers' => $answer,
        ]);
      }
      else{
        $answersOfUser = $user_old_answer['answers'];
        $answersOfUser = array_merge($answersOfUser,$answer);
        $user_old_answer->answers = $answersOfUser;
        $user_old_answer->save();
      }

      if($endOfQuestionnaire)
      {
        $userAnswers = Answer::where('registered_szallitolevel_id',$user_id)->first();
        $pagesOfAnswers = $userAnswers->answers;
        $sum = 0;
        $numberOfRatingType = 0;
        foreach ($pagesOfAnswers as $pageOfAnswer)
        {
          foreach ($pageOfAnswer as $oneAnswer){
            if ($oneAnswer['answer_type'] == 'rating'){
              $sum = $sum + intval($oneAnswer['answer']);
              $numberOfRatingType = $numberOfRatingType + 1;
            }
          }
        }
        $rating = ($sum/$numberOfRatingType);
        Rating::create([
          'registered_szallitolevel_id' => $user_id,
          'result' => $rating,
        ]);

        $email = !empty(Config::category('mail')->first()->content)?Config::category('mail')->first()->content:'';

        $answers = $userAnswers->answers;
        $result = $rating;
        $szallitolevelszam = registeredSzallitolevel::where('id',$user_id)->first();
        Notification::route('mail', $email)
          ->notify(new feedbackMail($answers,$result,$szallitolevelszam));

        return redirect(route('guest.salutation'));
      }
      else{
        $page_id = $page_id + 1;
        session(['page_id' => $page_id]);
        return back();
      }

        /* lehet könnyebb lenne hogyha a kérdés létrehozásakor a mező tipusához tartozó validációt már beleírnánk, így itt helyben az is csak egy változó lenne amit a hozzátartozó kérdéshez csatolni lehet
        de viszonylag egyszerű még az ellenörzés ezért helyben tesszem meg */


    }

    protected function searchForQuestion($questions,$question_id){
      foreach ($questions as $question)
      {
        if($question['id'] == $question_id)
        {
          return $question;
        }
      }
      return array();
    }

    protected function rulesForQuestionType($type){
      switch ($type){
        case 'rating':
          return 'required';
        case 'shorttext':
          return 'required';
        case 'longtext':
          return 'required';
        case 'numeric':
          return 'required|integer';
        case 'decide':
          return 'required';
        default:
          return 'required';
      }
    }
}
