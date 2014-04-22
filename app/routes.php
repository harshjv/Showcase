<?php

Route::pattern('page', '[0-9]+');
Route::pattern('id', '[0-9]+');

Route::post('invokeProject', 'ProjectController@invokeProject');

Route::get('/{page?}', array('as' => 'showcase', 'uses' => 'ShowcaseController@show'));

Route::get('add', array('as' => 'add', 'uses' => 'ProjectController@add'));

Route::get('add_dropzone', array('as' => 'add', 'uses' => 'ProjectController@addDropZone'));
Route::post('documents/upload', array('uses' => 'ProjectController@doUpload'));
Route::post('documents/remove', array('uses' => 'ProjectController@doRemove'));

Route::get('edit', array('as' => 'edit', 'uses' => 'ProjectController@edit'));
Route::post('edit', array('before' =>'csrf', 'as' => 'edit_check', 'uses' => 'ProjectController@editCheck'));

Route::post('edit_project', array('before' =>'csrf', 'as' => 'do_edit', 'uses' => 'ProjectController@doEdit'));

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

  $string = "/home/harsh/Projects/Showcase/public/documents/QpTDm/jCnQ5l5355289691034OVNi61.png,/home/harsh/Projects/Showcase/public/documents/SzI0y/PGiqmn535528985a9fbBvm1NK.png,/home/harsh/Projects/Showcase/public/documents/RUhvZ/WyhHmV5355289a9aa2aN266jZ.png";

  $images = array();
  $pdf = "";
  $zip = "";

  $a = explode(',', $string);

  array_walk($a, function($s) use(&$images, &$pdf, &$zip) {
    if(ends_with($s, 'pdf')) {
      $pdf = $s;
    }
    if(ends_with($s, 'zip')) {
      $zip = $s;
    }
    if(ends_with($s, 'jpg') || ends_with($s, 'jpeg') || ends_with($s, 'png')) {
      $images[] = $s;
    }
  });

  print_r($images);
  print($pdf);
  print($zip);

  echo "<br>";

  //echo substr("string.png", 1, -1);

  echo pathinfo("string.png", PATHINFO_EXTENSION);

});

Route::get('/success', array('as' => 'success', 'uses' => 'ShowcaseController@success'));


Route::get('/oauth2callback', 'AuthController@google');