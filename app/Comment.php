<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
	protected $table = 'comments';

	protected $fillable = [
		'post_id',
		'name',
		'comment',
		'positive',
		'negative',
		'ip',
		'approved_by',
		'parent',
		'status',
	];

	public function scopeStatus($query, $status) {
		$query->where('status', $status)->orderBy('id', 'desc');
	}

	/**
	 * Get the post that owns the comment.
	 */
	public function post() {
		return $this->belongsTo('App\Post')->select('id', 'heading');
	}

	/**
	 * approvedBy
	 */
	public function approved() {
		return $this->belongsTo('App\User', 'approved_by', 'id');
	}
}
