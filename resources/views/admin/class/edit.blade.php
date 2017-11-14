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
      <form class="form-horizontal" method="POST" enctype="multipart/form-data"
            action="{{ route('admin.subject.update', ['subject' => $subject->id]) }}"
      >
        <div class="form-group">
          <label for="nameTxt" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nameTxt" placeholder="Name" name="name" value="{{ $subject->name }}">
          </div>
        </div>

        <div class="form-group">
          <label for="creditTxt" class="col-sm-2 control-label">Credits</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="creditTxt" placeholder="" name="credit" value="{{ $subject->credit }}">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>

        {{ method_field('PUT') }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </form>
    </div>
  </div>
@endsection