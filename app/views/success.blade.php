@extends('base')

@section('body')
@if(Session::has('alert'))
<div class="alert alert-info alert-full-width text-center" style="margin-top:-30px">
  <p>{{ Session::get('alert') }}</p>
</div>
@endif
<div class="container-fluid title-box">
  <h1>{{ $data['message'] }}</h1>
  <h4 class="text-muted">I have mailed you the code below, you can not it down.</h4>
  <h4 class="text-muted">Keep this code with you when you want to edit your project in future.</h4>
</div>
<div class="container">
  <div class="row text-center">
    <div class="col-lg-8 col-lg-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          {{ $data['code'] }}
        </div>
      </div>
      <a href="{{ route('view_project', $data['id']) }}" class="btn btn-default">View your project</a>
    </div>
  </div>
</div>
@stop