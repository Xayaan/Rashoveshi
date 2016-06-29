<?php

namespace App\Http\Controllers\Badha;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends AuthorizedController {

	protected $comments;

	public function __construct(Comment $comments) {
		parent::__construct();
		$this->comments = $comments;
	}

	public function index(Request $request) {
		$comments = array();
		$sort = array($request->get('sort'));
		if ($request->get('sort') == "pending") {
			$comments = $this->comments->where('status', 0)->orderBy('created_at', 'desc')->paginate(3);
		} else if ($request->get('sort') == "rejected") {
			$comments = $this->comments->where('status', 2)->orderBy('created_at', 'desc')->paginate(3);

		} else {
			$comments = $this->comments->where('status', 1)->orderBy('created_at', 'desc')->paginate(3);
		}

		return view('badha.comments.index', compact('comments', 'sort'));
	}

	public function approve($id) {
		if ($comment = $this->comments->findOrfail($id)) {
			$comment->status = 1;
			$comment->approved_by = $this->currentUser->id;
			$comment->save();

			return redirect()->back()->withSuccess(
				trans('comments/messages.success.approved'));
		}
	}

	public function reject($id) {
		if ($comment = $this->comments->findOrfail($id)) {
			$comment->status = 2;
			$comment->approved_by = $this->currentUser->id;
			$comment->save();

			return redirect()->back()->withSuccess(
				trans('comments/messages.success.rejected'));
		}
	}

}
