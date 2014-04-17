@extends('base')

@section('title')
{{ ucwords($search_term) }} - Search - Sarvajanik College of Engineering and Technology - Showcase
@stop

@section('body')
<div class="container-fluid title-box">
  <h3>Search Result</h3>
</div>
<div class="container">
  <div class="row">
    @foreach($projects as $project)
    <div class="col-lg-3">
      <div class="thumbnail">
        <img src="/{{ $project->thumbnail }}" alt="{{ $project->title }}">
        <div class="caption">
          <h3><a href="{{ route('view_project', array($project->id)) }}">{{ $project->title }}</a></h3>
          @if($project->subtitle)
          <h5 class="text-muted">{{ $project->subtitle }}</h5>
          @endif
          <h4 class="no-margin-bottom">In <a href="{{ route('view_department', array($project->department->slug)) }}">{{ $project->department->name }}</a></h4>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@if($total_projects > $projects_per_page)
<div class="container">
<ul class="pagination">
  @if($page!=1)
    <li><a href="{{ route('search', array('p' => $page - 1, 'q' => $search_term)) }}"><i class="fa fa-angle-left"></i></a></li>
  @endif
  @if($page!=ceil($total_projects/$projects_per_page))
    <li><a href="{{ route('search', array('p' => $page + 1, 'q' => $search_term)) }}"><i class="fa fa-angle-right"></i></a></li>
  @endif
</ul>
</div>
@endif
@stop