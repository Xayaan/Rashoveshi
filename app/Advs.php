<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advs extends Model {
	use SoftDeletes;

	protected $table = 'advs';

	protected $fillable = [
		'name',
		'page',
		'position',
        'target',
		'desktop',
		'mobile',
		'status',
	];

	protected $dates = ['deleted_at'];

    public function metrics()
    {
        return $this->hasMany('App\Metric');
    }

	public function scopePosition($query, $page, $position) {
		$query->where('page', '=', $page)->where('position', '=', $position);
	}
}
