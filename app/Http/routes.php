<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(["middleware" => "oauth"], function(){
   Route::resource("cliente", "ClienteController", ["except" => ["create", "edit"]]); 
   
   Route::resource("project", "ProjectController", ["except" => ["create", "edit"]]);
   
   Route::group(["prefix" => "project"], function(){
        Route::get('{id}/members', 'ProjectController@members');
        Route::get('{id}/members/{userId}', 'ProjectController@isMember');
        Route::post('{id}/members', 'ProjectController@addMember');
        Route::delete('{id}/members/{userId}', 'ProjectController@removeMember');

        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::put('{id}/note', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy'); 

        Route::get('{id}/task', 'ProjectTaskController@index');
        Route::get('{id}/task/{taskId}', 'ProjectTaskController@show');
        Route::post('{id}/task', 'ProjectTaskController@store');
        Route::put('{id}/task', 'ProjectTaskController@update');
        Route::delete('{id}/task/{taskId}', 'ProjectTaskController@destroy');
        
        Route::post('{id}/file', 'ProjectFileController@store');
        Route::delete('{id}/file/{fileId}', 'ProjectFileController@destroy');
  });
     
});

