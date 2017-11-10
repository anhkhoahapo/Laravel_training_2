@extends('admin.layouts.main')

@section('styles')
  <style>
    .actions-head {
      text-align: end;
    }
    .new-btn {
      margin-top: 30px;
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
        <h2>Student list</h2>
        <p>Dummy students</p>
      </div>
      <div class="actions-head col-md-6">
        <a class="new-btn btn btn-primary" href="{{ route('admin.create') }}">+ New</a>
      </div>
    </div>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date of birth</th>
        <th>Address</th>
        <th>Class</th>
        <th></th>
      </tr>
      </thead>
      <tbody>

      @foreach($students as $student)
        <tr>
          <td>{{ $student->id }}</td>
          <td>{{ $student->name }}</td>
          <td>{{ $student->birthday }}</td>
          <td>{{ $student->address }}</td>
          <td>{{ $student->class }}</td>
          <td>
            <a class="btn btn-success" href="{{ route('admin.show', ['id' => $student->id]) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('admin.edit', ['id' => $student->id]) }}">Edit</a>
            <form
                class="form-inline"
                method="POST"
                action="{{ route('admin.destroy', ['id' => $student->id]) }}"
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
      {{ $students->links() }}
    </div>
  </div>

@endsection