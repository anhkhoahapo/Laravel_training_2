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
        <h1>{{ $teacher->teacher_id }}</h1>
        <div class="col-md-4">
          <img class="img-responsive img-rounded" src="{{ Storage::url($teacher->avatar) }}" alt="Avatar">
        </div>
        <div class="col-md-8">
          <p>Name: {{ $teacher->name }}</p>
          <p>Email: {{ $teacher->email }}</p>
          <p>Date of birth: {{ $teacher->birthday }}</p>
          <a class="btn btn-primary" href="{{ route('admin.teacher.edit', ['teacher' => $teacher->id]) }}">Edit</a>
        </div>
      </div>
    </div>
  </div>
@endsection