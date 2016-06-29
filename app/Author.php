<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model {
	protected $table = 'authors';

	protected $fillable = [
		'name',
		'name_en',
		'description',
		'description_en',
		'post',
		'post_en',
		'twitter',
		'facebook',
		'avatar',
		'user_id',
	];

	public function user() {
		return $this->hasOne('App\Users', 'id', 'user_id');
	}
}
