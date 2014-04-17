<?php

class Department extends Eloquent {

  protected $table = 'departments';

  public function projects() {
    return $this->hasMany('Project');
  }

  public function setNameAttribute($name) {
    $this->attributes['name'] = $name;
    $this->slug = Str::slug($name);
  }

}