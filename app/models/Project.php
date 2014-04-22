<?php

class Project extends Eloquent {

  protected $table = 'projects';

  public function department() {
    return $this->belongsTo('Department');
  }

  public function getUserStringAttribute() {
    $users = $this->relations['users'];
    $t = count($users);
    $i = 1;
    $string = "";
    foreach ($users as $user) {
      $string.=$user->name;
      if($i!=$t) {
        if($i==($t-1)) $string.=" <small>&amp;</small> ";
        else $string.=", ";
      }
      $i++;
    }
    return $string;
  }

  public function scopeBuildSearch($query, $search_term) {
    $vals = $this->prepareQuery($search_term);
    $first = true;
    foreach ($vals as $val) {
      if($first) {
        $query->where('projects.title', 'like', $val);
        $first = false;
      }
      else {
        $query->orWhere('projects.title', 'like', $val);
      }
    }
    return $query;
  }

  public function scopePaginatedWithSorted($query, $projects_per_page, $page) {
    return $query->orderBy('id', 'DESC')->take($projects_per_page)->skip($projects_per_page*($page-1));
  }

  private function prepareQuery($search_term) {
    $ta = array_unique(explode(" ", trim($search_term)));

    $terms_to_be_removed = array('i', 'am', 'is', 'are');

    $vals = array_values(array_diff($ta, $terms_to_be_removed));

    if(count($vals)==0) $vals = $ta;

    array_walk($vals, function(&$v) {
      $v = '%'.$v.'%';
    });

    return $vals;
  }

  public function getDocumentStringAttribute() {
    $s = $this->pdf.",".$this->image_1.",".$this->image_2.",".$this->image_3;
    if($this->zip) $s.=",".$this->zip;
    return $s;
  }

  public static function addProject() {
    $project = false;
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

    while($i<=$t) {
      $project->attributes['name_'.$i] = ucwords(trim(Input::get('part_'.$i.'_name')));
      $project->attributes['email_'.$i] = strtolower(trim(Input::get('part_'.$i.'_email')));
      $project->attributes['enrollment_'.$i] = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      $i++;
    }

    $project->save();

    });

    return $project;
  }

  public static function editProject() {
    $project = Project::where('code', trim(Input::get('project_code')))->firstOrFail();

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

    while($i<=$t) {
      $project->attributes['name_'.$i] = ucwords(trim(Input::get('part_'.$i.'_name')));
      $project->attributes['email_'.$i] = strtolower(trim(Input::get('part_'.$i.'_email')));
      $project->attributes['enrollment_'.$i] = strtoupper(trim(Input::get('part_'.$i.'_enrollment')));
      $i++;
    }

    $project->save();

    });

    return $project;
  }

  public function getParticipantEmailsAttribute() {
    $emails = array();
    $t = $this->total_participants;
    $i=1;
    while($i<=$t) {
      $emails[] = $this->attributes['email_'.$i];
      $i++;
    }
    return $emails;
  }

}