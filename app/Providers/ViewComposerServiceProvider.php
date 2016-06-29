<?php

namespace App\Providers;

use App\Author;
use App\Comment;
use App\Post;
use App\Poll;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		view()->composer('badha.posts.nav', function ($view) {
			$this->currentUser = Sentinel::getUser();
			if ($this->currentUser->hasAccess(['post.review'])) {
				$count['drafts'] = Post::status("drafts")->count();

			} else {
				$author_id = Author::select('id')->where('user_id', $this->currentUser->id)->get();
				$author_id = $author_id[0]->id;
				$count['drafts'] = Post::where('created_by', $author_id)->status("drafts")->count();
			}

			$count['review'] = Post::status("review")->count();

			$view->with('count', $count);
		});

		view()->composer('badha.comments.nav', function ($view) {
			$count['pending'] = Comment::status(0)->count();
			$view->with('count', $count);
		});

		view()->composer('rashoveshi.polls.latest-poll', function ($view)
		{
			try {
				$poll = Poll::with('choices')->latest()->first();
				$totalVotes = $poll->choices->sum('votes');
				foreach ($poll->choices as $choice) {
					$choiceAvg[] = @($choice->votes / $totalVotes) * 100;
				}
				$view->with([
					'poll'       => $poll,
					'totalVotes' => $totalVotes,
					'choiceAvg'  => $choiceAvg,
				]);
			} catch(\Exception $e) {
				$poll = null;
			}
		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
