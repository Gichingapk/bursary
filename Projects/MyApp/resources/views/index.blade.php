@extends('layouts.app')


@section('content')
<div class="container">
        <h3 class="text-center success">I.T class list</h3>
      <div class="row">

           <a href="{{ route('itclass.create') }}" class="pull-left btn btn-success">Add Student</a>

      </div>
      <div class="row">
        <table class="table table-stripped">
          <tr>
            <td>Username</td>
            <td>Reg No</td>
          </tr>
        @foreach( $students as $student )
          <tr>
            <td>{{$student->usernames}}</td>
            <td>{{$student->regno}}</td>
            <td><a href="{{route('itclass.edit',$student->id)}}" class="btn btn-xs btn-success">Edit</a></td>
            <td>
              <form action="{{ route('itclass.destroy',$student->id ) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}
              <button type="submit" name="submit" class="btn btn-xs btn-danger">Delete</button>
              </form>

            </td>
          </tr>
        @endforeach
        </table>

      </div>
</div>


@endsection
