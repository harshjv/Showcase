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
      $table->text('description_raw');

      $table->string('video');

      $table->string('image_1');
      $table->string('image_2');
      $table->string('image_3');
      $table->string('thumbnail')->nullable();

      $table->string('pdf');
      $table->string('ppt');
      $table->string('zip')->nullable();

      $table->string('code')->unique();

      $table->integer('department_id')->unsigned();
      $table->foreign('department_id')->references('id')->on('departments');

      $table->string('name_1');
      $table->string('email_1');
      $table->string('enrollment_1');

      $table->string('name_2')->nullable();
      $table->string('email_2')->nullable();
      $table->string('enrollment_2')->nullable();

      $table->string('name_3')->nullable();
      $table->string('email_3')->nullable();
      $table->string('enrollment_3')->nullable();

      $table->string('name_4')->nullable();
      $table->string('email_4')->nullable();
      $table->string('enrollment_4')->nullable();

      $table->smallInteger('total_participants');

      $table->timestamps();
    });

  }

  public function down() {
    Schema::drop('projects');
    Schema::drop('departments');
  }

}
