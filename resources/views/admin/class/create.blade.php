@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h2>Create new Subject</h2>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form class="form-horizontal" method="POST"
            action="{{ route('admin.class.store') }}"
      >
        <div class="form-group">
          <label for="subjectSlc" class="col-sm-2 control-label">Subject</label>
          <div class="col-sm-10">
            <select class="form-control" id="subjectSlc" name="subject_id">
              @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name.' - '.$subject->id }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="teacherSlc" class="col-sm-2 control-label">Teacher</label>
          <div class="col-sm-10">
            <select class="form-control" id="teacherSlc" name="teacher_id">
              <option value="{{ Null }}" selected>Not choose yet</option>
              @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name.' - '.$teacher->teacher_id }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="semesterTxt" class="col-sm-2 control-label">Semester</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="semesterTxt" placeholder="Semester" name="semester" value="{{ \Carbon\Carbon::now()->year }}">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </form>
    </div>
  </div>
@endsection