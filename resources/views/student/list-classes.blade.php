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
          <input class="form-control" type="text" placeholder="Semester" name="semester" >
          <input class="form-control" type="text" placeholder="Subject name" name="name">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
    @php
      $count = 1;
      $registedClasses = auth()->guard('student')->user()->schoolClasses()->select('id')->get();
    @endphp

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      @foreach($subjects as $subject)
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="{{ 'heading'.$subject->id }}">
            <h4 class="panel-title text-center">
              <a role="button" data-toggle="collapse" data-parent="#accordion"
                 href="{{ '#'.$subject->id }}"
                 aria-expanded="true" aria-controls="{{ $subject->id }}"
              >
                <strong>{{ $subject->name }}</strong>
              </a>
            </h4>
          </div>
          <div id="{{ $subject->id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="{{ 'heading'.$subject->id }}">
            <div class="panel-body">
              @foreach($subject->schoolClasses as $class)
                <div class="row">
                  <div class="col-md-1">
                    <p>ID: <span>{{ $class->id }}</span></p>
                  </div>
                  <div class="col-md-4">
                    <p>{{ $class->subject->name }}</p>
                  </div>
                  <div class="col-md-4">
                    <p>Semester: {{ $class->semester }}</p>
                  </div>
                  <div class="col-md-3  text-center">
                    @if(!$registedClasses->contains($class->id))
                      <form
                          class="form-inline"
                          method="POST"
                          action="{{ route('student.class_register') }}"
                      >
                        <input type="hidden" name="class_id" value="{{ $class->id }}">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      </form>

                    @else
                      <form
                          class="form-inline"
                          method="POST"
                          action="{{ route('student.class_unregister') }}"
                      >
                        <input type="hidden" name="class_id" value="{{ $class->id }}">
                        <button type="submit" class="btn btn-danger">Unregister</button>

                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      </form>
                    @endif
                  </div>
                </div>
                <hr>
              @endforeach
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

@endsection