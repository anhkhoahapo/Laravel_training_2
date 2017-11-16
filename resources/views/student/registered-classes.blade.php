@extends('student.layouts.app')

@section('styles')
  <style>
    .actions-head {
      padding: 30px 0;
      display: flex;
      align-items: center;
      justify-content: flex-end;
    }
    .new-btn {
      margin-right: 20px;
    }
    .pagination {
      text-align: center;
    }
    .form-inline {
      display:inline;
    }
  </style>
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Class list</h2>
      </div>
    </div>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Class ID</th>
        <th>Subject</th>
        <th>Semester</th>
        <th>Score</th>
      </tr>
      </thead>
      <tbody>

      @php
        $count = 1;
      @endphp

      @foreach($classes as $class)
        <tr>
          <td>{{ $count++ }}</td>
          <td>{{ $class->id }}</td>
          <td>{{ $class->subject->name }}</td>
          <td>{{ $class->semester }}</td>
          <td>{{ $class->pivot->score }}</td>
        </tr>
      @endforeach

      </tbody>
    </table>
    <div class="pagination col-md-12">
      {{ $classes->links() }}
    </div>
  </div>

@endsection