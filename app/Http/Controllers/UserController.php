<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Crypt;

use Session;
use Request;
use Validator;
use Redirect;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('users.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name'				=>	'required|min:3|regex:/^[a-zA-Z][a-zA-Z ]*$/',
			'username'			=>	'required|min:3|unique:users|regex:/^[A-Za-z0-9_]{1,15}$/',
			'password'			=>	'required|min:6',
			'retype-password'	=> 	'required|min:6|same:password',
			'email'				=>	'required|email|unique:users'
		);

		$validator = Validator::make(Request::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator)
				->withInput(Request::except('password'));
		} else {

			$user = new User;

			$user->name = Request::get('name');
			$user->username = Request::get('username');
			$user->password = Crypt::encrypt(Request::get('password'));
			$user->email = Request::get('email');

			$user->save();

			// Redirect
			Session::flash('message', 'Account created!');
			return Redirect::to('auth/login');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($username)
	{

		$user = User::where('username', '=', $username)->first();

		return view('users.profile', ['user' => $user]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
