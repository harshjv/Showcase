@extends('base')

@section('title')
Add Project - Sarvajanik College of Engineering and Technology - Showcase
@stop


@section('javascript')
<script src="/assets/vendor/js/jquery.ui.widget.js"></script>
<script src="/assets/vendor/js/jquery.iframe-transport.js"></script>
<script src="/assets/vendor/js/jquery.fileupload.js"></script>
<script src="/assets/js/script.js"></script>
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
      <h5>This project belongs to this department</h5>
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
      <h4 class="text-center" id="thumbnail_title" style="display:none"><small>Thumbnail</small></h4>
      <img src="" style="display:none" id="thumbnail_view" class="img-thumbnail">
    </div>
    <div class="col-lg-8">
      <input type="text" class="form-control" placeholder="Youtube Video URL" name="youtube">
      <br>
      <div class="row text-center">
        <div class="col-lg-6">
          <h4>Image</h4>
          <h4><small>Should be 1000x300px</small></h4>
          <input id="upload_image" type="file" name="image" data-url="/upload/image" autocomplete="off">
          <div id="image_helper"></div>
          <input type="hidden" name="image_file" id="image_file" autocomplete="off" value="0">
        </div>
        <div class="col-lg-6">
          <h4>Thumbnail <small>Or i will create it</small></h4>
          <h4><small>Should be 200x200px</small></h4>
          <input id="upload_thumbnail" type="file" name="thumbnail" data-url="/upload/thumbnail" autocomplete="off">
          <div id="thumbnail_helper"></div>
          <input type="hidden" name="thumbnail_file" id="thumbnail_file" autocomplete="off" value="0">
        </div>
      </div>
      <br>
      <div class="row text-center">
        <div class="col-lg-4">
          <h4>PDF</h4>
          <input id="upload_pdf" type="file" name="pdf" data-url="/upload/pdf" autocomplete="off">
          <div id="pdf_helper"></div>
          <input type="hidden" name="pdf_file" id="pdf_file" autocomplete="off" value="0">
        </div>
        <div class="col-lg-4">
          <h4>PPT</h4>
          <input id="upload_ppt" type="file" name="ppt" data-url="/upload/ppt" autocomplete="off">
          <div id="ppt_helper"></div>
          <input type="hidden" name="ppt_file" id="ppt_file" autocomplete="off" value="0">
        </div>
        <div class="col-lg-4">
          <h4>ZIP</h4>
          <input id="upload_zip" type="file" name="zip" data-url="/upload/zip" autocomplete="off">
          <div id="zip_helper"></div>
          <input type="hidden" name="zip_file" id="zip_file" autocomplete="off" value="0">
        </div>
      </div>
    </div>
    <div class="col-lg-2">
      <h5>Max. file size <abbr title="50MB" style="cursor:help">2<sup>22</sup> x 5<sup>2</sup> Nibble</abbr> for documents</h5>
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
    <div class="col-lg-2">
      <h5>Max. 4 participants</h5>
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