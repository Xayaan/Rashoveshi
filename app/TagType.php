<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagType extends Model {

	protected $table = 'tag_types';

	protected $fillable = [
		'name',
		'fields',
		'layout',
	];

	public function tags() {
		return $this->hasMany('App\Tag', 'type_id');
	}
}
