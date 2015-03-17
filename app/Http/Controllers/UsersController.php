<?php namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Request;
use Session;
use App\Post;
use Redirect;
use Validator;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['only' => ['edit', 'update', 'destroy']]);
	}

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
		if (Auth::check()) {
			Session::flash('info_message', 'You are already logged into an account!');
			return Redirect::route('users.index');
		} else {
			return view('users.create');
		}
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
			$user->password = Hash::make(Request::get('password'));
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

		if ($user) {

			$posts = DB::select("select * from posts where user_id = $user->id ORDER BY created_at DESC LIMIT 5");

			$groups = $user->groups;

			return view('users.show', compact('user', 'posts', 'groups'));
		} else {
			Session::flash('info_message', 'User does not exist!');
			return redirect(route('users.index'));
		}
	}

	/**
	 * Show the posts created by that user.
	 *
	 * @param int $username
	 * @return Response
	 */

	public function showPosts($username)
	{
		$user = User::where('username', '=', $username)->first();

		if ($user)
		{
			$posts = $user->posts;

			return view('users.showposts', compact('user', 'posts'));
		} else {
			Session::flash('info_message', 'No user with that username!');
			return redirect(route('users.index'));
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($username)
	{

		$user = User::where('username', '=', $username)->first();

		if ($user) {
			if (Auth::user()->getId() == $user->id) {
				return view('users.edit', compact('user'));
			} else {
				Session::flash('info_message', "You don't have the privilege!");
				return redirect(route('users.show', $user->username));
			}
		} else {
			Session::flash('info_message', 'Invalid user!');
			return Redirect::back();
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($username)
	{

		$user = User::where('username', '=', $username)->first();

		if (Auth::user()->getId() == $user->id) {

			$rules = array(
				'name' => 'required|min:3|regex:/^[a-zA-Z][a-zA-Z ]*$/'
			);

			$validator = Validator::make(Request::all(), $rules);

			if ($validator->fails()) {

				return Redirect::back()
					->withErrors($validator)
					->withInput();

			} else {

				$user->name = Request::get('name');

				$user->save();

				// Redirect
				Session::flash('message', 'Successfully updated!');
				return redirect(route('users.show', [$user->username]));
			}
			
		} else {
			Session::flash('info_message', 'You do not have that permission!');
			return redirect(route('users.show', [$user->username]));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);

		// Check if signed in user matches user to be deleted
		if (Auth::user()->getId() == $user->id) {

			Auth::logout();

			$user->delete();

			// Redirect
			Session::flash('info_message', 'Account Deleted!');
			return redirect(route('users.index'));
		} else {
			Session::flash('info_message', 'You do not have that permission');
			return redirect(route('users.show', [$id]));
		}
	}
}
