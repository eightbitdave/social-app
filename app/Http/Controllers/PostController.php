<?php namespace App\Http\Controllers;

use DB;
use Auth;
use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()) {
			return "Welcome!";
		} else {
			return view('posts.index');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check())
		{
			return view('posts.create');
		} else {
			return view('auth.login');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return "Stored data! (not really).";
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('posts.show', ['post' => Post::find($id)]);
	}

	/**
	 * Search for a post.
	 *
	 * @return Response
	 */
	public function search()
	{
		if (Request::get('search-posts'))
		{
			$q = Request::get('search-posts');
			$searchTerms = explode(' ', $q);
			$query = DB::table('posts');

			foreach($searchTerms as $term)
			{
				$query->where('title', 'LIKE', '%' . $term . '%');
			}

			$results = $query->get();

			// Return results to posts.search view
			return view('posts.search', ['results' => $results]);
		}

		return view('posts.search', []);
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
