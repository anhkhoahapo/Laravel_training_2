@extends('admin.layouts.main')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 bg-info">
        <h1>{{ $student->name }}'s info</h1>
        <p>Date of birth: {{ $student->birthday }}</p>
        <p>Address: {{ $student->address }}</p>
        <p>Class: {{ $student->class }}</p>
        <a class="btn btn-primary" href="{{ route('admin', ['id' => $student->id]) }}">Edit</a>
      </div>
    </div>
  </div>
@endsection