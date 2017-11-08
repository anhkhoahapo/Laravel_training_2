<!doctype html>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Student Management</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  @yield('styles')
</head>
<body>

  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarCollapse" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Brand</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav navbar-nav">
          <li>
            <a href="{{ route('admin.index') }}">Home<span class="sr-only">(current)</span></a>
          </li>
          <li>
            <a href="{{ route('admin.create') }}">New student</a>
          </li>
        </ul>

        <form class="navbar-form navbar-right">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>

      </div><!-- /.navbar-collapse -->
    </div>
  </nav>

  @yield('content')

  <script src="{{ asset('js/app.js') }}"></script>

  @yield('scripts')
</body>
</html>