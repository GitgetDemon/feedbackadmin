<?php

namespace App\Http\Controllers;

use App\Page;
use App\PublishedQuestionnaire;
use App\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
  public function show()
  {
    $selectedQuestionnaire = Questionnaire::find(1);
    $unusedPage = Page::whereNull('questionnaire_id')->whereNull('order')->get();

    $selectedPages = $selectedQuestionnaire->pages()->orderBy('order', 'asc')->get();
    $maxPlaceInOrder = $selectedPages->count()==0 ? 1 : $selectedPages->count()+1;
    return view('admin.pages.modifyQuestionnaire',compact('selectedQuestionnaire','selectedPages','maxPlaceInOrder','unusedPage'));
  }

  public function modifyQuestionnaireAddPage(Request $request)
  {
    $validInput = $request->validate(
      ['page_id'=>'required']
    );
    $page = Page::find($validInput['page_id']);
    $page->questionnaire_id = $request->questionnaire_id;
    $page->order = $request->place_in_order;
    $page->save();

    $allPageForQuestionnaire = Page::where('questionnaire_id',$request->questionnaire_id)->orderBy('order','asc')->orderBy('updated_at','desc')->get();

    for($x = 0;$x < count($allPageForQuestionnaire);$x++)
    {
      $allPageForQuestionnaire[$x]->order= $x+1;
      $allPageForQuestionnaire[$x]->save();
    }

    return back()->with('site-message-success', __('ui.successfullysave'));
  }

  public function modifyQuestionnaireDeletePage(Request $request)
  {
    $selectedPage = Page::where('questionnaire_id',$request->questionnaire_id)->where('id',$request->page_id)->first();
    $selectedPage->questionnaire_id = null;
    $selectedPage->order = null;
    $selectedPage->save();

    $allPageForQuestionnaire = Page::where('questionnaire_id',$request->questionnaire_id)->orderBy('order','asc')->get();

    for($x = 0;$x < count($allPageForQuestionnaire);$x++)
    {
      $allPageForQuestionnaire[$x]->order= $x+1;
      $allPageForQuestionnaire[$x]->save();
    }
    return back()->with('site-message-success', __('ui.successfullysave'));
  }


  public function showEdited()
  {
    $questionnaire = Questionnaire::find(1);
    return view('admin.pages.publisher',compact('questionnaire'));
  }

  public function publish(Request $request)
  {
    $questionnaire = Questionnaire::find(1)->with([
      'pages' => function ($query) {$query->orderBy('order', 'asc');},
      'pages.questions' => function ($query) {$query->orderBy('order', 'asc');}
    ])->get();

    PublishedQuestionnaire::create([
      'questionnaire_id' => $questionnaire->first()->id,
      'published_questionnaire' => $questionnaire->toArray()
    ]);

    return back()->with('site-message-success', __('ui.successfullysave'));
  }
}
