<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendMailController extends Controller
{
  $content = [
      'title'=> 'Itsolutionstuff.com mail',
      'body'=> 'The body of your message.',
      'button' => 'Click Here'
      ];


    $receiverAddress = 'your email';


    Mail::to($receiverAddress)->send(new OrderShipped($content));


    dd('mail send successfully');
  }
}
