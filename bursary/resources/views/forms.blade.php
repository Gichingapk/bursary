<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}"></link>
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.css')}}"></link>

      <link rel="stylesheet" type="text/css"href="{{asset('bootstrap/css/fontawesome.css')}}"></link>
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

      <div class="container">
        <p>---------------------------form 0 with login and register tabs-------------------------------</p>
      </div>
        <div class="container">
              <form class="form-horizontal" role="form">
                    <fieldset>
                      <legend>Legend</legend>
                      <div class="form-group">
                        <label for="inputform" class="col-lg-2 col-lg-offset-10 control-label">Email</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-offset-2" for="pwd">Password:</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                        </div>
                      </div>
                      <div class="form-group">
     <label class="col-md-4 control-label">E-Mail</label>
       <div class="col-md-4 inputGroupContainer">
       <div class="input-group">
           <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
     <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
       </div>
     </div>
    </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                          <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> Checkbox
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                        <div class="col-lg-10">
                          <textarea class="form-control" rows="3" id="textArea"></textarea>
                          <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Radios</label>
                        <div class="col-lg-10">
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                              Option one is this
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                              Option two can be something else
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Selects</label>
                        <div class="col-lg-10">
                          <select class="form-control" id="select">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                          <br>
                          <select multiple="" class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                          <button type="reset" class="btn btn-default">Cancel</button>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </fieldset>
            </form>
          </div>
        </div>

      <p>---------------------------form 1 with login and register tabs-------------------------------</p>

        <section>
            <frameset col="50%,50%">
              <frame>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
            <h2 class="text-center"style="margin-bottom:30px; font-size:40px;font-family:sans-serif;font-weight:bolder;clear:both;">Want to visit an attraction site?</h2>
            <div class="col-lg-6">
              <div class="wrap-login col-md-8 col-md-offset-2">
                <form name="registration" action="" method="post">
                  <div class="form-group">
                    <label for="" > First Name  </label>
                    <input type="text" name="f_name" class="form-control" id="" placeholder="First Name" required="">
                  </div>
                  <div class="form-group">
                    <label for="" > Last Name </label>
                    <input type="text" name="l_name" class="form-control" id="" placeholder="Last Name"required="">
                  </div>
                  <div class="form-group">
                    <label for="" > Email </label>
                    <input type="text" name="l_name" class="form-control" id="" placeholder="example@example.com"required="">
                  </div>
                  <div class="form-group">
                    <label for="" > Phone. No. </label>
                    <input type="text" name="phone" class="form-control" id="" placeholder="+254 732434353"required="">
                  </div>
                  <div class="form-group">
                    <label for="" > Gender  </label><br/>
                    <div class="radio" style="text-decoration:none;padding-left:20px;">
                      <ul>
                    <li><input type="radio" name="sex"  value="male" checked="checked">Male</li>
                    <li><input type="radio" name="sex"  value="female">Female</li>
                    <li><input type="radio" name="sex"  value="others">Others</li>
                  </ul>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="" > Marital Status </label>
                    <input type="text" name="marital" class="form-control" id="" placeholder="Marital Status"required="">
                  </div>
                  <div class="form-group">
                    <label for="" > Nationality </label>
                    <input type="text" name="nationality" class="form-control" id="" placeholder="Nationality"required="">
                  </div>
                </form>
              </div>
            </div>
    </frame>
    <frame>
            <div class="col-lg-6">
              <div class="wrap-login col-md-8 col-md-offset-2">
                <form name="registration" action="" method="post">
                  <div class="form-group">
                    <label for="county">Which county do you want to visit?</label>
                      <select name="county" id="county" class="form-control selectpicker" onchange="showpark(this.value)">
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="" > Which park/reserve do you want to visit?  </label>
                    <div class="" id="park">
                      <select class="form-control" name="" >
                        <option value="">Select Park</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" > Wish to book a nearby hotel for accomodation.(Choose)  </label>
                    <div class="" id="hotel">
                      <select class="form-control" name="" >
                        <option value="">Select Hotel</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="" > Accomodation Cost </label>
                    <input type="text" name="username" class="form-control" id="" placeholder="Cost"required="">
                  </div>
                  <div class="form-group">
                    <label for="" > No. of Tourist. </label>
                    <input type="text" name="nationality" class="form-control" id="" placeholder="Enter the no. of tourist visiting us."required="">
                  </div>
                </form>
              </div>
            </div>
          </div>
    <button type="submit" name="submit" class="btn-login btn btn-success" style="clear:both;float:right;">Submit</button>
        </div>
      </div>
    </frame>
    </frameset>
        </section>


        <p>---------------------------form  2 with login and register tabs-------------------------------</p>



        <!--Modal: Login / Register Form-->
        <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog cascading-modal" role="document">
                <!--Content-->
                <div class="modal-content">

                    <!--Modal cascading tabs-->
                    <div class="modal-c-tabs">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-2 light-blue darken-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i> Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fa fa-user-plus mr-1"></i> Register</a>
                            </li>
                        </ul>

                        <!-- Tab panels -->
                        <div class="tab-content">
                            <!--Panel 7-->
                            <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body mb-1">
                                    <div class="md-form form-sm mb-5">
                                        <i class="fa fa-envelope prefix"></i>
                                        <input type="email" id="modalLRInput10" class="form-control form-control-sm validate">
                                        <label data-error="wrong" data-success="right" for="modalLRInput10">Your email</label>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fa fa-lock prefix"></i>
                                        <input type="password" id="modalLRInput11" class="form-control form-control-sm validate">
                                        <label data-error="wrong" data-success="right" for="modalLRInput11">Your password</label>
                                    </div>
                                    <div class="text-center mt-2">
                                        <button class="btn btn-info">Log in <i class="fa fa-sign-in ml-1"></i></button>
                                    </div>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                    <div class="options text-center text-md-right mt-1">
                                        <p>Not a member? <a href="#" class="blue-text">Sign Up</a></p>
                                        <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                                    </div>
                                    <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                            <!--/.Panel 7-->

                            <!--Panel 8-->
                            <div class="tab-pane fade" id="panel8" role="tabpanel">

                                <!--Body-->
                                <div class="modal-body">
                                    <div class="md-form form-sm mb-5">
                                        <i class="fa fa-envelope prefix"></i>
                                        <input type="email" id="modalLRInput12" class="form-control form-control-sm validate">
                                        <label data-error="wrong" data-success="right" for="modalLRInput12">Your email</label>
                                    </div>

                                    <div class="md-form form-sm mb-5">
                                        <i class="fa fa-lock prefix"></i>
                                        <input type="password" id="modalLRInput13" class="form-control form-control-sm validate">
                                        <label data-error="wrong" data-success="right" for="modalLRInput13">Your password</label>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fa fa-lock prefix"></i>
                                        <input type="password" id="modalLRInput14" class="form-control form-control-sm validate">
                                        <label data-error="wrong" data-success="right" for="modalLRInput14">Repeat password</label>
                                    </div>

                                    <div class="text-center form-sm mt-2">
                                        <button class="btn btn-info">Sign up <i class="fa fa-sign-in ml-1"></i></button>
                                    </div>

                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                    <div class="options text-right">
                                        <p class="pt-1">Already have an account? <a href="#" class="blue-text">Log In</a></p>
                                    </div>
                                    <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!--/.Panel 8-->
                        </div>

                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!--Modal: Login / Register Form-->

        <div class="text-center">
            <a href="" class="btn btn-default btn-rounded my-3" data-toggle="modal" data-target="#modalLRForm">Launch Modal LogIn/Register</a>
        </div>

  </body>
</html>
