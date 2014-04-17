@extends('base')

@section('title')
{{ $project->title }} {{ ($project->subtitle) ? '- '.$project->subtitle.' ' : '' }}- Sarvajanik College of Engineering and Technology - Showcase
@stop

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
        <img src="/{{ $project->image }}" style="border-bottom: 1px solid #ddd;max-width:100%;height:auto;display:inline-block">
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
        @if($project->youtube)
        <img src="holder.js/100%x400/text:Video" style="border-bottom: 1px solid #ddd">
        @endif
        @if($project->pdf || $project->ppt || $project->zip)
        <div class="panel-body">
          <div class="row text-center">
            @if($project->pdf)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <h3><a href="{{ asset($project->pdf) }}" target="_blank">PDF</a> <sup class="fa fa-external-link small"></sup></h3>
            </div>
            @endif
            @if($project->ppt)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <h3><a href="{{ asset($project->ppt) }}" target="_blank">PPT</a> <sup class="fa fa-external-link small"></sup></h3>
            </div>
            @endif
            @if($project->zip)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <h3><a href="{{ asset($project->zip) }}" target="_blank">ZIP</a> <sup class="fa fa-external-link small"></sup></h3>
            </div>
            @endif
          </div>
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
            @foreach($project->users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                <td>{{ $user->enrollment }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop