@extends('teacher.layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Teacher Login</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('teacher.post_login') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('teacher_id') ? ' has-error' : '' }}">
                <label for="teacher_id" class="col-md-4 control-label">Teacher ID</label>

                <div class="col-md-6">
                  <input id="teacher_id" type="text" class="form-control" name="teacher_id" value="{{ old('teacher_id') }}"
                         required autofocus>

                  @if ($errors->has('teacher_id'))
                    <span class="help-block">
                      <strong>{{ $errors->first('teacher_id') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" required>

                  @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Login
                  </button>

                  {{--<a class="btn btn-link" href="{{ route('teacher.password.request') }}">--}}
                    {{--Forgot Your Password?--}}
                  {{--</a>--}}
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection