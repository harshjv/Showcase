<?php

class ProjectController extends BaseController {

  public function add() {
    $title = "Add project - ".Config::get('showcase.title');
    return View::make('project.add', compact('title'));
  }

  public function addCheck() {
    try {
      $department = Department::where('code', trim(Input::get('department_code')))->firstOrFail();
    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      return View::make('error', array('message' => 'Wrong Department Code', 'submessage' => 'Ask your faculty'));
    }
    return View::make('project.do_add', compact('project', 'department'));
  }

  public function doAdd() {
    $project = Project::addProject();
    if($project === false) return View::make('error', array('message' => '404', 'submessage' => 'Page not found'));
    Session::flash('project_success', array('message' => 'Project added successfully', 'id' => $project->id, 'code' => $project->code));
    return Redirect::route('success');
  }

  public function edit() {
    $title = "Edit project - ".Config::get('showcase.title');
    return View::make('project.edit', compact('title'));
  }

  public function editCheck() {
    try {
      $project = Project::with('department')->where('id', trim(Input::get('project_id')))->where('code', trim(Input::get('project_code')))->firstOrFail();
    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      return View::make('error', array('message' => 'Wrong Code/ID', 'submessage' => 'Check your mail'));
    }
    return View::make('project.do_edit', compact('project'));
  }

  public function doEdit() {
    $project = Project::editProject();
    //$p = $project->toArray();

    /*
    foreach ($emails as $email) {
      Mail::queue('emails.update', array('project' => $p), function($message) use($email) {
        $message->from('showcase_scet@gmail.com', 'Showcase - Sarvajanik College of Engineering and Technology');
        $message->to($email);
        $message->subject('Showcase - Project Updated');
      });
    }
    */

    Session::flash('project_success', array('message' => 'Project updated successfully', 'id' => $project->id, 'code' => $project->code));
    Session::flash('alert', '<strong>Heads Up!</strong> The code is changed after every successful update, so do note it again.');

    return Redirect::route('success');
  }

  public function doUpload() {
    $file = Input::file('file');
    $destinationPath = public_path().'/documents';

    $folder = str_random(5);

    if( ! File::exists($destinationPath.'/'.$folder)) {
      try {
        File::makeDirectory($destinationPath.'/'.$folder);
      } catch(IOException $e) {
        // FAIL
      }
    }

    $filename = str_random(6).uniqid().str_random(6).'.'.$file->getClientOriginalExtension();
    $upload_success = $file->move($destinationPath.'/'.$folder, $filename);
    if($upload_success) {
      return Response::json(array('success' => 200, 'path' => '/documents'.'/'.$folder.'/'.$filename));
    } else {
      return Response::json('error', 400);
    }
  }

  public function doRemove() {
    $file = public_path() . Input::get('name');

    if(File::exists($file) && File::isFile($file)) {
      if(File::delete($file)) {
        return Response::json(array('status' => 200));
      }
      else return Response::json(array('status' => 500));
    }

    return Response::json(array('status' => 500));
  }

}