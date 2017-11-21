@extends('teacher.layouts.app')

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
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @if (Session::has('success'))
        <div class="alert alert-success">
          <p>{{ Session::get('success') }}</p>
        </div>
      @endif
      <div class="info-panel col-md-12 bg-info">
        <h1>Class {{ $class->id }}</h1>
        <div class="col-md-12">
          <p><strong>Subject Name: </strong>{{ $class->subject->name }}</p>
          <p><strong>Semester: </strong>{{ $class->semester }}</p>
        </div>
      </div>
    </div>

    <div class="row">
      <h2>Class Students</h2>
      <form action="{{ route('teacher.student_score', ['class' => $class->id]) }}" method="POST" class="text-center">
        <table class="table text-left">
        <thead>
        <tr>
          <th>#</th>
          <th>Student ID</th>
          <th>Student Name</th>
          <th class="text-center">Score</th>
          <th>Registerd at</th>
          <th>Updated at</th>
        </tr>
        </thead>
        <tbody>

        @php
          $count = 1;
        @endphp

        @foreach($class->students as $student)
          <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td class="text-center">
              <label class="sr-only" for="scoreTxt">Student Score</label>
              <input id="scoreTxt" type="text" name="score[{{ $student->id }}]" value="{{ $student->pivot->score }}">
            </td>
            <td>{{ $student->pivot->created_at }}</td>
            <td>{{ $student->pivot->updated_at }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>

      <button class="btn btn-primary" type="submit">Update Student Score</button>

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </form>
    </div>
  </div>
@endsection