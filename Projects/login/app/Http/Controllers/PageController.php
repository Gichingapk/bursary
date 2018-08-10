<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
      $title = 'Welcome to My Blog';
      return view('pages.index')-> with('title',$title);
    }
    public function homepage(){
      $title = 'Welcome Home';
      return view('pages.homepage')-> with('title',$title);
    }
    public function institution(){
        $title = 'Grab One Form For You';
      return view('pages.institution')-> with('title',$title);
    }

    public function services(){
        $data= array(
          'title' => 'SERVICES',
          'services'=> ['Upload forms','Instant notification','Update status']
        );
        return view('pages.services')-> with($data);
    }
}
