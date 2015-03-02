<?php namespace App\Http\Controllers;
use Auth;
use Input;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LoginController extends Controller {

	public function login()
	{
		return view('login');
	}
	
	public function auth()
	{
		if(Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
		{
			return true;
		} else {
			return Redirect::to('/login')->with('message', 'Login Failed!')->withInput();
		}
	}

}
