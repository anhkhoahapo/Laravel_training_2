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
          <h1>Subject {{ $subject->id }} info</h1>
          <p><strong>Name: </strong>{{ $subject->name }}</p>
          <p><strong>Credits: </strong>{{ $subject->credit }}</p>
          <a class="btn btn-primary" href="{{ route('admin.subject.edit', ['subject' => $subject->id]) }}">Edit</a>
      </div>
    </div>
  </div>
@endsection