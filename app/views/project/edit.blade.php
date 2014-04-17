@extends('base')

@section('title')
Edit project - Sarvajanik College of Engineering and Technology - Showcase
@stop

@section('body')
<div class="container-fluid title-box">
  <h1>Provide the code</h1>
  <h4 class="text-muted">One that I've mailed you</h4>
</div>
<div class="container">
  <div class="row text-center">
    <div class="col-lg-8 col-lg-offset-2">
      {{ Form::open(array('route' => 'edit_check')) }}
      <input class="form-control" autofocus="true" autocomplete="off" required name="code">
      <br>
      <button type="submit" class="btn btn-success">Let me edit it</button>
      </form>
    </div>
  </div>
</div>
@stop