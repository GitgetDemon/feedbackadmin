<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show()
    {
      $questions = Question::all();
      return view('admin.pages.questions',compact('questions'));
    }

    public function store(Request $request)
    {

      $validInput = $request->validate(
        ['newquestion'=>'required']
      );
      Question::create([
        'question' => $validInput['newquestion'],
        'answer_type' => $request->answertype
      ]);

      return back()->with('site-message-success', __('ui.successfullysave'));
    }

    public function showmodify(Request $request)
    {
      $questions = Question::all();

      if(!empty($request->question))
      {
        $selectedQuestion = Question::where('id','=',intval($request->question))->first();
      }
      return view('admin.pages.questionsmodify',compact('questions','selectedQuestion'));
    }

    public function modify(Request $request)
    {
      $validInput = $request->validate(
        ['selectedquestion'=>'required']
      );

      $question = Question::find($request->id);
      $question->question = $validInput['selectedquestion'];
      $question->save();
      return back()->with('site-message-success', __('ui.successfullysave'));
    }

    public function showDeletable()
    {
      $questions =  Question::whereNull('page_id')->whereNull('order')->get();
      return view('admin.pages.questionsdelete',compact('questions'));
    }

    public function delete(Request $request)
    {
      $validInput = $request->validate(
        ['question'=>'required']
      );
      Question::destroy($validInput['question']);
      return back()->with('site-message-success', __('ui.successfullysave'));
    }
}
