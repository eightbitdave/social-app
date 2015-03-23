<?php namespace App;


use DB;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'about'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];


	/**
	 * Get the users associated with the given group.
	 * @return Response
	 */
	public function users()
	{
		return $this->belongsToMany('App\User')->withTimestamps();
	}

	/**
	 * Get the posts associated with the given group.
	 * @return Response
	 */
	public function posts()
	{
		return $this->hasMany('App\GroupPost');
	}


	/**
	 * Determine if the given user has joined the given group.
	 *
	 * @return Response
	 */
	public function isUserMember($group, $user_id)
	{
		$isJoined = DB::select("select user_id from group_user where user_id = $user_id and group_id = $group->id");

		if (!empty($isJoined)) {
			return true;
		} else {
			return false;
		}
	}

}