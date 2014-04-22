<?php

class ProjectController extends BaseController {

  public function add() {
    $title = "Add project - Sarvajanik College of Engineering and Technology";
    $departments = Cache::rememberForever('departments', function() {
      return Department::all();
    });
    return View::make('project.add', compact('departments', 'title'));
  }

  public function addDropZone() {
    $title = "Add project - Sarvajanik College of Engineering and Technology";
    $departments = Cache::rememberForever('departments', function() {
      return Department::all();
    });
    return View::make('project.addDropZone', compact('departments', 'title'));
  }

  public function edit() {
    return View::make('project.edit');
  }

  public function editCheck() {
    $departments = Cache::rememberForever('departments', function() {
      return Department::all();
    });
    try {
      $project = Project::with('department')->where('code', trim(Input::get('code')))->firstOrFail();
    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      return View::make('showcase.zero', array('message' => 'Wrong Code', 'submessage' => 'Check your mail'));
    }
    return View::make('project.do_edit', compact('project', 'departments'));
  }

  public function view($id) {
    try {
      $project = Project::with('department')->where('projects.id', $id)->firstOrFail();
    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      return View::make('showcase.zero', array('message' => '404', 'submessage' => 'Page not found'));
    }
    $title = $project->title . " - " . (($project->subtitle) ? $project->subtitle . " - " : '') . "Sarvajanik College of Engineering and Technology - Showcase";
    return View::make('project.view', compact('project', 'title'));
  }

  public function doAdd() {

    $project = null;

    DB::transaction(function() use(&$project) {

    $dep = Department::find((int) Input::get('department'));

    $a = explode(',', trim(Input::get('documents')));

    $images = array();
    $pdf = null;
    $zip = null;

    foreach ($a as $val) {
      if(ends_with($val, 'pdf')) {
        $pdf = $val;
      }
      if(ends_with($val, 'zip')) {
        $zip = $val;
      }
      if(ends_with($val, 'jpg') || ends_with($val, 'jpeg') || ends_with($val, 'png')) {
        $images[] = $val;
      }
    }

    $project = new Project();
    $project->title = ucfirst(trim(Input::get('title')));
    $project->subtitle = ucfirst(trim(Input::get('subtitle', null)));
    $project->description_raw = ($desc = ucfirst(trim(Input::get('description'))));
    $project->description = nl2br(htmlentities($desc));
    $project->video = trim(Input::get('video'));

    $project->image_1 = $images[0];
    $project->image_2 = $images[1];
    $project->image_3 = $images[2];

    $destinationPath = public_path().'/documents';
    $folder = str_random(5);
    $filename = str_random(6).uniqid().str_random(6).'.'.pathinfo($images[0], PATHINFO_EXTENSION);

    if( ! File::exists($destinationPath.'/'.$folder)) {
      try {
        File::makeDirectory($destinationPath.'/'.$folder);
      } catch(IOException $e) {
        // FAIL
      }
    }

    $image = Image::make(public_path().'/'.$images[0])->crop(300,300)->save($destinationPath.'/'.$folder.'/'.$filename);

    $project->thumbnail = '/documents/'.$folder.'/'.$filename;
    $project->pdf = $pdf;
    $project->zip = $zip;

    $project->code = uniqid(md5(rand()));
    $project->total_participants = (int) trim(Input::get('total_part'));
    $project->department()->associate($dep);

    $t = (int) Input::get('total_part') + 1;
    $i=1;

    while($i!=$t) {
      if($i==1) {
        $project->name_1 = ucwords(trim(Input::get('part_'.$i.'_name')));
        $project->email_1 = strtolower(trim(Input::get('part_'.$i.'_email')));
        $project->enrollment_1 = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      }
      if($i==2) {
        $project->name_2 = ucwords(trim(Input::get('part_'.$i.'_name')));
        $project->email_2 = strtolower(trim(Input::get('part_'.$i.'_email')));
        $project->enrollment_2 = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      }
      if($i==3) {
        $project->name_3 = ucwords(trim(Input::get('part_'.$i.'_name')));
        $project->email_3 = strtolower(trim(Input::get('part_'.$i.'_email')));
        $project->enrollment_3 = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      }
      if($i==4) {
        $project->name_4 = ucwords(trim(Input::get('part_'.$i.'_name')));
        $project->email_4 = strtolower(trim(Input::get('part_'.$i.'_email')));
        $project->enrollment_4 = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      }
      $i++;
    }

    $project->save();

    });

    Session::flash('project_success', array('message' => 'Project added successfully', 'id' => $project->id, 'code' => $project->code));

    return Redirect::route('success');

  }

