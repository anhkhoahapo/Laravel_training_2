@extends('admin.layouts.app')

@section('styles')
  <style>
    h1 {
      margin-bottom: 50px;
    }

    .btn {
      margin: 20px 0;
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @if (Session::has('success'))
        <div class="alert alert-success">
          <p>{{ Session::get('success') }}</p>
        </div>
      @endif
      <div class="col-md-6 col-md-offset-3 bg-info">
          <h1>Class {{ $class->id }} info</h1>
        @if($class->teacher)
          <p><strong>Teacher: </strong>{{ $class->teacher->name }} - <strong>ID: </strong>{{ $class->teacher->id }}</p>
        @else
          <p><strong>Teacher: </strong>Not choose yet</p>
        @endif
          <p><strong>Subject: </strong>{{ $class->subject->name }} - <strong>ID: </strong>{{ $class->subject->id }}</p>
          <p><strong>Semester: </strong>{{ $class->semester }}</p>
          <a class="btn btn-primary" href="{{ route('admin.class.edit', ['class' => $class->id]) }}">Edit</a>
      </div>
    </div>
  </div>
@endsection