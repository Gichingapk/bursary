@extends('layouts.navbar')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h5>Uploaded bursary forms</h5>
  </div>
</div>

<div class="row">
  <div class="table table-responsive " id="table">
    <table class="table-bordered" id="table">
      <tr>
        <th>No.</th>
        <th>Company Name</th>
        <th>Location</th>
        <th>County</th>
        <th>Created At</th>
        <th>Closing Date</th>
        <th class="text-center" width="150px">
          <a href="#" class="create-model btn btn-success btn-sm">
            <i class="glyphicon glyphicon-plus">+</i>
          </a>
        </th>
      </tr>

      {{ csrf_field() }}

      <?php $no=1; ?>

      @foreach ($post as $key => $value)
      <tr class="post {{ $value -> id }} ">
        <td>{{ $no++ }}</td>
        <td>{{ $value -> company }}</td>
        <td>{{ $value -> location }}</td>
        <td>{{ $value -> county }}</td>
        <td>{{ $value -> created_at }}</td>
        <!--td>{{ $value -> company }}</td-->
        <td>{{ $value -> date_close }}</td>
        <td width=200px>
          <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-company="{{$value->company}}" data-county="{{$value->county}}">
            <i class fa fa-eye>view</i>
          </a>
          <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-company="{{$value->company}}" data-county="{{$value->county}}">
            <i class glyphicon glyphicon-pencil>edit</i>
          </a>
          <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-company="{{$value->company}}" data-county="{{$value->county}}">
            <i class glyphicon glyphicon-trash>delete</i>
          </a>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<!--form create post-->
<!--div class="modal fade" role="dialog" id="create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"  role="form">
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="Company">Company:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="company" name="company" placeholder="Enter company name here" value="">
              <p class="error text-center alert alert-danger hidden" ></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="location">Location:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="location" name="location" placeholder="Enter location here" value="">
              <p class="error text-center alert alert-danger hidden" ></p>
            </div>
          </div>
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="county">County:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="county" name="county" placeholder="Enter county name here" value="">
              <p class="error text-center alert alert-danger hidden" ></p>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-warning" type="submit" data-dismiss="modal">
              <span class="glyphicon glyphicon-plus"></span>Save Post
            </button>
            <button class="btn btn-warning" type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remote"></span>Close
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--from show POST->
<div class="modal fade" role="dialog" id="show">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismis="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p>Company: {{$post->company}}</p>
        <p>Location: {{$post->location}}</p>
        <p>County: {{$post->county}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-earning" data-dismis="modal">
          <span class="glyphicon glyphicon-remove"></span>Close
        </button>
      </div>
    </div>
  </div>
</div>

<!--form edit and delete POST->
<div class="modal fade" role="dialog" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismis="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal" >
          <div class="form-group">
            <label class="control-label col-sm-2" for="id">ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fid" disabled></input>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="company">Company</label>
            <div class="col-sm-10">
              <input type="name" class="form-control" id="company"></input>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="company">Location</label>
            <div class="col-sm-10">
              <input type="name" class="form-control" id="location"></input>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="company">County</label>
            <div class="col-sm-10">
              <input type="name" class="form-control" id="county"></input>
            </div>
          </div>
        </form>

        <!--Form delete post->
        <div class="deleteContent">
          Are you sure you want to delete <span class="company">?</span>
          <span class="hidden id"></span>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn actionbtn" data-dismiss="modal">
          <span id="footer_action_button" class="glyphicon"></span>
        </button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">
          <span id="footer_action_button" class="glyphicon"></span>Close
        </button>
      </div>
    </div>
    </div>
  </div-->

@endsection
