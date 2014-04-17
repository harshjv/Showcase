<?php

class ShowcaseController extends BaseController {

  public function show($page = 1) {

    $projects_per_page = Config::get('showcase.projects_per_page');
    $projects = Project::with('department')->paginatedWithSorted($projects_per_page, $page)->get();
    $total_projects = Project::count();

    if(count($projects) == 0) return View::make('showcase.zero', array('message' => 'Sorry', 'submessage' => 'Nothing to display'));

    return View::make('showcase.show', compact('projects', 'total_projects', 'page', 'projects_per_page'));
  }

  public function search() {

    $search_term = Input::get('q');
    $page = Input::get('p', 1);

    if(is_null($search_term)) return Redirect::route('showcase');

    $projects_per_page = Config::get('showcase.projects_per_page');
    $p = Project::buildSearch($search_term);
    $p_count = clone $p;

    $projects = $p->paginatedWithSorted($projects_per_page, $page)->get();

    if(count($projects) == 0) return View::make('showcase.zero');

    $total_projects = $p_count->count();

    return View::make('showcase.search', compact('projects', 'total_projects', 'page', 'projects_per_page', 'search_term'));

  }

  public function department($slug, $page = 1) {
    $projects_per_page = Config::get('showcase.projects_per_page');

    $department = Department::with(array('projects' => function($project) use($projects_per_page, $page) {
      $project->with('users')->paginatedWithSorted($projects_per_page, $page);
    }))->where('departments.slug', $slug)->firstOrFail();

    $total_projects = Project::where('projects.department_id', $department->id)->count();

    $projects = $department->projects;

    if(count($projects) == 0) return View::make('showcase.zero', array('message' => 'Sorry', 'submessage' => 'Nothing to display in '.$department->name));

    return View::make('showcase.department', compact('department', 'projects', 'total_projects', 'page', 'projects_per_page'));
  }

  public function success() {
    if( ! Session::has('project_success')) return Redirect::route('edit');
    $data = Session::get('project_success');
    $title = $data['message'] . ' - Sarvajanik College of Engineering and Technology - Showcase';
    return View::make('project.success', compact('data', 'title'));
  }

}