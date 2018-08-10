<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <!--link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}"-->
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}"></link>
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.css')}}"></link>

    <link rel="stylesheet" type="text/css"href="{{asset('bootstrap/css/font-awesome.css')}}"></link>


    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.min.js')}}" ></script>
    <script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}" ></script>
    <script type="text/javascript" src="{{asset('bootstrap/js/jquery-ui.min.js')}}" ></script>
    <script>
        $( function() {
          $( "#datepicker" ).datepicker();
        });
  </script>

    <title></title>
  </head>
  <body>


    <div class="container-fluid">
      <form class="form-horizontal" action="" method="post">
        <div class="well">
        <div class="panel-group" >
          <div class="panel panel-header panel-primary text-center" style="background-color:cyan;">
            <h4>Student Bursary Application Form</h4>
          </div>
        <div class="panel-body">
       <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="col-lg-6 col-md-6">
            <div class="panel-header text-center">
              <h4>Student Details</h4>
            </div>
          <div class="panel panel-primary">
            <div class="form-group">
              <label class="col-md-2  control-label">First Name</label>
                <div class="col-md-9  inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Registration No.</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Institution</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Course</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="" placeholder="" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Year of Study:</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">ID No.</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="" placeholder="" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Email Address</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="" placeholder="" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Phone No.</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="" placeholder="" class="form-control"  type="text">
                </div>
              </div>
            </div>
          </div>
        </div>

              <div class="col-lg-6 col-md-6">
                <div class="panel-header text-center">
                  <h4>Residence</h4>
                </div>
            <div class="panel panel-primary">
              <div class="form-group">
                <label class="col-md-2  control-label">First Name</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Registration No.</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Institution</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Course</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="" placeholder="" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Year of Study:</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">ID No.</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="" placeholder="" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Email Address</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="" placeholder="" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Phone No.</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="" placeholder="" class="form-control"  type="text">
                  </div>
                </div>
              </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="panel-group" >
        <div class="panel-body">
       <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="col-lg-6 col-md-6">
            <div class="panel-header text-center">
              <h4>Student Details</h4>
            </div>
          <div class="panel panel-primary">
            <div class="form-group">
              <label class="col-md-2  control-label">First Name</label>
                <div class="col-md-9  inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Registration No.</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Institution</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Course</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="" placeholder="" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Year of Study:</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">ID No.</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="" placeholder="" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Email Address</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="" placeholder="" class="form-control"  type="text">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2  control-label">Phone No.</label>
                <div class="col-md-9 inputGroupContainer">
                  <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                     <input  name="" placeholder="" class="form-control"  type="text">
                </div>
              </div>
            </div>
          </div>
        </div>

              <div class="col-lg-6 col-md-6">
                <div class="panel-header text-center">
                  <h4>Residence</h4>
                </div>
            <div class="panel panel-primary">
              <div class="form-group">
                <label class="col-md-2  control-label">First Name</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Registration No.</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Institution</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Course</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="" placeholder="" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Year of Study:</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">ID No.</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="" placeholder="" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Email Address</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="" placeholder="" class="form-control"  type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2  control-label">Phone No.</label>
                  <div class="col-md-9 inputGroupContainer">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                       <input  name="" placeholder="" class="form-control"  type="text">
                  </div>
                </div>
              </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
      </form>
    </div>
  </div>
  </body>
</html>
