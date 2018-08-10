@extends('layouts.header')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="/posts" class="btn btn-default">Go Back</a>
      <h1>{{$post->title}}</h1>
      <small>Written on {{$post->created_at}}</small>
      <hr>
      <div class="well">
        {!!$post->body!!}
      </div>
      <hr>
      <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
          {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
          {!!Form::close()!!}
    </div>
  </div>
</div>
@endsection
