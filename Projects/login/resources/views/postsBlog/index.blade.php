@extends('layouts.header')

@section('content')
    <div class="container">

        <h2>POSTS</h2>
        @if(count($posts) > 0)
          @foreach($posts as $post)
            <div class="well">
              <h4> <a href="/posts/{{$post->id}}">{{$post->title}}</a> </h4>
              <small>Written on {{$post->created_at}}</small>
            </div>
          @endforeach
          {{$posts->links()}} {{--<!--pagenation // to add more post display , go to pagenate(0) and increase the values-->--}}
          @else
            <p>No posts found</p>
        @endif
    </div>
@endsection
