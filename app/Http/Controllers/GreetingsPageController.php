<?php

namespace App\Http\Controllers;

use App\Config;
use App\PublishedQuestionnaire;
use App\RegisteredEmail;
use Illuminate\Http\Request;

class GreetingsPageController extends Controller
{
    //
  public function show()
  {
    $email = 'english-2@live.com';
    $getInfo = Config::category('greetings')->first();
    $greetings = $getInfo->content;

    /* Az error arra szolgál hogyha első futtatás alkalmával nem található kérdőív akkor egy sablon szöveg megkéri őket hogy látogassanak vissza később */
    $error = false;

    $isInDb = RegisteredEmail::where('registered_email',$email)->first();
    if(empty($isInDb))
    {
      $questionnaire = PublishedQuestionnaire::newest()->first();
      if(!empty($questionnaire))
      {
      $numberOfPages = count($questionnaire->published_questionnaire[0]['pages']);

      RegisteredEmail::create([
        'registered_email' => $email,
        'published_questionnaire_id' => $questionnaire->id
      ]);
      $getId = RegisteredEmail::where('registered_email',$email)->first()->id;
      session(['id' => $getId]);
      session(['published_questionnaire_id' => $questionnaire->id]);
      session(['number_of_pages' => $numberOfPages]);
      }
      else{
        $error = true;
      }
    }
    else{
      $questionnaire = PublishedQuestionnaire::where('id',$isInDb->published_questionnaire_id)->first();

      $numberOfPages = count($questionnaire->published_questionnaire[0]['pages']);
      session(['id' => $isInDb->id]);
      session(['questionnaire_id' => $isInDb->published_questionnaire_id]);
      session(['number_of_pages' => $numberOfPages]);
    }

    return view('frontend.greetings',compact('greetings','error'));
  }
}
