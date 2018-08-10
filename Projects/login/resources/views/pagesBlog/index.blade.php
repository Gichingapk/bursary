@extends('layouts.header')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          Dashboard
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="panel-body">
          <a href="/posts/create" class="btn btn-primary float-right">Create Post</a>
          <h3>Your blog posts</h3>
        </div>
        <table class="table table-striped">
          <tr>
            <th>Title</th>
          </tr>
          @foreach($posts as $post)
              <tr>
                <td>{{$post->title}}</td>
                <td> <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a> </td>
                <td></td>
              </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection
