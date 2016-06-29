<?php

namespace App\Http\Controllers\Rashoveshi;

use App\Comment;
use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Http\Request;

class CommentController extends Controller {

	protected $comments;

	public function __construct(Comment $comments) {
		$this->comments = $comments;
	}

	public function store(Request $request) {

		$input = $request->all();
		$input['ip'] = $request->ip();
		$comment = $this->comments->create($input);
		$id = $comment->id;
		return "true";
	}

	public function react(Request $request) {

		$threshold = 5;
		$go = "ok";
		$source = $request->ip() . "_" . $request->id;

		$iphits = Cache::get($source);

		if (Cache::has($source)) {
			Cache::increment($source);
			if ($iphits > 5) {
				$go = "no";
			}
		} else {
			Cache::put($source, '1', 10);
		}

		if ($go == "ok") {
			$comment = $this->comments->find($request->id);

			if ($request->react == "positive") {
				$comment->positive = $comment->positive + 1;
			}

			if ($request->react == "negative") {
				$comment->negative = $comment->negative + 1;
			}

			$comment->save();

			Cache::forget('published_post_' . $comment->post_id);

			return "Reacted " . $request->react;

		} else {
			return "Everybody's out there wrestling like a robot. Yes you've been logged.";
		}

	}
}
