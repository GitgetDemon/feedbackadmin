<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function questionProcessor(Request $request)
    {
      if(!isset($request->page_id))
      {
        $user_id = session('id');
        $questionnaire_id = session('published_questionnaire_id');
        $page_id = 1;
      }
      else{
        $user_id = session('id');
        $questionnaire_id = session('published_questionnaire_id');
        $page_id = $request->page_id;
      }

      dd($user_id,$questionnaire_id,$page_id);
    }
}
