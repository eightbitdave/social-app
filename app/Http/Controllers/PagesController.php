<?php namespace App\Http\Controllers;

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
		return view('pages.home');
	}

	public function about()
	{
		return view('pages.about');
	}


}