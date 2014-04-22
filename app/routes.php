<?php

Route::pattern('page', '[0-9]+');
Route::pattern('id', '[0-9]+');

Route::get('/{page?}', array('as' => 'showcase', 'uses' => 'ShowcaseController@show'));

Route::get('add', array('as' => 'add', 'uses' => 'ProjectController@add'));
Route::post('add', array('before' =>'csrf', 'as' => 'do_add', 'uses' => 'ProjectController@doAdd'));

Route::post('documents/upload', array('uses' => 'ProjectController@doUpload'));
Route::post('documents/remove', array('uses' => 'ProjectController@doRemove'));

Route::get('edit', array('as' => 'edit', 'uses' => 'ProjectController@edit'));
Route::post('edit_project', array('before' =>'csrf', 'as' => 'do_edit', 'uses' => 'ProjectController@doEdit'));

Route::post('check', array('before' =>'csrf', 'as' => 'edit_check', 'uses' => 'ProjectController@editCheck'));

Route::get('search', array('as' => 'search', 'uses' => 'ShowcaseController@search'));

Route::get('project/{id}', array('as' => 'view_project', 'uses' => 'ShowcaseController@view'));

Route::get('department/{slug}/{page?}', array('as' => 'view_department', 'uses' => 'ShowcaseController@department'));

Route::get('/success', array('as' => 'success', 'uses' => 'ShowcaseController@success'));