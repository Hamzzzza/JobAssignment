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
    'prefix' => 'auth',

], function ($router) {



    
   Route::get('google', 'AuthController@redirectToGoogle');
   Route::get('logins', 'AuthController@handleGoogleCallback');

});



Route::group([ 
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'jwt.auth'], function ($router) {

    Route::get('Assignments', 'AssignmentsController@all');
    Route::get('Assignments/{id}', 'AssignmentsController@get');


    Route::post('Courses/newTask/{id}', 'AssignmentsController@new');
   


    Route::get('Courses', 'CoursesController@all');
    Route::get('Courses/{id}', 'CoursesController@get');
    Route::post('Courses/new', 'CoursesController@new');

    
    Route::get('Courses/Assignment/{id}', 'CoursesController@getAssignedTasks');
    



            
        Route::get('contacts', 'ContactsController@get');
        Route::get('conversation/{id}', 'ContactsController@getMessagesFor');
        Route::post('conversation/send', 'ContactsController@send');
});


Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
Route::post('password/email', 'ResetPasswordController@reset');



