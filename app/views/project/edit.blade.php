@extends('base')

@section('body')
<div class="container-fluid title-box">
  <h1>Provide the code</h1>
  <h4 class="text-muted">One that I've mailed you</h4>
</div>
<div class="container">
  <div class="row text-center">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
      {{ Form::open(array('route' => 'edit_check')) }}
      <input class="form-control text-center" autofocus="true" autocomplete="off" required name="code">
      <br>
      <button type="submit" class="btn btn-success">Let me edit it</button>
      </form>
    </div>
  </div>
</div>
@stop