<?php

namespace App;
use App\Layout;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	protected $table = 'posts';

	protected $fillable = [
		'heading',
		'heading_detailed',
		'heading_latin',
		'summary',
		'content',
		'content_text',
		'image',
		'tag',
		'created_by',
		'status',
		'language',
		'published_at',
	];

	public function tags() {
		return $this->belongsToMany('App\Tag');
	}

	public function parentTag() {
		return $this->belongsTo('App\Tag', 'tag', 'id');
	}

	public function Author() {
		return $this->belongsTo('App\Author', 'created_by', 'id');
	}

	public function scopeStatus($query, $status) {
		$query->where('status', articleStatus($status))->orderBy('published_at', 'desc');
	}

	public function scopeMulti($query, $status) {
		$query->where('status', articleStatus($status))->orderBy('published_at', 'desc');
	}

	public function mainImage() {
		return $this->belongsTo('App\Photo', 'image', 'filename');
	}

	public function comments() {
		return $this->hasMany('App\Comment')->where('status', 1)->orderBy('id', 'desc');
	}

	public function views() {
		return $this->hasOne('App\PostView');
	}

	/**
	 *
	 * Scope Not in Layout
	 *
	 **/
	public function scopeNotFeatured($query) {
		$featured = Layout::orderBy('id', 'desc')->first();

		$query->whereNotIn('id', [$featured['pos_1']])
			->whereNotIn('id', [$featured['pos_2']])
			->whereNotIn('id', [$featured['pos_3']])
			->whereNotIn('id', [$featured['pos_4']]);

		if ($featured['live']) {
			$query->whereNotIn('id', [$featured['live']]);
		}
		if ($featured['breaking']) {
			$query->whereNotIn('id', [$featured['breaking']]);
		}
		if ($featured['developing']) {
			$query->whereNotIn('id', [$featured['developing']]);
		}
	}

	public function PaginateByTag($tag, $skip = 4, $take = 8) {
		$fields = [
			'id', 'heading', 'heading_detailed', 'summary', 'image', 'published_at',
		];
	}

	public function PostsByTag($tag, $take = 4, $featured = null, $all = FALSE) {
		$fields = [
			'id', 'heading', 'heading_detailed', 'summary', 'image', 'published_at',
		];

		if ($all == TRUE) {
			$query = Post::where('tag', $tag)->with('author')->status('published')->orderBy('published_at', 'desc');
			return $data['posts'] = $query->get();
		} else {
			$data = array('featured' => null, 'subs' => null);
			if (is_numeric($tag)) {
				$query = Post::where('tag', $tag)->with('author')->status('published')->orderBy('published_at', 'desc');

				if ($featured != null) {
					$data['featured'] = $query->take($featured)->get();

				}

				$data['subs'] = $query->skip($featured)->take($take)->get();

				return $data;
			} else {
				return 'slug';
			}
		}

	}
}
