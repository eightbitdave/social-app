<?php

// Home/Welcome Controllers
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');


// User Routes
Route::resource('user', 'UserController');


// Post Routes
Route::get('post/search', 'PostController@search');
Route::post('post/search', ['as' => 'post.search', 'uses' => 'PostController@search']);
Route::resource('post', 'PostController');


// Group Routes
Route::get('group/search', 'GroupController@search');
Route::post('group/search', ['as' => 'group.search', 'uses' => 'GroupController@search']);
Route::resource('group', 'GroupController');





// Password Reset Route
Route::get('password/email', function(){
	return view('auth.password');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'AuthController']);