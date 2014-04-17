<?php

class ProjectController extends BaseController {

  public function add() {
    $title = "Add project - Sarvajanik College of Engineering and Technology";
    $departments = Cache::rememberForever('departments', function() {
      return Department::all();
    });
    return View::make('project.add', compact('departments', 'title'));
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

    $project = new Project();
    $project->title = ucfirst(trim(Input::get('title')));
    $project->subtitle = ucfirst(trim(Input::get('subtitle', null)));
    $project->description_raw = ($desc = ucfirst(trim(Input::get('description'))));
    $project->description = nl2br(htmlentities($desc));
    $project->video = trim(Input::get('video'));
    $project->image_1 = trim(Input::get('image_1'));
    $project->image_2 = trim(Input::get('image_2'));
    $project->image_3 = trim(Input::get('image_3'));
    $project->thumbnail = trim(Input::get('thumbnail'));
    $project->pdf = trim(Input::get('pdf'));
    $project->ppt = trim(Input::get('ppt'));
    $project->zip = trim(Input::get('zip', null));
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

    //$project = new Project();
    $project->title = ucfirst(trim(Input::get('title')));
    $project->subtitle = ucfirst(trim(Input::get('subtitle', null)));
    $project->description_raw = ($desc = ucfirst(trim(Input::get('description'))));
    $project->description = nl2br(htmlentities($desc));
    $project->video = trim(Input::get('video'));
    $project->image_1 = trim(Input::get('image_1'));
    $project->image_2 = trim(Input::get('image_2'));
    $project->image_3 = trim(Input::get('image_3'));
    $project->thumbnail = trim(Input::get('thumbnail'));
    $project->pdf = trim(Input::get('pdf'));
    $project->ppt = trim(Input::get('ppt'));
    $project->zip = trim(Input::get('zip', null));
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

}