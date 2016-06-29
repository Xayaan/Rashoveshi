<?php
namespace App\Http\Requests\Poll;

use App\Http\Requests\Request;

class Update extends Request {
	/**
	 * Returns the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'title' => 'required',
			'desc' => 'required',
		];
	}
}
