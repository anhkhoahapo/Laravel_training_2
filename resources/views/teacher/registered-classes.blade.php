@extends('teacher.layouts.app')

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
        <th>Students</th>
        <th></th>
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
          <td>{{ $class->students()->count() }}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('teacher.class_students', ['class' => $class->id]) }}">List Student</a>
            <form
                class="form-inline"
                method="POST"
                action="{{ route('teacher.class_unregister') }}"
            >
              <input type="hidden" name="class_id" value="{{ $class->id }}">
              <button type="submit" class="btn btn-danger">Unregister</button>

              {{ method_field('DELETE') }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </td>
        </tr>
      @endforeach

      </tbody>
    </table>
    <div class="pagination col-md-12">
      {{ $classes->links() }}
    </div>
  </div>

@endsection