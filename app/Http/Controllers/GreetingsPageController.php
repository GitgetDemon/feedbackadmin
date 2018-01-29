<?php

namespace App\Http\Controllers;

use App\Config;
use App\PublishedQuestionnaire;
use App\Rating;
use App\registeredSzallitolevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GreetingsPageController extends Controller
{
    //
  public function show(Request $request)
  {
    $vevokod = $request->a;
    $sorszam = str_replace('-','/',$request->b);

    $isValid = DB::table('revotica_rma.szallitolevelek')->where('vevokod',$vevokod)->where('sorszam',$sorszam)->first();
    // ha megtalálható a kombináció a szállítólevel között
    if($isValid)
    {
      $getInfo = Config::category('greetings')->first();
      $greetings = $getInfo->content;

      /* Az error arra szolgál hogyha első futtatás alkalmával nem található kérdőív akkor egy sablon szöveg megkéri őket hogy látogassanak vissza később */
      $error = false;

      $isInDb = registeredSzallitolevel::where('vevokod',$vevokod)->where('szallitolevel',$sorszam)->first();

      // ha megtalálható a kombináció a saját adatbázisban már
      if(empty($isInDb))
      {

        $questionnaire = PublishedQuestionnaire::newest()->first();
        if(!empty($questionnaire))
        {
        $numberOfPages = count($questionnaire->published_questionnaire[0]['pages']);

          registeredSzallitolevel::create([
          'vevokod' => $vevokod,
          'szallitolevel' => $sorszam,
          'published_questionnaire_id' => $questionnaire->id
        ]);
        $getId = registeredSzallitolevel::where('vevokod',$vevokod)->where('szallitolevel',$sorszam)->first()->id;
        session(['id' => $getId]);
        session(['published_questionnaire_id' => $questionnaire->id]);
        session(['number_of_pages' => $numberOfPages]);
        }
        else{
          $error = true;
        }
        return view('frontend.greetings', compact('greetings', 'error'));
      }
      else{
        $questionnaire = PublishedQuestionnaire::where('id',$isInDb->published_questionnaire_id)->first();

        $numberOfPages = count($questionnaire->published_questionnaire[0]['pages']);
        session(['id' => $isInDb->id]);
        session(['questionnaire_id' => $isInDb->published_questionnaire_id]);
        session(['number_of_pages' => $numberOfPages]);

        $userId = $isInDb->id;
        $result =  Rating::where('registered_szallitolevel_id',$userId)->first();

        return view('frontend.greetings', compact('greetings', 'error','result'));
      }
    }
    else {
      $error = true;
      return view('frontend.greetings', compact('greetings', 'error'));
    }
  }
}
