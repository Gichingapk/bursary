<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bursary Application</title>

    <!-- Styles -->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('bootstrap/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
  <!--script-->
  <script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}" ></script>
  <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>
  <style media="screen">
  body {
padding-top: 54px;
}

@media (min-width: 992px) {
body {
  padding-top: 56px;
}
}

  </style>
  </head>
  <body>

    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselIndicators" data-slide-to="1"></li>
    <li data-target="#carouselIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="{{ asset('images/1.jpg')}}" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>Machakos University</h3>
        <p>Welcome To The Machakos University Hotel And Conference Center</p>
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="{{ asset('images/2.jpg')}}" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>Machakos University</h3>
        <p>Welcome To The Machakos University Hotel And Conference Center</p>
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="{{ asset('images/3.jpg')}}" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
        <h3>Machakos University</h3>
        <p>Welcome To The Machakos University Hotel And Conference Center</p>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



  </body>
</html>
