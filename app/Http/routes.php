<?php

// Home&Welcome Controllers
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');


// User Routes
Route::get('users/{username}/posts', 'UsersController@showPosts');
Route::resource('users', 'UsersController');


// Post Routes
Route::get('posts/search', 'PostsController@search');
Route::post('posts/search', ['as' => 'posts.search', 'uses' => 'PostsController@search']);
Route::resource('posts', 'PostsController');


// Group Routes
Route::get('groups/{id}/join', 'GroupsController@join');
Route::get('groups/search', 'GroupsController@search');
Route::post('groups/search', ['as' => 'groups.search', 'uses' => 'GroupsController@search']);
Route::resource('groups', 'GroupsController');





// Password Reset Route
Route::get('password/email', function(){
	return view('auth.password');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController']);
