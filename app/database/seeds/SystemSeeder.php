<?php

class SystemSeeder extends Seeder {

  public function run() {
    Eloquent::unguard();

    DB::table('departments')->delete();
    DB::table('projects')->delete();

    $dep = new Department();
    $dep->name = "Computer Engineering";
    $dep->code = str_random(2).uniqid().str_random(2);
    $dep->save();

    $dep = new Department();
    $dep->name = "Civil Engineering";
    $dep->code = str_random(2).uniqid().str_random(2);
    $dep->save();

    $dep = new Department();
    $dep->name = "Electrical Engineering";
    $dep->code = str_random(2).uniqid().str_random(2);
    $dep->save();

    $dep = new Department();
    $dep->name = "IT Engineering";
    $dep->code = str_random(2).uniqid().str_random(2);
    $dep->save();

    $dep = new Department();
    $dep->name = "Chemical Engineering";
    $dep->code = str_random(2).uniqid().str_random(2);
    $dep->save();

    $dep = new Department();
    $dep->name = "Instruments &amp; Control Engineering";
    $dep->code = str_random(2).uniqid().str_random(2);
    $dep->save();

    $dep = new Department();
    $dep->name = "Textile Engineering";
    $dep->code = str_random(2).uniqid().str_random(2);
    $dep->save();
  }

}