@extends('base')

@section('body')
<div class="container-fluid title-box">
  <h1><a href="{{ route('view_project', array($project->id)) }}">{{ $project->title }}</a></h1>
  @if($project->subtitle)
  <h4>{{ $project->subtitle }}</h4>
  @endif
  <h4>In <a href="{{ route('view_department', array('slug' => $project->department->slug)) }}">{{ $project->department->name }}</a></h4>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-2 text-right">
      <h4>Description</h4>
    </div>
    <div class="col-lg-8">
      <div class="panel panel-default">
        <div id="project-images" class="carousel slide" data-ride="carousel" style="border-bottom: 1px solid #ddd">
          <ol class="carousel-indicators">
            <li data-target="#project-images" data-slide-to="0" class="active"></li>
            <li data-target="#project-images" data-slide-to="1"></li>
            <li data-target="#project-images" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="item active">
              <img src="{{ asset($project->image_1) }}" alt="{{ $project->title }}">
            </div>
            <div class="item">
              <img src="{{ asset($project->image_2) }}" alt="{{ $project->title }}">
            </div>
            <div class="item">
              <img src="{{ asset($project->image_3) }}" alt="{{ $project->title }}">
            </div>
          </div>
          <a class="left carousel-control" href="#project-images" data-slide="prev">
            <span class="fa fa-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#project-images" data-slide="next">
            <span class="fa fa-chevron-right"></span>
          </a>
        </div>
        <div class="panel-body desc-show">
          {{ $project->description }}
        </div>
      </div>
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
      <div class="panel panel-default">
        @if($project->video)
        <img src="holder.js/100%x400/text:Video" style="border-bottom: 1px solid #ddd">
        @endif
        @if( ! is_null($project->zip))
        <div class="panel-body text-center">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <h3><a href="{{ asset($project->pdf) }}" target="_blank">PDF</a> <sup class="fa fa-external-link small"></sup></h3>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <h3><a href="{{ asset($project->zip) }}" target="_blank">ZIP</a> <sup class="fa fa-external-link small"></sup></h3>
            </div>
          </div>
        </div>
        @else
        <div class="panel-body text-center">
          <h3><a href="{{ asset($project->pdf) }}" target="_blank">PDF</a> <sup class="fa fa-external-link small"></sup></h3>
        </div>
        @endif

      </div>
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
            <tbody>
              <?php $u = $project->total_participants; $i=1; ?>
            @while($i<=$u)
              <tr>
                <td>{{ $project['name_'.$i] }}</td>
                <td><a href="mailto:{{ $project['email_'.$i] }}">{{ $project['email_'.$i] }}</a></td>
                <td>{{ $project['enrollment_'.$i] }}</td>
              </tr>
              <?php $i++; ?>
            @endwhile
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<br>
<div class="container text-right">
  <p>Added {{ $project->created_at->diffForHumans() }}</p>
</div>
@stop