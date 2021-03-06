@extends('base')

@section('stylesheet')
<link rel="stylesheet" href="/assets/css/dropzone.css" />
@stop

@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/select.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/edit.js') }}"></script>
@stop

@section('body')
<div class="container-fluid title-box">
  <h3>Edit Project</h3>
</div>

{{ Form::open(array('route' => 'do_edit', 'id' => 'showcase_edit')) }}

<input type="hidden" class="hide" value="{{ $project->id }}" name="project_id">
<input type="hidden" class="hide" value="{{ $project->code }}" name="project_code">

<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 showcase-form-title">
      <h4>Department</h4>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <p class="form-control-static" style="margin-top:8px">{{ $project->department->name }}</p>
      <input type="hidden" class="hide" autocomplete="off" value="{{ $project->department->id }}" name="department">
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <h5>Project belongs to this department</h5>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 showcase-form-title">
      <h4>Title</h4>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <input type="text" class="form-control" name="title" required value="{{ $project->title }}">
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <h5>Identity of your project</h5>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 showcase-form-title">
      <h4>Subtitle</h4>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <input type="text" class="form-control" name="subtitle" value="{{ $project->subtitle }}">
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <h5>Optional</h5>
    </div>
  </div>
</div>

<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 showcase-form-title">
      <h4>Description</h4>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <textarea class="form-control add-desc-box" rows="10" name="description" required>{{ $project->description_raw }}</textarea>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <h5>A breif description of your project</h5>
      <h5>Markdown format accepted</h5>
    </div>
  </div>
</div>

<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 showcase-form-title">
      <h4>Documentation</h4>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <input type="text" class="form-control" placeholder="Video URL" name="video" required value="{{ $project->video }}">
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <h5>Use <a href="http://vimeo.com">Vimeo</a> for video</h5>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 showcase-form-title"></div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="dropzone uniq-shadow" id="dropzone">
        <div class="fallback">
          <input name="file" type="file" multiple />
        </div>
      </div>
      <input type="hidden" class="hide" id="dz-helper" name="documents" autocomplete="off" value="{{ $project->document_string }}">
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <h5>3 Images <small class="text-danger">required</small></h5>
      <h5>1 PDF <small class="text-danger">required</small></h5>
      <h5>1 ZIP <small>optional</small></h5>
    </div>
  </div>
</div>

<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 showcase-form-title">
      <h4>Participants</h4>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="table-responsive">
          <table class="table table-hover text-center">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Enrollment Number</th>
              </tr>
            </thead>
            <tbody id="part-body">
              @for($i=1; $i<=$project->total_participants;$i++)
              <tr>
                <td><input class="form-control" type="text" name="part_{{ $i }}_name" required autocomplete="off" value="{{ $project['name_'.$i] }}"></td>
                <td><input class="form-control" type="email" name="part_{{ $i }}_email" required autocomplete="off" value="{{ $project['email_'.$i] }}"></td>
                <td><input class="form-control" type="text" name="part_{{ $i }}_enrollment" required autocomplete="off" value="{{ $project['enrollment_'.$i] }}"></td>
              </tr>
              @endfor
            </tbody>
          </table>
        </div>
      </div>
      <input type="hidden" class="hide" id="total-part" name="total_part" value="{{ $project->total_participants }}" autocomplete="off">
      <div class="btn-group btn-group-justified">
        <a class="btn btn-default btn-block" id="add-part">Add participant</a>
        <a class="btn btn-danger btn-block disabled" id="remove-part">Remove last participant</a>
      </div>
    </div>
  </div>
</div>
<br>
<hr>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 showcase-form-title">
      <h4>Final</h4>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <button type="submit" class="btn btn-success btn-block">Save changes</button>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
      <h5>Best of luck for your changes</h5>
    </div>
  </div>
</div>

<br>

<div class="container text-center">
  <p>Added {{ $project->created_at->diffForHumans() }}</p>
  @if($project->created_at != $project->updated_at)
    <p>Updated {{ $project->updated_at->diffForHumans() }}</p>
  @endif
</div>

</form>
@stop