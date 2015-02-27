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

// Home/Welcome Controllers
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');


// User Resource Controller
Route::resource('user', 'UserController');


Route::get('post/search', 'PostController@search');
Route::post('post/search', ['as' => 'post.search', 'uses' => 'PostController@search']);

// Post Resource Controller
Route::resource('post', 'PostController');




// Password Reset Route
Route::get('password/email', function(){
	return "This is where you'd reset your password";
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);