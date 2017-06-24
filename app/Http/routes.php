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

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');


// Authentication routes...
Route::controller('auth', 'Auth\AuthController');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController');
    Route::get(
        'user/change-role/{id}/{newRoleId}',
        ['as' => 'user.change-role', 'uses' => 'UserController@changeRole']
    );
    Route::resource('student', 'StudentController');
    Route::get('student-data', [
        'as' => 'student.data', 'uses' => 'StudentController@getActiveData'
    ]);
    Route::get('student-inactive-data', [
        'as' => 'student.inactive-data', 'uses' => 'StudentController@getInActiveData'
    ]);
    Route::get('student/approve-data/{id}', [
        'as' => 'student.approve-data', 'uses' => 'StudentController@approveData'
    ]);

});
