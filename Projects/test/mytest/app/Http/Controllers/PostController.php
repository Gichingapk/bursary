<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Response;
use Illuminate\Support\Facedes\input;
use App\http\Requests;

class PostController extends Controller
{
  public function index(){
    $post = Post::all();
    return view('post.index',compact('post'));
  }
  public function addPost(Request $req){
      // $rules = array(
      //   'company' => 'required',
      //   'location'=> 'required',
      //   'county'  => 'required',
      //   'date_close'=> 'required',
      // );
      // $validator = Validator::make (input::all(), $rules);
      // if($validator -> fails())
      // return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      //
      // else{
        $post = new post;
        $post ->company = $req->company;
        $post ->location = $req->location;
        $post ->county = $req->county;
        $post ->date_close = $req->date_close;
        $post ->save();
        return response()-> json($post);
    //  }
    }

    public function editPost(request $request){
      $post = Post::find($request->id);
      $post->company = $request->company;
      $post->location = $request->location;
      $post->county = $request->county;
      $post->save();
      return response()->json($post);
    }
    //
    // public function deletePost(request $request){
    //   $post = Post::find($request->id)->delete;
    //   return response()->json($post);
    // }
}
