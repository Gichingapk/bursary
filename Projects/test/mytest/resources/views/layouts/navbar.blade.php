<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bursary Application</title>


    <!-- Styles -->
    <link href="{{ asset('bootstrap-/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('bootstrap/css/font-awesome.css') }}" rel="stylesheet" type="text/css">


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

    <script type="text/javascript" src="{{asset('bootstrap/js/jquery.js')}}" ></script>
    <script type="text/javascript" src="{{asset('bootstrap-/js/bootstrap.min.js')}}" ></script>
    <!--Ajax form Add-->
    <script type="text/javascript">
    $(document).on('click','.create-modal', function(){
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Bursary Form');
    });

  //function add (save)
  $("#add").click(function(){
      $.ajax({
        type : 'POST',
        url  : 'addPost',
        data :{
          '_token' : $('input[name=_token]').val(),
          'company': $('input[name=company]').val(),
          'location': $('input[name=location]').val(),
          'county'  : $('input[name=county]').val(),
          'date_close': $('input[name=date_close]').val(),
        },
        success: function(data){
          if((data.errors)){
            $('.error').removeClass('hidden');
            $('.error').text(data.errors.company);
            $('.error').text(data.errors.location);
            $('.error').text(data.errors.county);
            $('.error').text(data.errors.date_close);
          }
          else{
            $('.error').remove();
            $('#table').append("<tr class='post'" + data.id +"'>"+
            "<td>" + data.id + "</td>" +
            "<td>" + data.company + "</td>" +
            "<td>" + data.location + "</td>" +
            "<td>" + data.county + "</td>" +
            "<td>" + data.date_close + "</td>" +
            "<td><a class='show-modal btn btn-info btn-sm' data-id='" +data.id+ "'data-company '" + data.company+ "' data-location '"+data.location+"' data-county'"+data.county+ "' data-date_close'"+data.date_close+ "'>" +
            "<i class='glyphicon glyphicon-eye'></i></a>" +
            "<td><a class='edit-modal btn btn-warning btn-sm' data-id='" +data.id+ "'data-company '" + data.company+ "' data-location '"+data.location+"' data-county'"+data.county+ "' data-date_close'"+data.date_close+ "'>" +
            "<i class='glyphicon glyphicon-pencil'></i></a>" +
            "<td><a class='delete-modal btn btn-danger btn-sm' data-id='" +data.id+ "'data-company '" + data.company+ "' data-location '"+data.location+"' data-county'"+data.county+ "' data-date_close'"+data.date_close+"'>" +
            "<i class='glyphicon glyphicon-trash'></i></a>" +
            "</td>" +
            "</tr>");
          }
        },
      });
      $('#company').val('');
      $('#location').val('');
      $('#county').val('');
      $('#date_close').val('');
    });

    //show function
      $(document).on('click','.show-modal',function(){
        $('#show').modal('show');
        $('.modal-title').text('show-post');
      });

       // function edit POST
      $(document).on('click','.edit-modal',function(){
      $('#footer_action_button').text("Update Post");
      $('#footer_action_button').addClass('glyphicon-check');
      $('#footer_action_button').removeClass('glyphicon-trash');
      $('.actionbtn').addClass('btn-success');
      $('.actionbtn').removeClass('btn-danger');
      $('.actionbtn').addClass('edit');
      $('.modal-title').text('Post Edit');
      $('.deleteContent').hide();
      $('.form-horizontal').show();
      $('#fid').val($(this).data('id'));
      $('#company').val($(this).data('company'));
      $('#location').val($(this).data('location'));
      $('#county').val($(this).data('county'));
      $('#myModal').modal('show');
    });

    $('.modal-footer').on('click','.edit',function(){
      $.ajax({
        type: 'POST',
        url : 'editPost',
        data:{
          '_token':$('input[name=_token]').val(),
          'id': $('#fid').val(),
          'company': $('#company').val(),
          'location': $('#location').val(),
          'county': $('#county').val()
        },

          success:function(data){
            $('.post' + data.id).replaceWith(" "+
            "<tr class='post" + data.id + "'>" +
            "<td>" + data.id + "</td>" +
            "<td>" + data.company + "</td>" +
            "<td>" + data.location + "</td>" +
            "<td>" + data.county + "</td>" +
            "<td>" + data.created_at + "</td>" +
            "<td><a class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-company = '" + data.company + "' data-location = '"+ data.location +"' data-county= '" + data.county+ "'>" +
            "<i class='glyphicon glyphicon-eye'>view</i></a>" +
            "<td><a class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-company = '" + data.company + "' data-location = '"+ data.location +"' data-county= '"+ data.county+ "'>" +
            "<i class='glyphicon glyphicon-pencil'>edit</i></a>" +
            "<td><a class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-company = '" + data.company + "' data-location=  '"+ data.location +"' data-county= '"+ data.county+ "'>" +
            "<i class='glyphicon glyphicon-trash'>delete</i></a>" +
            "</td>" +
            "</tr>");
          }
      });
    });
    </script>
  </body>
</html>
