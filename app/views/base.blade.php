<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title or 'Sarvajanik College of Engineering and Technology - Showcase' }}</title>
    <link rel="stylesheet" href="/assets/vendor/css/base.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    @yield('stylesheet')
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid uniq-shadow showcase-nav">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
          <h1><a href="/" class="showcase-logo">Showcase</a></h1>
          <a href="{{ route('add') }}" class="btn btn-default add-project">Add Project</a>
          {{ Form::open(array('route' => 'search', 'method' => 'get')) }}
            <input type="text" class="form-control" name="q" placeholder="Search" required {{ (isset($search_term) ? 'value="'.$search_term.'"' : '' ) }}>
          </form>
        </div>
      </div>
    </div>
    @yield('body')
    @include('footer')
    <script type="text/javascript" src="/assets/vendor/js/jquery.js"></script>
    <script type="text/javascript" src="/assets/vendor/js/bootstrap.js"></script>
    <script type="text/javascript" src="/assets/vendor/js/holder.js"></script>
    @yield('javascript')
  </body>
</html>