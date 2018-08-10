@extends('layouts.header')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Update Post</h1>
      {!! Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST']) !!}
      <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
      </div>
      <div class="form-group">
        {{Form::label('body','BODY')}}
        {{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Enter your post here'])}}
      </div>
      {{Form::hidden('_method','PUT')}}
      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
      {!!Form::close()!!}
    </div>
  </div>
</div>
@endsection
