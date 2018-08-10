<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}" ></script>
    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>

    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.css')}}"></link>
    <title>Contact Us</title>
    <style media="screen">
      .invalid-feedback{
        display: block;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h4>Contact Us</h4>
      <div class="row">
        <div class="col-md-6">
          <form class="form-horizontal" action="{{ url('bursary.contact') }}" method="POST">
            {{ csrf_field() }}


            <div class="form-group">
              <label for="" >Email :</label>
              <input type="text" name="email" class="form-control" value=""/>

            </div>
            <div class="form-group">
              <label for="" >Subject :</label>
              <input type="text" name="subject" class="form-control" value=""/>

            </div>
            <div class="form-group">
              <label for="" >Message : </label>
              <textarea class="form-control" name="message" rows="8" cols="80"></textarea>

            </div>

            <button class="btn btn-lg btn-primary" type="button" name="button">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
