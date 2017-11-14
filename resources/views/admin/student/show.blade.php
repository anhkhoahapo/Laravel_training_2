@extends('admin.layouts.app')

@section('styles')
  <style>
    h1 {
      margin-bottom: 50px;
    }

    .btn {
      margin: 20px 0;
    }

    .info-panel {
      padding: 30px;
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
      <div class="info-panel col-md-12 bg-info">
        <h1>{{ $student->student_id }}</h1>
        <div class="col-md-3">
          <img class="img-responsive img-rounded" src="{{ Storage::url($student->avatar) }}" alt="Avatar">
        </div>
        <div class="col-md-6 col-md-offset-2">
          <p>Name: {{ $student->name }}</p>
          <p>Email: {{ $student->email }}</p>
          <p>Date of birth: {{ $student->birthday }}</p>
          <a class="btn btn-primary" href="{{ route('admin.student.edit', ['student' => $student->id]) }}">Edit profile</a>
        </div>
      </div>
    </div>

    <div class="row">
      <h2>Student result</h2>
      <table class="table">
        <thead>
        <tr>
          <th>#</th>
          <th>Subject Name</th>
          <th>Semester</th>
          <th>Score</th>
          <th>Created at</th>
          <th>Updated at</th>
        </tr>
        </thead>
        <tbody>

        @php
          $count = 1;
          $sum = 0;
        @endphp

        @foreach($student->schoolClasses as $class)
          @php
            $sum += $class->pivot->score?$class->pivot->score:0;
          @endphp
          <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $class->subject->name }}</td>
            <td>{{ $class->semester }}</td>
            <td>{{ $class->pivot->score }}</td>
            <td>{{ $class->created_at }}</td>
            <td>{{ $class->updated_at }}</td>
          </tr>
        @endforeach

          <tr class="bg-info">
            <td>Result</td>
            <td></td>
            <td></td>
            <td>{{ $count>1?$sum/($count-1):'' }}</td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
@endsection