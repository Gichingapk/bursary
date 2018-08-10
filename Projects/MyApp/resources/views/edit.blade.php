@extends('layouts.app')

@section('content')
<div class="container">

  <form  action="{{ route('itclass.update',$student->id ) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="form-group">
      <label for="username">Full names</label>
      <input type="text" name="username" value="{{ $student->usernames }}" class="form-control"/>
    </div>
    <div class="form-group">
      <label for="regno">Registration Number</label>
      <input type="text" name="regno" value="{{ $student->regno }}" class="form-control"/>
    </div>
    <button type="submit" class="btn btn-default" name="submit">Update</button>
  </form>


</div>

@endsection
