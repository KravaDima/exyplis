<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function(){
    Route::get('/', 'Admin\AdminController@show');
});

Route::group(['prefix' => 'task'], function(){
    Route::get('/','TaskController@index')->name('task');
    Route::post('/set-task', 'TaskController@setTask' )->name('set-task');
    Route::post('/edit-task','TaskController@getTask')->name('edit-task');
    Route::post('/del-task', 'TaskController@delTask')->name('del-task');
    Route::post('/get-all-tasks', 'TaskController@getAllTasks')->name('get-all-tasks');
});