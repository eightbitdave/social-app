<?php namespace App\Http\Controllers;

use Auth;
use DB;
use Session;

use App\Lang;
use App\Group;
use App\GroupPost;

use App\Http\Requests;
use App\Http\Requests\GroupPostRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;

class GroupPostController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($group_id)
	{
		$group = Group::find($group_id);

		if ($group) {
			$posts = $group->posts;
			return view('group_posts.index', compact('group', 'posts'));
		} else {
			Session::flash('info_message', 'Invalid group!');
			return redirect(route('groups.index'));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($group_id)
	{
		$group = Group::find($group_id);

		if($group) {

			$user_id = Auth::user()->getId();
			$userJoined = DB::select("select user_id from group_user where user_id = $user_id and group_id = $group_id");

			if (!empty($userJoined)) {

				$langs = Lang::lists('name', 'name');
				return view('group_posts.create', compact('group', 'langs'));

			} else {
				Session::flash('info_message', 'You need to be a member of the group to make a post!');
				return redirect(route('groups.show', [$group->id]));
			}
		} else {
			Session::flash('info_message', 'Group does not exist.');
			return view('groups.index');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($group_id, GroupPostRequest $request)
	{
		$group = Group::find($group_id);

		if(!is_null($group)) {

			$user_id = Auth::user()->getId();
			$userJoined = DB::select("select user_id from group_user where user_id = $user_id and group_id = $group_id");

			if (!empty($userJoined)) {

				$post = new GroupPost;

				$post->title = $request->title;
				$post->content = $request->content;
				$post->code = $request->code;
				$post->lang = $request->lang;
				$post->user_id = Auth::user()->getId();
				$post->group_id = $group->id;

				$post->save();

				// Redirect
				Session::flash('message', 'Post created!');
				return redirect(route('groups.show', [$group->id]));

			} else {
				Session::flash('info_message', 'You need to be a member of the group to make a post!');
				return redirect(route('groups.show', [$group->id]));
			}

		} else {
			Session::flash('info_message', 'Group does not exist!');
			return redirect(route('groups.index'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($group_id, $id)
	{
		return redirect(route('groups.show', [$group_id]));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($group_id, $post_id)
	{
		$group = Group::find($group_id);

		if ($group) {

			$user_id = Auth::user()->getId();
			$userJoined = DB::select("select user_id from group_user where user_id = $user_id and group_id = $group_id");

			if (!empty($userJoined)) {

				$post = GroupPost::find($post_id);

				if ($post) {
					$langs = Lang::lists('name', 'name');

					if ($post->user_id == Auth::user()->getId()) {
						return view('group_posts.edit', compact('group_id', 'post', 'langs'));
					} else {
						Session::flash('info_message', 'You do not have that permission!');
						return redirect(route('groups.show', [$group->id]));
					}
				} else {
					Session::flash('info_message', 'Not a valid post!');
					return redirect(route('groups.show', [$group->id]));
				}

			} else {
				Session::flash('info_message', 'You need to be a member of the group to make a post!');
				return redirect(route('groups.show', [$group->id]));
			}

		} else {
			Session::flash('info_message', 'Not a valid group!');
			return redirect(route('groups.index'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($post_id, $group_id, GroupPostRequest $request)
	{
		$post = GroupPost::findOrFail($post_id);

		if (Auth::user()->getId() == $post->user_id) {
			$post->title = $request->title;
			$post->content = $request->content;
			$post->code = $request->code;
			$post->lang = $request->lang;

			$post->save();

			// Redirect
			Session::flash('message', 'Post updated!');
			return redirect(route('groups.show', [$group_id]));
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
	public function destroy($id, $group_id)
	{
		$post = GroupPost::findOrFail($id);

		if (Auth::user()->getId() == $post->user_id) {

			$post->delete();

			// Redirect
			Session::flash('message', 'Post deleted!');
			return redirect(route('groups.show', [$group_id]));
		} else {
			Session::flash('info_message', 'You do not have that permission!');
			return redirect(route('groups.show', [$group_id]));
		}
	}

}
