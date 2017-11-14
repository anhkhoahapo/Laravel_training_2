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
      @elseif (Session::has('error'))
         <div class="alert alert-danger">
           <p>{{ Session::get('error') }}</p>
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
    <div class="row">
      <form class="col-md-2" method="GET">
        <input type="text" name="semester" placeholder="Semester" class="form-control">
      </form>
    </div>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Class ID</th>
        <th>Subject</th>
        <th>Semester</th>
        <th></th>
      </tr>
      </thead>
      <tbody>

      @php
        $count = 1;
        $registedClasses = \Auth::guard('student')->user()->schoolClasses()->get()->pluck('id');
      @endphp

      @foreach($classes as $class)
        <tr>
          <td>{{ $count++ }}</td>
          <td>{{ $class->id }}</td>
          <td>{{ $class->subject->name }}</td>
          <td>{{ $class->semester }}</td>
          <td>
            @if(!$registedClasses->contains($class->id))
              <form
                  class="form-inline"
                  method="POST"
                  action="{{ route('student.class-register') }}"
              >
                <input type="hidden" name="class_id" value="{{ $class->id }}">
                <button type="submit" class="btn btn-primary">Register</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>

            @else
              <form
                  class="form-inline"
                  method="POST"
                  action="{{ route('student.class-unregister') }}"
              >
                <input type="hidden" name="class_id" value="{{ $class->id }}">
                <button type="submit" class="btn btn-danger">Unregister</button>

                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
            @endif
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