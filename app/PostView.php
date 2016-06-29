<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostView extends Model {
	//
	protected $fillable = [
		'post_id',
		'views',
	];

	protected $primaryKey = 'post_id';
}
