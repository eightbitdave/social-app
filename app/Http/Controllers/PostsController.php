<?php namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Redirect;
use Validator;

use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;

class PostsController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index', 'search', 'show']]);
	}

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
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
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
			return redirect(route('users.show', [$username]));
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
		$post = Post::find($id);

		if ($post == NULL) {

			Session::flash('info_message', 'Not a valid post!');
			return redirect(route('posts.index'));

		} elseif (Auth::user()->getId() == $post->user_id) {

			return view('posts.edit', compact('post'));

		} else {
			Session::flash('info_message', 'You are not authorised to do that!');
			return redirect(route('posts.show', [$post->id]));
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
		$post = Post::findOrFail($id);

		if (Auth::user()->getId() == $post->user_id) {
		
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
				return redirect(route('posts.show', [$post->id]));
			}

		} else {
			Session::flash('info_message', 'You do not have that permission');
			return redirect(route('posts.show', [$post->id]));
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

		if (Auth::user()->getId() == $post->user_id) {

			$post->delete();

			// Redirect
			Session::flash('message', 'Post deleted!');
			return redirect(route('users.show', [$post->username]));
		} else {
			Session::flash('info_message', 'You do not have that permission!');
			return redirect(route('posts.show', [$id]));
		}
	}
}