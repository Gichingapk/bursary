<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{asset('css/app.css')}}"></link>
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}"></link>

        <script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}" ></script>
        <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>
        <title>{{ config('app.name','Blog')}}</title>
    </head>
    <body>
      @include('includes.navbar')
      <div class="container">
        <div class="row">
          @include('includes.message')
          @yield('content')
        </div>
      </div>
      <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    </body>
</html>
