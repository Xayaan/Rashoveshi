<?php

namespace App\Http\Requests\Adv;

use App\Http\Requests\Request;

class Create extends Request {
	/**
	 * Returns the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required',
			'position' => 'required',
            'target' => 'url',
		];
	}
}
