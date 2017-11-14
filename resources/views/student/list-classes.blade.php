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
      @if (Session::has('success'))
        <div class="alert alert-success">
          <p>{{ Session::get('success') }}</p>
        </div>
      @endif
      <div class="col-md-6">
        <h2>Class list</h2>
      </div>
      <div class="actions-head col-md-6">
        <form class="search-form form form-inline" method="GET" action="{{ route('student.classes.search') }}">
          <input class="form-control" type="text" placeholder="Subject name" name="name">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>ID</th>
        <th>Subject</th>
        <th>Semester</th>
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
          <td>
            {{--<a class="btn btn-success" href="{{ route('admin.student.show', ['student' => $student->id]) }}">Detail</a>--}}
            {{--<a class="btn btn-primary" href="{{ route('admin.student.edit', ['student' => $student->id]) }}">Edit</a>--}}
            {{--<form--}}
                {{--class="form-inline"--}}
                {{--method="POST"--}}
                {{--action="{{ route('admin.student.destroy', ['student' => $student->id]) }}"--}}
            {{-->--}}

              {{--<button type="submit" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>--}}

              {{--<input type="hidden" name="_method" value="DELETE">--}}
              {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
            {{--</form>--}}
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