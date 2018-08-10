<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>login</title>
    <style media="screen">
      .box{
        width: 600px;
        margin: 0 auto;
        border: 1px solid #000;
      }
    </style>
  </head>
  <body>
    <br/>
    <div class="container">
      <h3 align="center">Login here</h3>

      @if(Auth::user()-> email)
      <script>window.location='/main/successlogin'</script>
      @endif

        @if(isset(Auth::user()->email))
        <div class="alert alert-danger success-block">
          <strong>Welcome {{ Auth::user()->email }}</strong>
          <br/><br/>
          <a href="{{ url('/main/logout') }}">Logout</a>
        </div>
        else
        <script> window.location="/main"; </script>
        @endif
        <!--
        @if(count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach($err->all() as error)
            <li> {{ $error }} </li>
            @endforeach
          </ul>
        </div>
        @endif
-->
      <form  method="post" action="{{ url('/main/checklogin') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="">Enter Email</label>
          <input type="email" name="email" class="form-control" value=""/>
        </div>
        <div class="form-group">
          <label for="">Enter Password</label>
          <input type="password" name="password" class="form-control" value=""/>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-success" value="Login"/>
        </div>
      </form>
    </div>
  </body>
</html>
