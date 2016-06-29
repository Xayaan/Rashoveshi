<?php
namespace App\Http\Requests\Author;

use App\Http\Requests\Request;

class Create extends Request {
	/**
	 * Returns the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required|unique:authors',
			'name_en' => 'required|unique:authors',
		];
	}
}
