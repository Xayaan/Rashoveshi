<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveBlog extends Model
{
   protected $table = 'bullets';

	protected $fillable = [
		'post_id',
		'content',
		'content_text',
		'user_id',
	];
}
