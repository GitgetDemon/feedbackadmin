<?php

namespace App\Http\Controllers;

use App\Config;
use App\Rating;
use Illuminate\Http\Request;

class SalutationPageController extends Controller
{
    //
  public function showSalutation()
  {
    $user_id = session('id');
    $getInfo = Config::category('regards')->first();
    $regards = $getInfo->content;
    $result =  Rating::where('registered_szallitolevel_id',$user_id)->first();

    if(empty($user_id))
    {
      return redirect()->route('guest.greetingsShow');
    }

    if($result->result >= 4)
    {
      $getInfo = Config::category('googlelink')->first();
      $googlelink = $getInfo->content;
    }
    session()->flush();
    return view('frontend.salutation',compact('regards','googlelink','error'));
  }
}
