<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Tag extends Model {

	use SearchableTrait;

	protected $table = 'tags';

	protected $searchable = [
		'columns' => [
			'tags.name' => 10,
			'tags.name_en' => 10,
		],
	];

	protected $fillable = [
		'type_id',
		'name',
		'name_en',
		'slug',
		'og',
		"avatar",
		"layout",
		"order",
		"parent_id",
	];

	public function type() {
		return $this->belongsTo('App\TagType', 'type_id', 'id');
	}

	public function parent() {
		return $this->belongsTo('App\Tag', 'parent_id', 'id');
	}

	public function child() {
		return $this->hasMany('App\Tag', 'parent_id', 'id');
	}

	public function posts() {
		return $this->belongsToMany("App\Post");
	}

	public function scopeCategories($query) {

		return $query->where('type_id', 1)->lists('name', 'id');
	}

	public function scopeTagID($query, $slug) {
		return $query->where('slug', $slug)->lists('id');
	}

}
