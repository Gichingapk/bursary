<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bursary Application</title>



    <!-- Scripts -->
  <script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}" ></script>
  <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{route('post.index')}}">Bursary Application</a>
        </div>
      </div>
    </nav>
    <div class="container">
      @yield('content')
    </div>
    </script>
  </body>
</html>
