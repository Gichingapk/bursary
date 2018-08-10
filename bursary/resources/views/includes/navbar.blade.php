<!--nav class="navbar navbar-inverse">
 <div class="container-fluid">
   <div class="navbar-header">
     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <a class="navbar-brand" href="/">{{ config('app.name','Blog')}}</a>
   </div>
   <div class="collapse navbar-collapse" id="myNavbar">
     <ul class="nav navbar-nav">
       <li><a href="/">Home</a></li>
       <li><a href="/homepage">Homepage</a></li>
       <li><a href="/institution">Institution</a></li>
       <li><a href="/services">Services</a></li>
     </ul>
     <ul class="nav navbar-nav navbar-right">
       <li><a href="/posts/create">Create Post</a></li>
       <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
       <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
     </ul>
   </div>
 </div>
</nav-->


<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Blog') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
              <li><a href="/">Home</a></li>
              <li><a href="/homepage">Homepage</a></li>
              <li><a href="/institution">Institution</a></li>
              <li><a href="/services">Services</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                <li class="nav-item">
                  <li><a href="/posts/create">Create Post</a></li>
                </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a href="/index" class="dropdown-item">Dashboard</a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
