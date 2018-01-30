<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
     public function show()
    {
       $greetings = !empty(Config::category('greetings')->first()->content)?Config::category('greetings')->first()->content:'';
       $regards = !empty(Config::category('regards')->first()->content)?Config::category('regards')->first()->content:'';
       $mail = !empty(Config::category('mail')->first()->content)?Config::category('mail')->first()->content:'';
       $googlelink = !empty(Config::category('googlelink')->first()->content)?Config::category('googlelink')->first()->content:'';

       return view('admin.pages.config',compact('greetings','regards','mail','googlelink'));
    }

    public function StoreGreetings(Request $request)
    {
      if (empty($request->greetings))
      {
        $request->greetings = '';
      }
      Config::create([
        'category'=>'greetings',
        'content'=> $request->greetings,
      ]);
      return back()->with('site-message-success', 'Sikeres mentés!');
    }

    public function StoreRegards(Request $request)
    {
      if (empty($request->regards))
      {
        $request->regards = '';
      }
      Config::create([
        'category'=>'regards',
        'content'=> $request->regards,
      ]);
      return back()->with('site-message-success', 'Sikeres mentés!');
    }

    public function StoreMail(Request $request)
    {

      $validInput = $request->validate(
      ['mail'=>'required|email']
      );
      Config::create([
        'category'=>'mail',
        'content'=> $validInput['mail'],
      ]);
      return back()->with('site-message-success', 'Sikeres mentés!');
    }

    public function StoreGooglelink(Request $request)
    {
      $validInput = $request->validate(
        ['googlelink'=>'required']
      );
      Config::create([
        'category'=>'googlelink',
        'content'=> $validInput['googlelink'],
      ]);
      return back()->with('site-message-success', 'Sikeres mentés!');
    }
}
