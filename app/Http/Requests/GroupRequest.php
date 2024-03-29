<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class GroupRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if (Auth::check()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' 		=>	'required|min:3',
			'about'		=>	'required|min:3',
			'tag'		=>	'required'
		];
	}

}
