<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class ContactMessageController extends Controller
{

    public function index(){
      return view('progressbar.index');
    }

    // public function create(){
    //   return view('bursary.contact');
    // }

    // public function store(Request $request){
    //   // $this->validate($request,[
    //   //   'name'  => 'required',
    //   //   'email' => 'required|email',
    //   //   'subject'=>'min:3',
    //   //   'message'=>'min:10'
    //   // ]);
    //   //
    //   $data = array(
    //   'name' => $request->name,
    //   'email' =>$request->email,
    //   'subject'=>$request->subject,
    //   'bodyMessage'=>$request->message
    //   );
    //
    //   Mail::send('email',$data, function($message) use($data){
    //     $message -> from($data['email']);
    //     $message ->to('patrickgichinga2@gmail.com');
    //     $message ->subject($data['subject']);
    //   });
    // }
}
