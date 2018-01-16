<?php

namespace App\Http\Controllers;

use App\PublishedQuestionnaire;
use Illuminate\Http\Request;

class PublishedQuestionnairesController extends Controller
{
  public function show()
  {
    $publishedQuestionnaires = PublishedQuestionnaire::select('id','created_at')->orderBy('created_at','desc')->get();
    $newest = PublishedQuestionnaire::Newest()->first();
    return view('admin.pages.publishedQuestionnaires',compact('publishedQuestionnaires','newest'));
  }

  public function showChosen(Request $request)
  {
    $selectedPublishedQuestionnaire = PublishedQuestionnaire::where('id',$request->id)->first();
    return view('admin.pages.publishedQuestionnaire',compact('selectedPublishedQuestionnaire'));
  }
}
