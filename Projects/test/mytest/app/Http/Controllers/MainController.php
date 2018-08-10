<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use auth;

class MainController extends Controller
{
    //
    function index(){
      return view('login');
    }

    function checklogin(Request $request){
      $this-> Validate($request,[
          'email'   => 'required|email',
          'password'=> 'required|alphanum|min:6'
        ]);

        $user_data= array(
          'email' => $request -> get('email'),
          'password'=> $request -> get('password')
        );

        if(Auth::attempt($user_data))
        {
          return redirect('main/successlogin');
        }
        return back()->with('error','Wrong details. Try again');
       }


        function successlogin(){
            return view('successlogin');
          }


        function logout(){
          Auth::logout();
        return redirect('main');
      }
}
