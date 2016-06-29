<?php
use App\PostView;

function articleStatus($status) {
	if (is_numeric($status)) {
		$ref = array(
			"Draft", "Publish", "Review", "Deleted",
		);
	} else {
		$ref = array(
			"draft" => 0,
			"drafts" => 0,
			"publish" => 1,
			"published" => 1,
			"review" => 2,
			"deleted" => 3,
			"delete" => 3,
		);
	}

	return $ref[$status];
}

function commentStatus($status) {

	if (is_numeric($status)) {
		$ref = array(
			'Pending', 'Approved', 'Rejected',
		);
	}
	return $ref[$status];
}

function postReadViews($post, $views = null) {
	$pv = PostView::find($post);
	if (isset($pv)) {
		if ($views) {
			$pv->views = $views;
		} else {
			$pv->views = $pv->views + 1;
		}

		$pv->timestamps = false;
		$pv->save();
	} else {
		$pn = new PostView;
		$pn->post_id = $post;
		if ($views) {
			$pn->views = $views;
		} else {
			$pn->views = 2;
		}
		$pn->timestamps = false;
		$pn->save();
	}
}

?>