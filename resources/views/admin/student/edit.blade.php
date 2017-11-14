@extends('admin.layouts.app')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.min.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h2>Edit student info</h2>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="form-horizontal" method="POST" enctype="multipart/form-data"
          action="{{ route('admin.student.update', ['student' => $student->id]) }}"
      >
        <div class="form-group">
          <label for="studentIdTxt" class="col-sm-2 control-label">Student ID</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="studentIdTxt" placeholder="" name="student_id" value="{{ $student->student_id }}">
          </div>
        </div>

        <div class="form-group">
          <label for="nameTxt" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nameTxt" placeholder="Name" name="name" value="{{ $student->name }}">
          </div>
        </div>

        <div class="form-group">
          <label for="emailTxt" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="emailTxt" placeholder="Email" name="email" value="{{ $student->email }}">
          </div>
        </div>

        <div class="form-group">
          <label for="dobTxt" class="col-sm-2 control-label">Date of birth</label>
          <div class="col-sm-10">
            <div class="input-group">
              <input type="text" class="form-control datepicker" id="dobTxt" name="birthday" value="{{ $student->birthday }}">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="avatar" class="col-sm-2 control-label">Avatar</label>
          <div class="col-sm-10">
            <div class="input-group">
              <img class="img-responsive img-rounded" src="{{ Storage::url($student->avatar) }}" alt="Avatar">
              <input type="file" class="form-control" id="avatar" name="avatar">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
  <script>
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
    })
  </script>
@endsection