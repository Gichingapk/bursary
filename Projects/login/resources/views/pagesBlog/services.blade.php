@extends('layouts.header')

@section('content')
    <div class="container">
      <div class="col-md-12">
        <h1>{{$title}}</h1>
         <div class="list-item">
           @if(count($services)> 0)
                <ul>
                      @foreach ($services as $service)
                      <li>{{ $service }}</li>
                      @endforeach
                </ul>
            @endif
         </div>
      </div>
    </div>
@endsection
