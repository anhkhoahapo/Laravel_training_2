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
      <div class="col-md-8 col-md-offset-2 bg-info">
        <h1>{{ $student->student_id }}</h1>
        <div class="col-md-4">
          <img class="img-responsive img-rounded" src="{{ Storage::url($student->avatar) }}" alt="Avatar">
        </div>
        <div class="col-md-8">
          <p>Name: {{ $student->name }}</p>
          <p>Email: {{ $student->email }}</p>
          <p>Date of birth: {{ $student->birthday }}</p>
          <a class="btn btn-primary" href="{{ route('admin.student.edit', ['student' => $student->id]) }}">Edit</a>
        </div>
      </div>
    </div>
  </div>
@endsection