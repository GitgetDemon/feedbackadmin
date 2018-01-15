<?php

namespace App\Http\Controllers;

use App\Page;
use App\Question;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function show()
  {
    $pages = Page::all();
    return view('admin.pages.addpage',compact('pages'));
  }

  public function store(Request $request)
  {

    $validInput = $request->validate([
        'page_name'=>'required',
      ]
    );

    Page::create([
      'page_name' => $validInput['page_name'],
      'page_text' => $request->page_text,
    ]);

    return back()->with('site-message-success', __('ui.successfullysave'));
  }

  public function showmodify()
  {
    $pages = Page::all();

    return view('admin.pages.pagemodify',compact('pages'));
  }

  public function chosePageModify(Request $request)
  {
    $validInput = $request->validate([
        'page_id'=>'required',
      ]
    );
      /*Tudni kell az adott kérdőív lap saját adatait*/
      $selectedPage = Page::find($validInput['page_id']);
      /* Azért hogy kérdést tudjon hozzáadni , szükség van az összes kérdésre */
      $unusedQuestions = Question::whereNull('page_id')->whereNull('order')->get();

      /*Azért hogy a már meglévő kérdéseket megtudja nézni , le kell kérni azokat is
      */
      $selectedQuestions = $selectedPage->questions()->orderBy('order', 'asc')->get();
      $maxPlaceInOrder = $selectedQuestions->count()==0 ? 1 : $selectedQuestions->count()+1;

    return view('admin.pages.chosePageModify',compact('selectedPage','unusedQuestions','selectedQuestions','maxPlaceInOrder'));
  }

  public function chosePageModifyText(Request $request)
  {
    $validInput = $request->validate(
      ['page_name'=>'required']
    );

    $page = Page::find($request->id);
    $page->page_name = $validInput['page_name'];
    $page->page_text = $request->page_text;
    $page->save();
    return back()->with('site-message-success', __('ui.successfullysave'));
  }

 public function chosePageAddQuestion(Request $request)
 {
   $validInput = $request->validate(
     ['question_id'=>'required']
   );
   $question = Question::find($validInput['question_id']);
   $question->page_id = $request->page_id;
   $question->order = $request->place_in_order;
   $question->save();

   $allQuestionForPage = Question::where('page_id',$request->page_id)->orderBy('order','asc')->orderBy('updated_at','desc')->get();

   for($x = 0;$x < count($allQuestionForPage);$x++)
   {
     $allQuestionForPage[$x]->order= $x+1;
     $allQuestionForPage[$x]->save();
   }

   return back()->with('site-message-success', __('ui.successfullysave'));
 }

 public function chosePageDeleteQuestion(Request $request)
 {
   $selectedQuestion = Question::where('page_id',$request->page_id)->where('id',$request->question_id)->first();
   $selectedQuestion->page_id = null;
   $selectedQuestion->order = null;
   $selectedQuestion->save();

   $allQuestionForPage = Question::where('page_id',$request->page_id)->orderBy('order','asc')->get();

   for($x = 0;$x < count($allQuestionForPage);$x++)
   {
     $allQuestionForPage[$x]->order= $x+1;
     $allQuestionForPage[$x]->save();
   }
   return back()->with('site-message-success', __('ui.successfullysave'));
 }

  public function showDeletable()
  {
    $pages =  Page::whereNull('questionnaire_id')->whereNull('order')->get();
    return view('admin.pages.pagesdelete',compact('pages'));
  }

  public function delete(Request $request)
  {
    $validInput = $request->validate(
      ['page'=>'required']
    );
    $questions = Question::where('page_id',$validInput['page'])->get();

    foreach ($questions as $question)
    {
      $question->page_id = null;
      $question->order = null;
      $question->save();
    }
    Page::destroy($validInput['page']);
    return back()->with('site-message-success', __('ui.successfullysave'));
  }
}
