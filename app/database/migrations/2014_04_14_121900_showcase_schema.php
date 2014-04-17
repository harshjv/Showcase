<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShowcaseSchema extends Migration {

  public function up() {

    Schema::create('departments', function($table) {
      $table->increments('id')->unsigned();
      $table->string('name');
      $table->string('slug')->unique();
      $table->timestamps();
    });

    Schema::create('projects', function($table) {
      $table->increments('id')->unsigned();
      $table->string('title');
      $table->string('subtitle')->nullable();
      $table->text('description');
      $table->string('youtube')->nullable();
      $table->string('image')->nullable();
      $table->string('thumbnail')->nullable();
      $table->string('pdf')->nullable();
      $table->string('ppt')->nullable();
      $table->string('zip')->nullable();
      $table->integer('department_id')->unsigned();
      $table->foreign('department_id')->references('id')->on('departments');
      $table->timestamps();
    });

    Schema::create('users', function($table) {
      $table->increments('id')->unsigned();
      $table->string('name');
      $table->string('email');
      $table->string('enrollment');
      $table->integer('project_id')->unsigned();
      $table->foreign('project_id')->references('id')->on('projects');
      $table->timestamps();
    });

  }

  public function down() {
    Schema::drop('users');
    Schema::drop('projects');
    Schema::drop('departments');
  }

}
