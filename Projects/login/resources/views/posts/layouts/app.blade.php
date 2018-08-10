<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laravel CRUD Operations - Basic</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}"></link>
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}"></link>

        <script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}" ></script>
        <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>

        <!-- custom CSS -->
        <style>
        h1{font-size:23px;}
        .pull-left h2{margin-top:0;font-size:20px;}
        </style>
    </head>

    <body>
        <div class="container">
            <h1>CRUD (Create Read Update Delete) Operations in Laravel</h1>
            @yield('content')
        </div>
    </body>
</html>
