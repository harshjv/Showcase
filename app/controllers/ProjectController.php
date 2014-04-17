<?php

class ProjectController extends BaseController {

  public function add() {
    $departments = Cache::rememberForever('departments', function() {
      return Department::all();
    });
    return View::make('project.add', compact('departments'));
  }

  public function view($id) {
    $project = Project::with('users', 'department')->where('projects.id', $id)->firstOrFail();
    return View::make('project.view', compact('project'));
  }

  public function doAdd() {

    $project = null;

    DB::transaction(function() use(&$project) {

    $dep = Department::find((int) Input::get('department'));

    $project = new Project();
    $project->title = ucfirst(Input::get('title'));
    $project->subtitle = ucfirst(Input::get('subtitle', null));
    $project->description = nl2br(htmlentities(ucfirst(Input::get('description'))));
    $project->youtube = Input::get('youtube');
    $project->image = Input::get('image_file');
    $project->thumbnail = Input::get('thumbnail_file');
    $project->pdf = Input::get('pdf_file', null);
    $project->ppt = Input::get('ppt_file', null);
    $project->zip = Input::get('zip_file', null);
    $project->department()->associate($dep);
    $project->save();

    $t = (int) Input::get('total_part');
    $i=1;

    while($i!=($t+1)) {
      //$dep = Department::find((int) Input::get('part_'.$i.'_department'));
      $user = new User();
      $user->name = ucwords(Input::get('part_'.$i.'_name'));
      $user->email = strtolower(Input::get('part_'.$i.'_email'));
      $user->enrollment = strtoupper(Input::get('part_'.$i.'_enrollment'));
      //$user->department()->associate($dep);
      $user->project()->associate($project);
      $user->save();
      $i++;
    }

    });

    return Redirect::route('view_project', array($project->id));

  }

  public function upload() {

    $allowedExt = array('pdf', 'ppt', 'zip');

    $file = Input::file('file');
    $webPath = 'documents/'.date('Y/m');
    $path = public_path($webPath);
    $result = array();

    try {
      File::makeDirectory($path, 0777, true, true);
    }
    catch (\Exception $e) {
      // Dir Exist
    }

    //foreach ($files as $file) {
    $ext = strtolower($file->getClientOriginalExtension());
    if(in_array($ext, $allowedExt)) {
      $file_name = uniqid(rand(), true).'.'.$ext;
      $file->move($path, $file_name);
      $name = $path .'/'. $file_name;
      $result[] = compact('name');
      return array('success' => true, 'file' => $webPath.'/'.$file_name);
    }
    else {
      return array('success' => false);
    }
    
  }

  public function uploadImage() {

    $allowedExt = array('png', 'jpg', 'jpeg');

    $file = Input::file('image');
    $webPath = 'documents/'.date('Y/m');
    $path = public_path($webPath);
    $result = array();

    try {
      File::makeDirectory($path, 0777, true, true);
    }
    catch (\Exception $e) {
      // Dir Exist
    }

    $ext = strtolower($file->getClientOriginalExtension());
    if(in_array($ext, $allowedExt)) {
      $file_name = uniqid(rand(), true).'.'.$ext;
      $thumbnail_name = uniqid(rand(), true).'.'.$ext;

      Image::make($file->getRealPath())->crop(300,200)->save($path.'/'.$thumbnail_name);

      $file->move($path, $file_name);

      $name = $webPath .'/'. $file_name;
      $thumbnail = $webPath .'/'.$thumbnail_name;

      $result[] = compact('name');
      return array('success' => true, 'file' => $name, 'thumbnail' => $thumbnail);
    }
    else {
      return array('success' => false);
    }
    
  }

  public function uploadPDF() {

    $file = Input::file('pdf');
    $webPath = 'documents/'.date('Y/m');
    $path = public_path($webPath);
    $result = array();

    try {
      File::makeDirectory($path, 0777, true, true);
    }
    catch (\Exception $e) {
      // Dir Exist
    }

    $ext = strtolower($file->getClientOriginalExtension());
    if($ext == "pdf") {
      $file_name = uniqid(rand(), true).'.'.$ext;
      $file->move($path, $file_name);
      $name = $path .'/'. $file_name;
      $result[] = compact('name');
      return array('success' => true, 'file' => $webPath.'/'.$file_name);
    }
    else {
      return array('success' => false);
    }
    
  }

  public function uploadPPT() {

    $file = Input::file('ppt');
    $webPath = 'documents/'.date('Y/m');
    $path = public_path($webPath);
    $result = array();

    try {
      File::makeDirectory($path, 0777, true, true);
    }
    catch (\Exception $e) {
      // Dir Exist
    }

    $ext = strtolower($file->getClientOriginalExtension());
    if($ext == "ppt") {
      $file_name = uniqid(rand(), true).'.'.$ext;
      $file->move($path, $file_name);
      $name = $path .'/'. $file_name;
      $result[] = compact('name');
      return array('success' => true, 'file' => $webPath.'/'.$file_name);
    }
    else {
      return array('success' => false);
    }
    
  }

  public function uploadZIP() {

    $file = Input::file('zip');
    $webPath = 'documents/'.date('Y/m');
    $path = public_path($webPath);
    $result = array();

    try {
      File::makeDirectory($path, 0777, true, true);
    }
    catch (\Exception $e) {
      // Dir Exist
    }

    $ext = strtolower($file->getClientOriginalExtension());
    if($ext == "zip") {
      $file_name = uniqid(rand(), true).'.'.$ext;
      $file->move($path, $file_name);
      $name = $path .'/'. $file_name;
      $result[] = compact('name');
      return array('success' => true, 'file' => $webPath.'/'.$file_name);
    }
    else {
      return array('success' => false);
    }
    
  }

}