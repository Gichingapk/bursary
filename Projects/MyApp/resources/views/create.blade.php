@extends('layouts.app')

@section('content')
<div class="container">

  <form  action="{{ route('itclass.store') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="username">Full names</label>
      <input type="text" name="username" class="form-control"/>
    </div>
    <div class="form-group">
      <label for="regno">Registration Number</label>
      <input type="text" name="regno" class="form-control"/>
    </div>
    <button type="submit" class="btn btn-danger" name="submit">Add</button>
  </form>


</div>

@endsection
