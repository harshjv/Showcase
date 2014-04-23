@extends('base')

@section('body')
<div class="container-fluid title-box">
  <h1>Provide your departmental code</h1>
</div>
<div class="container">
  <div class="row text-center">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
      {{ Form::open(array('route' => 'add_check')) }}
      <input class="form-control text-center" autocomplete="off" required name="department_code" placeholder="Department Code">
      <br>
      <button type="submit" class="btn btn-success">Let me add a project</button>
      </form>
    </div>
  </div>
</div>
@stop