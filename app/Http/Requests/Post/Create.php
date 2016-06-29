<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\Request;

class Create extends Request {
	/**
	 * Returns the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'heading' => 'required',
			'heading_latin' => 'required',
			'content' => 'required',
			'tag' => 'required',
			'created_by' => 'required',
		];
	}
}
