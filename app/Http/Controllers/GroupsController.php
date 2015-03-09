<?php namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
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
		$this->middleware('auth', ['except' => ['index', 'show', 'search']]);
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
		return view('groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id, GroupRequest $request)
	{
		// $group = new Group;

		// $group->name = $request->name;
		// $group->about = $request->about;
		// $group->creator = Auth::user()->getUsername();

		// $group->save();

		// Redirect
		// Session:flash('message', 'Group Created!');
		// return redirect(route('groups.show', [$group->id]));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// Needs work.
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
