<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model {
	protected $table = 'layouts';

	protected $fillable = [
		'type',
		'pos_1',
		'pos_2',
		'pos_3',
		'pos_4',
		'breaking',
		'developing',
		'live',
		'user_id',
	];

	/**
	 *
	 * Returns all created_by
	 *
	 **/

	public function created_by() {
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	public function p_1() {
		return $this->belongsTo('App\Post', 'pos_1', 'id')->select(array('id', 'heading', 'heading_latin', 'image', 'summary', 'status', 'published_at'))->where('status', 1);
	}

	/**
	 *
	 * Returns all Pos_2
	 *
	 **/

	public function p_2() {
		return $this->belongsTo('App\Post', 'pos_2', 'id')->select(array('id', 'heading', 'heading_latin', 'image', 'summary', 'status', 'published_at'))->where('status', 1);
	}

	/**
	 *
	 * Returns all pos_3
	 *
	 **/

	public function p_3() {
		return $this->belongsTo('App\Post', 'pos_3', 'id')->select(array('id', 'heading', 'heading_latin', 'image', 'summary', 'status', 'published_at'))->where('status', 1);
	}

	/**
	 *
	 * Returns all pos_4
	 *
	 **/

	public function p_4() {
		return $this->belongsTo('App\Post', 'pos_4', 'id')->select(array('id', 'heading', 'heading_latin', 'image', 'summary', 'status', 'published_at'))->where('status', 1);
	}

	/**
	 *
	 * Returns all breaking
	 *
	 **/

	public function p_breaking() {
		return $this->belongsTo('App\Post', 'breaking', 'id')->select(array('id', 'heading', 'heading_latin', 'image', 'summary', 'status', 'published_at'))->where('status', 1);
	}

	/**
	 *
	 * Returns all live
	 *
	 **/

	public function p_live() {
		return $this->belongsTo('App\Post', 'live', 'id')->select(array('id', 'heading', 'heading_latin', 'image', 'summary', 'status', 'published_at'))->where('status', 1);
	}

	/**
	 *
	 * Returns all developing
	 *
	 **/

	public function p_developing() {
		return $this->belongsTo('App\Post', 'developing', 'id')->select(array('id', 'heading', 'heading_latin', 'image', 'summary', 'status', 'published_at'))->where('status', 1);
	}
}
