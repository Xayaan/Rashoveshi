<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {
	protected $table = 'photos';

	protected $fillable = [
		'filename',
		'caption',
		'author_id',
		'watermark',
	];

	public function tags() {
		return $this->belongsToMany('App\Tag');
	}

	public function articleImage() {
		return $this->belongsToMany('App\Post', 'filename', 'image');
	}
}
