@extends('student.layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading"><h2>My profile</h2></div>

          @php
            $user = \Auth::guard('student')->user();
          @endphp
          <div class="panel-body">
            <div class="row">
              <div class="col-md-8">
                <p><strong>MSSV: </strong>{{ $user->student_id }}</p>
                <p><strong>Name: </strong>{{ $user->name }}</p>
                <p><strong>Date of birth: </strong>{{ $user->birthday }}</p>
                <p><strong>Email: </strong>{{ $user->email }}</p>

                {{--<a href="{{ route('student.') }}" class="btn btn-primary">Update</a>--}}
              </div>
              <div class="col-md-4">
                <img class="img-responsive img-rounded" src="{{ Storage::url($user->avatar) }}" alt="Avatar">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection