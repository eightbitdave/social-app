<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupPost extends Model {

	protected $table = 'group_posts';

	protected $fillable = ['title', 'content', 'code'];

	/**
	 * Get the user that created the group post.
	 * @return Response
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the group that the post belongs to.
	 * @return Response
	 */
	public function group()
	{
		return $this->belongsTo('App\Group');
	}

}
