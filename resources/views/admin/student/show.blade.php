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
      <div class="col-md-8 col-md-offset-2 bg-info">
        <h1>{{ $student->mssv }}</h1>
        <p>Name: {{ $student->name }}</p>
        <p>Email: {{ $student->email }}</p>
        <p>Date of birth: {{ $student->birthday }}</p>
        <a class="btn btn-primary" href="{{ route('admin.student.edit', ['student' => $student->id]) }}">Edit</a>
      </div>
    </div>
  </div>
@endsection