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



}