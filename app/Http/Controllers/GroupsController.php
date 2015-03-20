<?php namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Tag;

use App\Group;
use App\Http\Requests\GroupRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class GroupsController extends Controller {

	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index', 'show', 'search', 'tags', 'showTag']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('groups.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tags = Tag::lists('name', 'name');

		return view('groups.create', compact('tags'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(GroupRequest $request)
	{
		$group = new Group;

		$group->name = $request->name;
		$group->about = $request->about;
		$group->tag = $request->tag;
		$group->creator = Auth::user()->getUsername();

		$group->save();
		
		// Add the creator as a member of the group.
		$group->users()->attach(Auth::user()->getId());

		// Redirect
		Session::flash('message', 'Group Created!');
		return redirect(route('groups.show', [$group->id]));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$group = Group::find($id);

		if ($group) {

			$isJoined = false;

			if (Auth::check()) {
				$user_id = Auth::user()->getId();

				$userJoined = DB::select("select user_id from group_user where user_id = $user_id and group_id = " . $group->id);

				if (!empty($userJoined)) {
					$isJoined = true;
				}
			}

			$posts = $group->posts()->orderBy('updated_at', 'desc')->limit(5)->get();

			$members = $group->users()->where('group_id', '=', $group->id)->orderBy('created_at', 'asc')->limit(5)->get();

			$tag = $group->tag;

			return view('groups.show', compact('group', 'tag', 'members', 'isJoined', 'posts'));

		} else {
			Session::flash('info_message', 'That group does not exist');
			return redirect(route('groups.index'));
		}
	}

	/**
	 * Search for a post.
	 *
	 * @return Response
	 */
	public function search()
	{
		if (Request::get('search-groups'))
		{
			$q = Request::get('search-groups');
			$searchTerms = explode(' ', $q);
			$query = DB::table('groups');

			foreach($searchTerms as $term)
			{
				$query->where('name', 'LIKE', '%' . $term . '%');
			}

			$results = $query->get();

			// Return results to posts.search view
			return view('groups.search', ['results' => $results]);
		}

		return view('groups.search');
	}


	/**
	 * Allow the user to become a member of a specified group.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function join($id)
	{
		$group = Group::find($id);

		if($group) {

			if(Auth::user()->getUsername() == $group->creator) {
				Session::flash('info_message', 'You are the creator of the group!');
				return redirect(route('groups.show', [$group->id]));
			}

			$user_id = Auth::user()->getId();

			$userJoined = DB::select("select user_id from group_user where user_id = $user_id and group_id = $group->id");

			if (empty($userJoined)) {
				$group->users()->attach(Auth::user()->getId());

				Session::flash('message', 'Joined Group!');
				return redirect(route('groups.show', [$group->id]));

			} else {
				Session::flash('info_message', 'You are already in this group!');
				return redirect(route('groups.show', [$group->id]));
			}

		} else {
			Session::flash('info_message', 'No such group!');
			return redirect(route('groups.index'));
		}
	}

	public function leave($id)
	{
		$group = Group::find($id);

		if ($group) {
			return view('groups.leave', compact('group'));
		} else {
			Session::flash('info_message', 'Invalid group!');
			return redirect(route('groups.index'));
		}

	}

	public function destroyMember($id)
	{
		$group = Group::find($id);

		if ($group) {
			$x = DB::select("select user_id from group_user where user_id = " . Auth::user()->getId());

			if (!empty($x)) {

				DB::table('group_user')->where('user_id', '=', Auth::user()->getId())->delete();

				Session::flash('message', 'Successfully left the group');
				return redirect(route('groups.show', [$group->id]));
				
			} else {
				Session::flash('You are not a member of that group!');
				return redirect(route('groups.show', [$group->id]));
			}
		}
	}


	public function tags()
	{
		$tags = Tag::lists('name', 'name');

		return view('groups.tags', compact('tags'));
	}

	/**
	 * Show all groups that contain a given tag.
	 *
	 */
	public function showTag($tag)
	{
		$groupList = Group::where('tag', '=', $tag)->get();

		if ($groupList) {
			return view('groups.tag', compact('groupList', 'tag'));

		} else {
			Session::flash('info_message', 'Not a valid tag!');
			return redirect(route('groups.search'));
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$group = Group::find($id);

		$username = Auth::user()->getUsername();

		if ($group == NULL) {

			Session::flash('info_message', 'Not a valid group!');
			return redirect(route('groups.index'));

		} elseif ($username == $group->creator) {

			$tags = Tag::lists('name', 'name');

			return view('groups.edit', compact('group', 'tags'));

		} else {
			Session::flash('info_message', 'You do not have that permission!');
			return redirect(route('groups.show', [$group->id]));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, GroupRequest $request)
	{
		$group = Group::findOrFail($id);

		if (Auth::user()->getUsername() == $group->creator) {
			$group->name = $request->name;
			$group->about = $request->about;
			$group->tag = $request->tag;

			$group->save();

			// Redirect
			Session::flash('message', 'Group updated!');
			return redirect(route('groups.show', [$group->id]));
		} else {
			Session::flash('info_message', 'You do not have that permission!');
			return redirect(route('groups.show', [$group->id]));
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
		$group = Group::find($id);

		if (Auth::user()->getUsername() == $group->creator) {

			$group->delete();

			// Redirect
			Session::flash('message', 'Group deleted!');
			return redirect(route('users.show', [$group->creator]));

		} else {
			Session::flash('info_message', 'You do not have that permission!');
			return redirect(route('groups.show', [$group->id]));
		}
	}

}
