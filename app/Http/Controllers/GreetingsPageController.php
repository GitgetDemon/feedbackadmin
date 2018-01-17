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

    $isInDb = RegisteredEmail::where('registered_email',$email)->first();
    if(empty($isInDb))
    {
      $questionnaire_id = PublishedQuestionnaire::newest()->first()->id;

      RegisteredEmail::create([
        'registered_email' => $email,
        'published_questionnaire_id' => $questionnaire_id
      ]);
      $getId = RegisteredEmail::where('registered_email',$email)->first()->id;
      session(['id' => $getId]);
      session(['published_questionnaire_id' => $questionnaire_id]);
    }
    else{
      session(['id' => $isInDb->id]);
      session(['questionnaire_id' => $isInDb->published_questionnaire_id]);
    }
    return view('frontend.greetings',compact('greetings'));
  }
}
