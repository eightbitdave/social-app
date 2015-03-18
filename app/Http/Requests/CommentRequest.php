<?php namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;

class CommentRequest extends Request {

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
			'comment' => 'required|min:3',
			'code'	  => 'min:3'
		];
	}

}
