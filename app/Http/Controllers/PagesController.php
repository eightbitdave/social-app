<?php namespace App\Http\Controllers;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

	public function dashboard()
	{
		return view('pages.dashboard');
	}
	
	public function home()
	{

		if (Auth::guest()){
			return view('pages.home');
		} else {
			return redirect('/dashboard');
		}
	}

	public function about()
	{
		return view('pages.about');
	}


}
