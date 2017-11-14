@extends('admin.layouts.app')

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
        <h2>Teacher list</h2>
        <p>Dummy teachers</p>
      </div>
      <div class="actions-head col-md-6">
        <a class="new-btn btn btn-primary" href="{{ route('admin.teacher.create') }}">+ New</a>
        <form class="search-form form form-inline" method="GET" action="{{ route('admin.teacher.search') }}">
          <input class="form-control" type="text" placeholder="Teacher name" name="name">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>MSGV</th>
        <th>Name</th>
        <th>Date of birth</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th></th>
      </tr>
      </thead>
      <tbody>

      @php
        $count = 1;
      @endphp

      @foreach($teachers as $teacher)
        <tr>
          <td>{{ $count++ }}</td>
          <td>{{ $teacher->teacher_id }}</td>
          <td>{{ $teacher->name }}</td>
          <td>{{ $teacher->birthday }}</td>
          <td>{{ $teacher->created_at }}</td>
          <td>{{ $teacher->updated_at }}</td>
          <td>
            <a class="btn btn-success" href="{{ route('admin.teacher.show', ['teacher' => $teacher->id]) }}">Detail</a>
            <a class="btn btn-primary" href="{{ route('admin.teacher.edit', ['teacher' => $teacher->id]) }}">Edit</a>
            <form
                class="form-inline"
                method="POST"
                action="{{ route('admin.teacher.destroy', ['teacher' => $teacher->id]) }}"
            >

              <button type="submit" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>

              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </td>
        </tr>
      @endforeach

      </tbody>
    </table>
    <div class="pagination col-md-12">
      {{ $teachers->links() }}
    </div>
  </div>

@endsection