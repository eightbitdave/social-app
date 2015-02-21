<?php namespace App\Http\Controllers;

class UserController extends Controller {

	/**
	 * Show the homepage for the user.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		return view('users.index', ['user' => User::findOrFail($id)]);
	}


	/**
	 * Show the profile for the given user.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function showProfile($id)
	{
		return view('user.profile', ['user' => User::findOrFail($id)]);
	}

	public function redirect()
	{
		return "You need to be logged in to view this page!";
	}

	public function create()
	{
		return view('users.create');
	}

}
