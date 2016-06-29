<?php
namespace App\Http\Controllers\Badha;

use App\LiveBlog;
use App\Post;
use Illuminate\Http\Request;


class LiveBlogController extends AuthorizedController {

	protected $posts;

	protected $liveblogs;

	public function __construct(LiveBlog $liveblogs, Post $posts) {
		parent::__construct();

		$this->liveblogs = $liveblogs;
		$this->posts = $posts;
	}

	public function index() {
		$liveblogs = $this->liveblogs;
		$posts = $this->posts->PostsByTag(env('LIVEBLOG'), null, null, TRUE);
		// return $posts;
		return view('badha.liveblog.index', compact('liveblogs', 'posts'));
	}

	public function bullets($id) {

		$post = $this->posts->findOrfail($id);

		$bullet = $this->liveblogs;

		$bullets = $this->liveblogs->where('post_id', $id)->orderBy('created_at', 'desc')->get();


		// return $post;
		return view('badha.liveblog.bullets', compact('post', 'bullets', 'bullet'));

	}

	public function add (Request $request){
		// $input = $request->all();

		$content_clean = $this->handleContent($request->input('bullet'));

		$post_id = $request->input('post_id');

		$liveblog = $this->liveblogs->create([
			'content' => $request->input('bullet'), 
			'content_text' => $content_clean,
			'post_id' => $request->input('post_id'),
			'user_id' => $this->currentUser->id
		]);

		return redirect()->route('liveblog.bullets', $post_id);
	}


	public function edit($id, $bullet_id){

		$post = $this->posts->findOrfail($id);

		$bullet = $this->liveblogs->find($bullet_id);

		$bullets = $this->liveblogs->where('post_id', $id)->orderBy('created_at', 'desc')->get();


		// return $post;
		return view('badha.liveblog.bullets', compact('post', 'bullets', 'bullet'));
	}


	public function update(Request $request){

		// return $request->all();

		$id = $request->input('id');
		$post_id = $request->input('post_id');

		$bullet = $this->liveblogs->findOrfail($id);

		$content_clean = $this->handleContent($request->input('bullet'));

		$bullet->content = $request->input('bullet');
		$bullet->content_text = $content_clean;
		$bullet->save();

		return redirect()->route('liveblog.bullets', $post_id);

	}


	public function delete($id){
		$bullet = $this->liveblogs->findOrfail($id);

		// Check if the role exists and there are no users attached
			// Delete the role
			$bullet->delete();

			// Redirect to the roles listing
			return redirect()->back();
	}

		

	public function handleContent($content) {
		// Remove unwated <br> tags
		$content = str_replace("<br>", "", $content);

		$html = new \Htmldom($content);
		$format = [];
		$markup = [];
		$elements = [];
		$images = [];

		foreach ($html->find('*') as $elm) {
			if ($elm->tag == 'p' && $elm->plaintext !== "") {
				$format['type'] = 'text';
				$format['source'] = $elm->plaintext;

				foreach ($elm->find('a') as $elm) {
					if ($elm->tag == 'a') {
						$markup['type'] = 'link';
						$markup['link'] = $elm->attr['href'];
						$markup['start'] = $elm->tag_start;
						$markup['end'] = strlen($elm->plaintext) + $elm->tag_start;
					}

					$format['markup'][] = $markup;
					$markup = [];

				}

				$elements[] = $format;
				$format = [];

			} elseif ($elm->tag == 'div') {
				if ($elm->attr['class'] == "medium-insert-images medium-insert-images-grid medium-insert-active" || $elm->attr['class'] == "medium-insert-images medium-insert-images-grid") {
					foreach ($elm->find('img') as $img) {
						$format['type'] = 'gallery';
						$markup['type'] = 'image';
						$markup['source'] = $img->attr['data-photoname'];
						if ($elm->find('figcaption')) {
							$markup['caption'] = $elm->find('figcaption')[0]->plaintext;
						}
						// $markup['link'] = $elm->attr['href'];
						$format['images'][] = $markup;
						$markup = [];
					}

				} elseif ($elm->attr['class'] == "medium-insert-embeds medium-insert-active" || $elm->attr['class'] == "medium-insert-embeds") {

					$format['type'] = 'embed';
					$format['source'] = $elm->find('div[class=medium-insert-meta]')[0]->attr['data-url'];

				} elseif ($elm->attr['class'] == "medium-insert-images medium-insert-active" || $elm->attr['class'] = "medium-insert-images") {

					$format['type'] = 'image';
					$format['source'] = $elm->find('img')[0]->attr['data-photoname'];

					if ($elm->find('figcaption')) {
						$format['markup']['caption'] = $elm->find('figcaption')[0]->plaintext;
					}

				}
				$elements[] = $format;
				$format = [];

			} elseif ($elm->tag == 'h1') {

				$format['type'] = 'heading_1';
				$format['source'] = $elm->plaintext;
				$elements[] = $format;
				$format = [];

			} elseif ($elm->tag == 'h2') {

				$format['type'] = 'heading_2';
				$format['source'] = $elm->plaintext;
				$elements[] = $format;
				$format = [];
			}
		}

		$data = json_encode($elements);

		return $data;
	}
}
