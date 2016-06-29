<?php
namespace App\Http\Requests;

class Layout extends Request {
	/**
	 * Returns the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'pos_1' => 'required',
			'pos_2' => 'required',
			'pos_3' => 'required',
			'pos_4' => 'required',
		];
	}
}
