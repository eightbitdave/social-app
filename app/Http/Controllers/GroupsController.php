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
		$this->middleware('auth', ['except' => ['index', 'show', 'search', 'tag']]);
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

		/*
			TODO: Pass through $member_count variable;

			Something like:

			isMemberOf::where('group', '=', $group->id);
		*/

		$group = Group::find($id);

		if ($group) {

			$tag = $group->tag;

			return view('groups.show', compact('group', 'tag'));
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
		/*
			TODO: Implement Joining Feature
		*/

		return "Successfuly joined the group! (not).";
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
		/*
			TODO: Allow users to search groups using a tag.
		*/

		$groupList = Group::where('tag', '=', $tag)->get();

		if ($groupList) {
			return view('groups.tag', compact('groupList'));

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
