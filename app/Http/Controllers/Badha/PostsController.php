<?php

namespace App\Http\Controllers\Badha;

use App\Author;
use App\Http\Requests\Post\Create;
use App\Post;
use App\Tag;
use App\TagType;
use Illuminate\Http\Request;

// use Illuminate\Http\Request;

class PostsController extends AuthorizedController {

	protected $post;

	protected $tags;

	protected $TagTypes;

	protected $authors;

	public function __construct(Post $post, Tag $tags, TagType $TagTypes, Author $authors) {
		parent::__construct();
		$this->posts = $post;
		$this->tags = $tags;
		$this->TagTypes = $TagTypes;
		$this->authors = $authors;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$posts = array();
		$sort = array($request->get('sort'));
		$author_id = $this->authors->select('id')->where('user_id', $this->currentUser->id)->get();
		if (!$author_id->isEmpty()) {
			$author_id = $author_id[0]->id;
		}
		if ($request->get('sort') == "drafts") {
			if ($this->currentUser->hasAccess(['post.review'])) {
				$posts = $this->posts->status("drafts")->orderBy('created_at', 'desc')->paginate(20);
			} else {
				$posts = $this->posts->where('created_by', $author_id)->status("drafts")->orderBy('created_at', 'desc')->paginate(20);
			}
		} else if ($request->get('sort') == "review") {
			if ($this->currentUser->hasAccess(['post.review'])) {
				$posts = $this->posts->status("review")->orderBy('created_at', 'desc')->paginate(20);
			}
		} else {
			$posts = $this->posts->status("published")->orderBy('created_at', 'desc')->paginate(20);
		}

		return view('badha.posts.index', compact('posts', 'sort'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$post = $this->posts;
		$tags = null;
		$userAuthor = null;
		$authors = $this->authors->all();
		$categories = $this->tags->categories();

		// if ($author = $this->authors->where('user_id', $this->currentUser->id)) {
		// 	$userAuthor = $author;
		// }

		$author_id = $this->authors->select('id')->where('user_id', $this->currentUser->id)->get();
		if (!$author_id->isEmpty()) {
			$userAuthor = $author_id[0]->id;
		}

		return view('badha.posts.form', compact('post', 'tags', 'categories', 'authors', 'userAuthor'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Create $request) {

		// Get the submited request data
		$input = $request->all();

		// return dd($input);
		// Create the user
		$post = $this->posts->create($input);

		$id = $post->id;

		$content_clean = $this->handleContent($request->input('content'));

		$post = Post::find($id);

		$post->content_text = $content_clean;

		$post->save();

		$id = $post->id;

		if ($request->tags_list) {
			$post->tags()->attach(explode(",", $request['tags_list']));
		}

		// Redirect to the users listing
		return redirect(route('post.index'))->withSuccess(
			trans('posts/messages.success.create')
		);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		// $str = '"<p>ސާފް ސުޒުކީ ކަޕް ފުޓްބޯޅަ މުބާރާތް ބަލަން އިންޑިއާއަށް ދާން ބޭނުންވާ ދިވެހިންނަށް ދަތުރު ކުރަން ފަސޭހަ އިންތިޒާމެއް ހަމަޖެއްސުމުގެ މަސައްކަތް ދެ ކުންފުންޏެއް ގުޅިގެން މިހާރު ފަށާފައިވާ ކަމަށް އެފްއޭއެމްއިން ބުނެފި އެވެ. </p><p>ވީނިއުސްއާ ވާހަކަ ދައްކަވަމުން އެފްއޭއެމްގެ ޖެނެރަލް ސެކްރެޓަރީ ބައްސާމް އާދިލް ޖަލީލް މިރޭ ވިދާޅުވީ، ސުޒުކީ ކަޕް ބެލުމަށް އިންޑިއާއަށް ދާންބޭނުންވާ ދިވެހިންނަށް ދަތުރު ކުރުމުގެ އިންތިޒާމްތައް ހަމަޖައްސާދިނުމުގެ މަސައްކަތް އިންޑިއާގެ ކުންފުންޏަކާއި ގައުމީ އެއާލައިން މޯލްޑިވިއަންއިން މިހާރު ފަށާފައިވާ ކަމަށެވެ. </p><p>"މިކަން މިކުރަނީ އިންޑިއާގެ ކުންފުންޏަކާއި ދިވެހި ކުންފުންޏަކުން ގުޅިގެން. އެދެކުންފުން ނިންމާފައި ވަނީ މިކަމަށް ހާއްސަ ޕެކޭޖެއް ހެދުމަށް. އެޕެކޭޖްގައި ހިމަނަން ނިންމާފައި ވަނީ ދެކޮޅު ޓިކެޓާއި ހުރުމާއި ކެއުން. މީގެ އިތުރުން އެޕެކޭޖްގައި ދަނޑަށް ވަނުމުގެ ޓިކެޓްވެސް ހިމެނޭ. މިކަމަށް އެފްއޭއެމްގެ އެއްބާރުލުން ވެސް އެ ދެކުންފުންޏަށް މިހާރު ދެމުން މިދަނީ. އެމަސްވަރާތައް ވެސް މިހާރު ވަނީ ފެށިފައި" ބައްސާމް ވިދާޅުވިއެވެ. </p><p>ބައްސާމް ވިދާޅުވީ، ގައުމީ ޓީމް މެޗް ކުޅޭ ދުވަސްތަކުގައި ގިނަ ބަޔަކަށް އެއްތާކުން މެޗް ބެލޭނެ އިންތިޒާމްތައް މާލޭގައި ވެސް ކުރިއަށް ގެންދިއުމުގެ މަސްވަރާތައް މިހާރު ފަށާފައިވާ ކަމަށެވެ.</p><div class="medium-insert-embeds"> <figure> <div class="medium-insert-embed"> <div style="left: 0px; width: 100%; height: 0px; position: relative; padding-bottom: 56.2493%;"><iframe src="https://www.youtube.com/embed/Z9aRmmWX5XI?wmode=transparent&amp;rel=0&amp;autohide=1&amp;showinfo=0&amp;enablejsapi=1" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" style="top: 0px; left: 0px; width: 100%; height: 100%; position: absolute;"></iframe></div><p style="line-height:17px;font-size:11px;color:#3c3c3c !important;padding: 4px 2px 5px;margin-bottom:2px;"> <a style="text-decoration:none;color:#3c3c3c;border-bottom:0px;" href="https://www.youtube.com/watch?v=Z9aRmmWX5XI" target="_blank">YouTube / Miss Philippines Pia Alonzo</a> - via <a style="text-decoration:none;color:#3c3c3c;border-bottom:0px;" href="https://iframely.com" target="_blank">Iframely</a> </p><div class="medium-insert-meta" data-url="https://www.youtube.com/watch?v=Z9aRmmWX5XI"></div> </div> </figure> </div><div class="medium-insert-embeds"> <figure> <div class="medium-insert-embed"> <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" class="twitter-tweet twitter-tweet-rendered" style="position: static; visibility: visible; display: block; width: 100%; height: 455.984px; padding: 0px; border: none; margin: 10px auto; max-width: 500px; min-width: 220px;" data-tweet-id="679393206191136769" title="Twitter Tweet"></iframe> <script async="" src="//platform.twitter.com/widgets.js" charset="utf-8"></script><div class="medium-insert-meta" data-url="https://twitter.com/Taymastar/statuses/679393206191136769"></div> </div> </figure> </div><p>ބައްސާމް ވިދާޅުވީ، ގައުމީ ޓީމް މެޗް ކުޅޭ ދުވަސްތަކުގައި ގިނަ ބަޔަކަށް އެއްތާކުން މެޗް ބެލޭނެ އިންތިޒާމްތައް މާލޭގައި ވެސް ކުރިއަށް ގެންދިއުމުގެ މަސްވަރާތައް މިހާރު ފަށާފައިވާ ކަމަށެވެ.</p><div class="medium-insert-images medium-insert-images-grid medium-insert-active">&nbsp;<figure> <img src="http://badha.ncit.dev/uploads/post/squareMedium_QfmgWPbNGHPS0hRjR5bMutxhe30Ds4.JPG" alt="" class="medium-insert-image-active"> <figcaption class="medium-insert-caption-placeholder" data-placeholder="Type caption for image (optional)"></figcaption></figure><figure> <img src="http://badha.ncit.dev/uploads/post/squareMedium_Ep5kGkLhFMGWRMVYjk90SOucdque9n.JPG" alt=""> </figure><figure> <img src="http://badha.ncit.dev/uploads/post/squareMedium_dKnUC23DKhrNEJPvtkplMljTDdZc2I.jpg" alt=""> </figure></div><p><br></p>"';
		// $post = $this->posts->find($id);
		// return $this->handleContent($post->content);
		// return dd($post->content);
		if ($post = $this->posts->find($id)) {

			$tags = collect($post->tags->lists('id'))->implode(',');
			$authors = $this->authors->all();
			$categories = $this->tags->categories();
			$userAuthor = $post->created_by;

			return view('badha.posts.form', compact('post', 'tags', 'categories', 'authors', 'userAuthor'));
		}

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Create $request, $id) {

		// Get the tag object
		$post = $this->posts->find($id);

		// Get the submited request data
		$input = $request->all();
		// Update the tags

		$content_clean = $this->handleContent($request->input('content'));

		$post->content_text = $content_clean;

		if ($request->tags_list) {
			$post->tags()->attach(explode(",", $request['tags_list']));
		}

		$post->fill($input);

		$post->save();

		return redirect(route('post.index'))->withSuccess(trans('posts/messages.success.update'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
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
