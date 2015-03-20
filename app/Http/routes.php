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

// Nested Resource Route
Route::resource('posts.comments', 'PostCommentController');


// Group Routes

# TODO: add groups/members route!

// Leaving Group Routes
Route::get('groups/{id}/leave', ['as' => 'groups.destroyMember', 'uses' => 'GroupsController@leave']);
Route::delete('groups/{id}/leave', 'GroupsController@destroyMember');

// Group Tag Routes
Route::get('groups/tags', 'GroupsController@tags');
Route::get('groups/tag/{tag}', 'GroupsController@showTag');


Route::get('groups/{id}/join', 'GroupsController@join');
Route::get('groups/search', 'GroupsController@search');
Route::post('groups/search', ['as' => 'groups.search', 'uses' => 'GroupsController@search']);
Route::resource('groups', 'GroupsController');

// Nested Resource Route
Route::resource('groups.posts', 'GroupPostController');





// Password Reset Route
Route::get('password/email', function(){
	return view('auth.password');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController']);