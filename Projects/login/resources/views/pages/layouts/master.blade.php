<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tasks</title>

<link rel="stylesheet" href="{{asset('css/app.css')}}"></link>
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}"></link>

<script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}" ></script>
<script type="text/javascript" src="{{asset('bootstrap/js/jquery-ui.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('home') }}">Tasks</a>
      </div>
      <div class="nav navbar-nav navbar-right">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
      </div>
    </div>
  </nav>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

</body>
</html>
