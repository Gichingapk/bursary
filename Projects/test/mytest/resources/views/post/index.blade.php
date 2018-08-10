@extends('layouts.navbar')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h5>Uploaded bursary forms</h5>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="table table-responsive " id="table">
        <table class="table-bordered" id="table">
          <tr >
            <th  width=50px>No.</th>
            <th>Company Name</th>
            <th>Location</th>
            <th>County</th>
            <th>Created At</th>
            <th>Closing Date</th>
            <th class="text-center" width="150px">
              <a href="#"  class="create-modal btn btn-success btn-sm">
                <i class="glyphicon glyphicon-plus"></i>
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
            <td>{{ $value -> date_close }}</td>
            <td width=200px height=50px>
              <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-company="{{$value->company}}" data-county="{{$value->county}}" data-location="{{$value->location}}" data-date_close="{{$value->date_close}}">
                <i class="glyphicon glyphicon-eye">view</i>
              </a>
              <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-company="{{$value->company}}" data-county="{{$value->county}}" data-location="{{$value->location}}" data-date_close="{{$value->date_close}}">
                <i class="glyphicon glyphicon-pencil"></i>
              </a>
              <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-company="{{$value->company}}" data-county="{{$value->county}}" data-location="{{$value->location}}" data-date_close="{{$value->date_close}}">
                <i class="glyphicon glyphicon-trash"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

{{--<!--form create post-->--}}
<div class="modal fade" role="dialog" id="create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"  role="form" >
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="company">Company:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="company" name="company" placeholder="Enter company name here" value="">
              <p class="error text-center alert alert-danger hidden" ></p>
            </div>
          </div>
          <div class="form-group ">
            <label class="control-label col-sm-2" for="location">Location:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="location" name="location" placeholder="Enter location here" value="">
              <p class="error text-center alert alert-danger hidden" ></p>
            </div>
          </div>
          <div class="form-group ">
            <label class="control-label col-sm-2" for="county">County:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="county" name="county" placeholder="Enter county name here" value="">
              <p class="error text-center alert alert-danger hidden" ></p>
            </div>
          </div>
          <div class="form-group ">
            <label class="control-label col-sm-2" for="date_close">Closing Date:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="date_close" name="date_close" placeholder="Enter final submission date here" value="">
              <p class="error text-center alert alert-danger hidden" ></p>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-warning" type="submit" id="add">
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

{{--<!--from show POST-->--}}
<div class="modal fade" role="dialog" id="show">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      {{-- <!--div class="modal-body">
        <p> company : {{$post->company}}</p>
        <p> location : {{$post->location}}</p>
        <p> county: {{$post->county}}</p>
      </div--> --}}
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">
          <span class="glyphicon glyphicon-remove"></span>Close
        </button>
      </div>
    </div>
  </div>
</div>


32781993
wangarijohnmbugua@gmail.com

{{--<!--form edit and delete POST-->--}}
<div class="modal fade" role="dialog" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal" >
          <div class="form-group">
            <label class="control-label col-sm-2" for="id">ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fid" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="company">Company</label>
            <div class="col-sm-10">
              <input type="name" class="form-control" id="company">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="company">Location</label>
            <div class="col-sm-10">
              <input type="name" class="form-control" id="location">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="company">County</label>
            <div class="col-sm-10">
              <input type="name" class="form-control" id="county">
            </div>
          </div>
        </form>

        {{--<!--Form delete post-->--}}
      <div class="deleteContent">
        Are you sure you want to delete <span class="company">?</span>
        <span class="hidden id"></span>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn actionbtn" data-dismiss="modal">
        <span id="footer_action_button" class="glyphicon glyphicon-check"></span>
      </button>
      <button type="button" class="btn btn-warning" data-dismiss="modal">
        <span  class="glyphicon glyphicon-remove"></span>Close
      </button>
    </div>
  </div>
  </div>
</div>
@endsection