  public function doEdit() {
    $project = Project::find(Input::get('project_id'));
    $emails = array();

    DB::transaction(function() use(&$project, &$emails) {

    $dep = Department::find((int) Input::get('department'));

    $a = explode(',', trim(Input::get('documents')));

    $images = array();
    $pdf = null;
    $zip = null;

    foreach ($a as $val) {
      if(ends_with($val, 'pdf')) {
        $pdf = $val;
      }
      if(ends_with($val, 'zip')) {
        $zip = $val;
      }
      if(ends_with($val, 'jpg') || ends_with($val, 'jpeg') || ends_with($val, 'png')) {
        $images[] = $val;
      }
    }

    //$project = new Project();
    $project->title = ucfirst(trim(Input::get('title')));
    $project->subtitle = ucfirst(trim(Input::get('subtitle', null)));
    $project->description_raw = ($desc = ucfirst(trim(Input::get('description'))));
    $project->description = nl2br(htmlentities($desc));
    $project->video = trim(Input::get('video'));
    $project->image_1 = $images[0];
    $project->image_2 = $images[1];
    $project->image_3 = $images[2];

    $destinationPath = public_path().'/documents';
    $folder = str_random(5);
    $filename = str_random(6).uniqid().str_random(6).'.'.pathinfo($images[0], PATHINFO_EXTENSION);

    if( ! File::exists($destinationPath.'/'.$folder)) {
      try {
        File::makeDirectory($destinationPath.'/'.$folder);
      } catch(IOException $e) {
        // FAIL
      }
    }

    $image = Image::make(public_path().'/'.$images[0])->crop(300,300)->save($destinationPath.'/'.$folder.'/'.$filename);

    $project->thumbnail = '/documents/'.$folder.'/'.$filename;
    $project->pdf = $pdf;
    $project->zip = $zip;
    $project->code = uniqid(md5(rand()));
    $project->total_participants = (int) trim(Input::get('total_part'));
    $project->department()->associate($dep);

    $t = (int) Input::get('total_part') + 1;
    $i=1;

    while($i!=$t) {
      if($i==1) {
        $project->name_1 = ucwords(trim(Input::get('part_'.$i.'_name')));
        $project->email_1 = ($emails[] = strtolower(trim(Input::get('part_'.$i.'_email'))));
        $project->enrollment_1 = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      }
      if($i==2) {
        $project->name_2 = ucwords(trim(Input::get('part_'.$i.'_name')));
        $project->email_2 = ($emails[] = strtolower(trim(Input::get('part_'.$i.'_email'))));
        $project->enrollment_2 = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      }
      if($i==3) {
        $project->name_3 = ucwords(trim(Input::get('part_'.$i.'_name')));
        $project->email_3 = ($emails[] = strtolower(trim(Input::get('part_'.$i.'_email'))));
        $project->enrollment_3 = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      }
      if($i==4) {
        $project->name_4 = ucwords(trim(Input::get('part_'.$i.'_name')));
        $project->email_4 = ($emails[] = strtolower(trim(Input::get('part_'.$i.'_email'))));
        $project->enrollment_4 = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      }
      $i++;
    }

    $project->save();

    });

    $p = $project->toArray();

    foreach ($emails as $email) {
      Mail::queue('emails.update', array('project' => $p), function($message) use($email) {
        $message->from('showcase_scet@gmail.com', 'Showcase - Sarvajanik College of Engineering and Technology');
        $message->to($email);
        $message->subject('Showcase - Project Updated');
      });
    }

    Session::flash('project_success', array('message' => 'Project updated successfully', 'id' => $project->id, 'code' => $project->code));
    Session::flash('alert', '<strong>Heads Up!</strong> The code is changed after every successful update, so do note it again.');

    return Redirect::route('success');
  }

  public function doUpload() {
    $file = Input::file('file');
    $destinationPath = public_path().'/documents';

    //$folder = $destinationPath.'/'.str_random(5);

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

    return Response::json(array('status' => 200));
  }

  public function invokeProject() {
    $id = Session::get('showcase_invoke_project_id', false);
    if($id) {
      $project = TempProject::find($id);
      return Response::json(array('fresh' => false, 'fortune' => $project->toArray()));
    }
    else {
      $project = new TempProject();
      $project->save();
      Session::set('showcase_invoke_project_id', $project->id);
      return Response::json(array('fresh' => true, 'fortune' => $project->toArray()));
    }
  }

  public function updateTemp() {
    $fortune = Session::get('showcase_invoke_project_id');
    $project = TempProject::where('fortune', $fortune)->firstOrFail();

    //return Response::json(array('fresh' => false, 'fortune' => $project->toArray()));
  }

}