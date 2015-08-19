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
    return \Illuminate\Support\Facades\Response::json(\LucaDegasperi\OAuth2Server\Facades\Authorizer::issueAccessToken());
});

Route::get('cliente', ["middleware" => "oauth", "uses" => 'ClienteController@index']);
Route::post('cliente', 'ClienteController@store');
Route::get('cliente/{id}', 'ClienteController@show');
Route::delete('cliente/{id}', 'ClienteController@destroy');
Route::put('cliente/{id}', 'ClienteController@update');

Route::get('project/{id}/note', 'ProjectNoteController@index');
Route::get('project/{id}/note/{noteId}', 'ProjectNoteController@show');
Route::post('project/{id}/note', 'ProjectNoteController@store');
Route::put('project/{id}/note', 'ProjectNoteController@update');
Route::delete('project/{id}/note', 'ProjectNoteController@destroy');

Route::get('project', 'ProjectController@index');
Route::post('project', 'ProjectController@store');
Route::get('project/{id}', 'ProjectController@show');
Route::delete('project/{id}', 'ProjectController@destroy');
Route::put('project/{id}', 'ProjectController@update');

