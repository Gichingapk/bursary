<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class BursaryController extends Controller
{
    public function index(){
      return view('forms');
    }
}
