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
Route::get('login', 'Login@index');
Route::post('login', 'Login@login');

Route::group(['middleware' => 'auth'], function () {
    // Only authenticated users may enter...
    Route::get('/', 'Dashboard@index');

    Route::get('projects/ajax_list', 'Projects@ajax_list');
    Route::resource('projects', 'Projects');

    //streams
    Route::get('streams/ajax_list', 'Streams@ajax_list');
    Route::post('streams/regenerate_api_key', 'Streams@ajax_regenerate_Api_key');
    Route::resource('streams', 'Streams');

    // Logs
    Route::get('logs/ajax_list', 'Logs@ajax_list');
    Route::resource('logs', 'Logs');

    Route::get('signout', 'Login@signout');
});

Route::group(['prefix' => 'admin/', 'middleware' => ['auth', 'auth.admin']], function () {
    Route::get('/', 'Admin\Admin@index');

    Route::get('Admin/Users/ajax_list', 'Admin\Users@ajax_list');
    Route::resource('users', 'Admin\Users');
});

//API Routes
Route::group(['namespace' => 'API', 'prefix' => 'api/', 'middleware' => 'streamapi'], function () {
    Route::post('logs/ping', 'Logs@ping');
    Route::post('logs/store', 'Logs@store');
    Route::post('logs/recents', 'Logs@recents');
    Route::post('logs/diffs', 'Logs@diffs');
});
