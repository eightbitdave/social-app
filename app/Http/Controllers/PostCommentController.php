<?php namespace App\Http\Controllers;

use Session;
use Auth;

use App\Comment;
use App\Lang;
use App\Post;

use App\Http\Requests;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;

class PostCommentController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($post_id)
	{
		$post = Post::find($post_id);

		if ($post) {
			$comments = $post->comments;
			return view('comments.index', compact('post', 'comments'));
		} else {
			Session::flash('info_message', 'Invalid post!');
			return redirect(route('posts.index'));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($post_id)
	{

		$langs = Lang::lists('name', 'name');

		return view('comments.create', compact('post_id', 'langs'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($postId, CommentRequest $request)
	{
		$post = Post::find($postId);

		if(!is_null($post)) {

			$comment = new Comment;

			$comment->comment = $request->comment;
			$comment->code = $request->code;
			$comment->lang = $request->lang;
			$comment->user_id = Auth::user()->getId();
			$comment->post_id = $post->id;

			$comment->save();

			// // Redirect
			Session::flash('message', 'Comment posted!');
			return redirect(route('posts.show', [$post->id]));
		} else {
			Session::flash('info_message', 'Post does not exist!');
			return redirect(route('posts.index'));
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($post_id, $id)
	{
		return redirect(route('posts.show', [$post_id]));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($postId, $commentId)
	{

		$post = Post::find($postId);

		if ($post){
			$comment = Comment::find($commentId);
			$langs = Lang::lists('name', 'name');

			if ($comment) {

				if ($comment->user_id == Auth::user()->getId()){
					return view('comments.edit', compact('comment', 'postId', 'langs'));
				} else {
					Session::flash('info_message', 'You do not have that permission!');
					return redirect(route('posts.show', [$postId]));
				}

			} else {
				Session::flash('info_message', 'Not a valid comment');
				return redirect(route('posts.show', [$postId]));
			}
		} else {
			Session::flash('info_message', 'Not a valid post!');
			return redirect(route('posts.index'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($commentId, $postId, CommentRequest $request)
	{
		$comment = Comment::findOrFail($commentId);

		if(Auth::user()->getId() == $comment->user_id) {
			$comment->comment = $request->comment;
			$comment->code = $request->code;
			$comment->lang = $request->lang;

			$comment->save();

			// Redirect
			Session::flash('message', 'Comment updated!');
			return redirect(route('posts.show', [$postId]));
		} else {
			Session::flash('info_message', 'You do not have that permission!');
			return redirect(route('posts.show', [$postId]));
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, $post_id)
	{
		$comment = Comment::find($id);

		if (Auth::user()->getId() == $comment->user_id) {
			$comment->delete();

			// Redirect
			Session::flash('message', 'Comment deleted!');
			return redirect(route('posts.show', [$post_id]));
		} else {
			Session::flash('info_message', 'You do not have that permission!');
			return redirect(route('posts.show', [$post_id]));
		}
	}

}
