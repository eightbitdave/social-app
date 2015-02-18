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

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');


Route::get('user', 'UserController@redirect');
Route::get('user/create', 'UserController@create');
Route::get('user/{id}', 'UserController@index');
Route::get('user/{id}/profile', 'UserController@showProfile');


Route::get('password/email', function(){
	return "This is where you'd reset your password";
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);