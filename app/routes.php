<?php

Route::pattern('page', '[0-9]+');
Route::pattern('id', '[0-9]+');

Route::get('/{page?}', array('as' => 'showcase', 'uses' => 'ShowcaseController@show'));

Route::get('add', array('as' => 'add', 'uses' => 'ProjectController@add'));

Route::get('search', array('as' => 'search', 'uses' => 'ShowcaseController@search'));

Route::post('add', array('before' =>'csrf', 'as' => 'do_add', 'uses' => 'ProjectController@doAdd'));

Route::get('project/{id}', array('as' => 'view_project', 'uses' => 'ProjectController@view'));

Route::get('department/{slug}/{page?}', array('as' => 'view_department', 'uses' => 'ShowcaseController@department'));

Route::post('upload/image', 'ProjectController@uploadImage');
Route::post('upload/thumbnail', 'ProjectController@uploadThumbnail');
Route::post('upload/pdf', 'ProjectController@uploadPDF');
Route::post('upload/ppt', 'ProjectController@uploadPPT');
Route::post('upload/zip', 'ProjectController@uploadZIP');

Route::get('/test', function() {
  $a = 'documents/2014/04/1055440044534bd8be41b3a8.99133586.png';

  $image = Image::make($a)->crop(300,200);

  $r = Response::make($image->encode('png'));
  $r->header('Content-Type', 'image/png');

  return $r;
});

Route::get('/pick', function() {

  return View::make('pick');

});


Route::get('/oauth2callback', 'AuthController@google');