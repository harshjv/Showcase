@extends('base')

@section('body')
<div class="container-fluid title-box">
  <h3>Recent projects <span class="text-muted">in</span> <a href="{{ route('view_department', array($department->slug)) }}">{{ $department->name }}</a></h3>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title no-margin-bottom">Departments</h4>
        </div>
        <div class="list-group">
          @foreach($departments as $dep)
            <a class="list-group-item {{ ($dep->id==$department->id) ? 'active' : '' }}" href="{{ route('view_department', array($dep->slug)) }}">{{ $dep->name }}</a>
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-lg-10">
      <div class="row">
        @foreach($projects as $project)
          <div class="col-lg-3">
            <div class="thumbnail">
              <img src="{{ asset($project->thumbnail) }}" alt="{{ $project->title }}">
              <div class="caption">
                <h3><a href="{{ route('view_project', array($project->id)) }}">{{ $project->title }}</a></h3>
                @if($project->subtitle)
                <h5 class="text-muted no-margin-bottom">{{ $project->subtitle }}</h5>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@if($total_projects > $projects_per_page)
<div class="container">
<ul class="pagination">
  @if($page!=1)
    <li><a href="{{ route('view_department', array($department->slug, $page - 1)) }}"><i class="fa fa-angle-left"></i></a></li>
  @endif
  @if($page!=ceil($total_projects/$projects_per_page))
    <li><a href="{{ route('view_department', array($department->slug, $page + 1)) }}"><i class="fa fa-angle-right"></i></a></li>
  @endif
</ul>
</div>
@endif
@stop