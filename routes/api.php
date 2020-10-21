<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/






Route::group([ 
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post('googlelogin', 'AuthController@googleLoginRegister');

    
     
    
   Route::get('google', 'AuthController@redirectToGoogle');
   Route::get('logins', 'AuthController@handleGoogleCallback');
});

//Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'jwt.auth'], function ($router) {

    Route::get('Assignments/stdcourse', 'AssignmentsController@studentcourses');
    Route::get('Assignments', 'AssignmentsController@all');
    Route::get('Assignments/{id}', 'AssignmentsController@get');

    
    
    Route::post('Courses/new', 'CoursesController@new');
    Route::post('Courses/enrollstudent', 'CoursesController@enrollStudent');
    Route::post('Courses/addassignment', 'CoursesController@addAssignment');

    Route::get('Courses', 'CoursesController@all');
    Route::get('Courses/{id}', 'CoursesController@get');
    Route::get('Courses/Assignment/{id}', 'CoursesController@getAssignedTasks');
    


            
        Route::get('contacts', 'ContactsController@get');
        Route::get('conversation/{id}', 'ContactsController@getMessagesFor');
        Route::post('conversation/send', 'ContactsController@send');



});


