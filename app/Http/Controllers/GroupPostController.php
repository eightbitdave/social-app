<?php namespace App\Http\Controllers;

use Auth;
use Session;

use App\Lang;
use App\Group;
use App\GroupPost;

use App\Http\Requests;
use App\Http\Requests\GroupPostRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;

class GroupPostController extends Controller {

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
			$langs = Lang::lists('name', 'name');
			return view('group_posts.create', compact('group', 'langs'));
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
	public function show($id)
	{
		//
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
