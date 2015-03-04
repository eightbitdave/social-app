<?php namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Validator;
use Redirect;

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
		return view('posts.index');
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
		if (Auth::check()) {

			$rules = array(
				'title' 	=>	'required|min:1|',
				'content'	=>	'required|min:3|'
			);

			$validator = Validator::make(Request::all(), $rules);

			if ($validator->fails()) {
				return Redirect::back()
					->withErrors($validator)
					->withInput();
			} else {
				$post = new Post;

				$post->title = Request::get('title');
				$post->content = Request::get('content');
				$post->user_id = Auth::user()->getId();
				$post->username = Auth::user()->getUsername();

				$post->save();

				
				$username =  Auth::user()->getUsername();

				// Redirect
				Session::flash('message', 'Post Created!');
				// return Redirect::to("/user/$username");
				return Redirect::to(route('user.show', [$username]));
			}
		} else {
			// Redirect with message
			Session::flash('message_info', 'You need to log in first!');
			return Redirect::to('auth/login');
		}
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
		if (Auth::check()) {

			$post = Post::findOrFail($id);

			if(Auth::user()->getId() == $post->user_id) {
				return view('posts.edit', ['post' => $post]);
			} else {
				Session::flash('warn_message', 'You are not authorised to do that!');
				return Redirect::to(route('post.show', [$post->id]));
			}
		} else {
			Session::flash('info_message', 'You need to log in first!');
			return Redirect::to(route('auth.login'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		if (Auth::check()) {

			$post = Post::findOrFail($id);

			$rules = array(
				'title' 	=>	'required|min:1|',
				'content'	=>	'required|min:3|'
			);

			$validator = Validator::make(Request::all(), $rules);

			if ($validator->fails()) {
				return Redirect::back()
					->withErrors($validator)
					->withInput();
			} else {

				$post->title = Request::get('title');
				$post->content = Request::get('content');

				$post->save();

				// Redirect
				Session::flash('message', 'Post updated!');
				return Redirect::to(route('post.show', [$post->id]));
			}
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
		$post = Post::find($id);

		$post->delete();

		Session::flash('message', 'Post deleted!');
		return redirect(route('user.show', [$post->username]));
	}

}