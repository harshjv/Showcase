<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title or 'Sarvajanik College of Engineering and Technology - Showcase' }}</title>
    <link rel="stylesheet" href="/assets/vendor/css/base.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/media.css" />
    @yield('stylesheet')
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid uniq-shadow showcase-nav">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
          <h1><a href="/" class="showcase-logo">Showcase</a></h1>
          <a href="{{ route('add') }}" class="btn btn-default add-project">Add Project</a>
          <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
              {{ Form::open(array('route' => 'search', 'method' => 'get')) }}
                <input type="text" class="form-control" name="q" placeholder="Search" required {{ (isset($search_term) ? 'value="'.$search_term.'"' : '' ) }}>
              </form>
            </div>
          </div>
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