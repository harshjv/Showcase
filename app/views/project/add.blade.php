@extends('base')

@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
@stop

@section('body')
<div class="container-fluid title-box">
  <h3>Add Project</h3>
</div>

{{ Form::open(array('route' => 'do_add')) }}

<div class="container">
  <div class="row">
    <div class="col-lg-2 text-right">
      <h4>Department</h4>
    </div>
    <div class="col-lg-8">
      <select class="form-control" name="department" required autocomplete="off">
        @foreach($departments as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-2">
      <h5>Project belongs to this department</h5>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-2 text-right">
      <h4>Title</h4>
    </div>
    <div class="col-lg-8">
      <input type="text" class="form-control" name="title" required>
    </div>
    <div class="col-lg-2">
      <h5>Identity of your project</h5>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-2 text-right">
      <h4>Subtitle</h4>
    </div>
    <div class="col-lg-8">
      <input type="text" class="form-control" name="subtitle">
    </div>
    <div class="col-lg-2">
      <h5>Optional</h5>
    </div>
  </div>
</div>

<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 text-right">
      <h4>Description</h4>
    </div>
    <div class="col-lg-8">
      <textarea class="form-control add-desc-box" rows="10" name="description" required></textarea>
    </div>
    <div class="col-lg-2">
      <h5>A breif description of your project</h5>
    </div>
  </div>
</div>

<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 text-right">
      <h4>Documentation</h4>
    </div>
    <div class="col-lg-8">
      <input type="url" class="form-control" placeholder="Video URL" name="video" required>
    </div>
    <div class="col-lg-2">
      <h5>Use <a href="http://vimeo.com">Vimeo</a> for video</h5>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 text-right"></div>
    <div class="col-lg-8">
      <div class="row text-center">
        <div class="col-lg-6">
          <h4>Image</h4>
          <h5 class="text-muted">Size 1000x200px</h5>
          <input type="url" class="form-control" placeholder="Image URL" name="image_1" required>
          <br>
          <input type="url" class="form-control" placeholder="Image URL" name="image_2" required>
          <br>
          <input type="url" class="form-control" placeholder="Image URL" name="image_3" required>
        </div>
        <div class="col-lg-6">
          <h4>Thumbnail</h4>
          <h5 class="text-muted">Size 250x250px</h5>
          <input type="url" class="form-control" placeholder="Thumbnail URL" name="thumbnail" required>
        </div>
      </div>
    </div>
    <div class="col-lg-2">
      <h5>Use <a href="http://imgur.com">Imgur</a> for images</h5>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 text-right"></div>
    <div class="col-lg-8">
      <div class="row text-center">
        <div class="col-lg-4">
          <h4>PDF</h4>
          <input type="url" class="form-control" placeholder="PDF URL" name="pdf" required>
        </div>
        <div class="col-lg-4">
          <h4>PPT</h4>
          <input type="url" class="form-control" placeholder="PPT URL" name="ppt" required>
        </div>
        <div class="col-lg-4">
          <h4>ZIP</h4>
          <input type="url" class="form-control" placeholder="ZIP URL" name="zip">
        </div>
      </div>
    </div>
    <div class="col-lg-2">
      <h5>Use <a href="http://drive.google.com">Google Drive</a> or <a href="http://dropbox.com">Dropbox</a> for Documents</h5>
    </div>
  </div>
</div>

<br>
<div class="container">
  <div class="row">
    <div class="col-lg-2 text-right">
      <h4>Participants</h4>
    </div>
    <div class="col-lg-8">
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
              <tr>
                <td><input class="form-control" type="text" name="part_1_name" required autocomplete="off"></td>
                <td><input class="form-control" type="email" name="part_1_email" required autocomplete="off"></td>
                <td><input class="form-control" type="text" name="part_1_enrollment" required autocomplete="off"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <input type="hidden" class="hide" id="total-part" name="total_part" value="1" autocomplete="off">
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
    <div class="col-lg-2 text-right">
      <h4>Final</h4>
    </div>
    <div class="col-lg-8">
      <button type="submit" class="btn btn-success btn-block">Submit this project</button>
    </div>
    <div class="col-lg-2">
      <h5>Best of luck. Bright future ahead!</h5>
    </div>
  </div>
</div>

</form>
@stop