<?php

/** Badha Specific Routes */

Route::group(['domain' => env('BADHA'), 'namespace' => 'Badha'], function () {
	Route::get('/', ['middleware' => 'auth', 'as' => 'badha.dashboard', 'uses' => 'AdminPageController@dashboard']);

	/** AUTHENTICATION */
	Route::get('login', ['as' => 'user.login', 'uses' => 'AuthController@login']);
	Route::post('login', ['as' => 'user.auth', 'uses' => 'AuthController@auth']);
	Route::get('logout', ['as' => 'user.logout', 'uses' => 'AuthController@logout']);

	/** ADMIN USERS ROUTES */
	Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
		Route::get('/', ['as' => 'users.index', 'uses' => 'UsersController@index']);
		Route::group(['prefix' => 'create'], function () {
			Route::get('/', ['as' => 'user.create', 'uses' => 'UsersController@create']);
			Route::post('/', ['as' => 'user.store', 'uses' => 'UsersController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'user.edit', 'uses' => 'UsersController@edit']);
			Route::post('/', ['as' => 'user.update', 'uses' => 'UsersController@update']);
			Route::delete('/', ['as' => 'user.delete', 'uses' => 'UsersController@delete']);

			Route::get('deactivate', ['as' => 'user.deactivate', 'uses' => 'ActivationsController@deactivate']);
			Route::get('reactivate', ['as' => 'user.reactivate', 'uses' => 'ActivationsController@reactivate']);
		});

	});

	/** ROLES ROUTES */
	Route::group(['prefix' => 'roles', 'middleware' => 'auth.permissions:user.*'], function () {
		Route::get('/', ['as' => 'roles.index', 'uses' => 'RolesController@index']);

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'role.create', 'uses' => 'RolesController@create']);
			Route::post('create', ['as' => 'role.store', 'uses' => 'RolesController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'role.edit', 'uses' => 'RolesController@edit']);
			Route::post('/', ['as' => 'role.update', 'uses' => 'RolesController@update']);
			Route::delete('/', ['as' => 'role.delete', 'uses' => 'RolesController@delete']);
		});
	});

	/** Permission Routes */
	Route::group(['prefix' => 'permissions', 'middleware' => 'auth.permissions:user.*'], function () {
		Route::get('/', ['as' => 'permissions.index', 'uses' => 'PermissionsController@index']);

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'permission.create', 'uses' => 'PermissionsController@create']);
			Route::post('create', ['as' => 'permission.store', 'uses' => 'PermissionsController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'permission.edit', 'uses' => 'PermissionsController@edit']);
			Route::post('/', ['as' => 'permission.update', 'uses' => 'PermissionsController@update']);
			Route::delete('/', ['as' => 'permission.delete', 'uses' => 'PermissionsController@delete']);
		});
	});

	/** Tag Routes */
	Route::group(['prefix' => 'tags'], function () {
		Route::get('/', ['as' => 'tag.index', 'uses' => 'TagsController@index']);
		Route::any('/search', 'TagsController@search');
		Route::get('/?sort={any?}', 'TagsController@index');

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'tag.create', 'uses' => 'TagsController@create']);
			Route::post('create', ['as' => 'tag.store', 'uses' => 'TagsController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'tag.edit', 'uses' => 'TagsController@edit']);
			Route::post('/', ['as' => 'tag.update', 'uses' => 'TagsController@update']);
			Route::delete('/', ['as' => 'tag.delete', 'uses' => 'TagsController@delete']);
		});
	});

	/** Poll Routes */
	Route::group(['prefix' => 'polls'], function () {
		Route::get('/', ['as' => 'poll.index', 'uses' => 'PollsController@index']);
		Route::any('/search', 'PollsController@search');
		Route::get('/?sort={any?}', 'PollsController@index');

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'poll.create', 'uses' => 'PollsController@create']);
			Route::post('create', ['as' => 'poll.store', 'uses' => 'PollsController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'poll.edit', 'uses' => 'PollsController@edit']);
			Route::post('/', ['as' => 'poll.update', 'uses' => 'PollsController@update']);
			Route::delete('/', ['as' => 'poll.delete', 'uses' => 'PollsController@delete']);
		});
	});

	/** Tag Routes */
	Route::group(['prefix' => 'posts'], function () {
		Route::get('/', ['as' => 'post.index', 'uses' => 'PostsController@index']);
		Route::any('/search', 'PostsController@search');

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'post.create', 'uses' => 'PostsController@create']);
			Route::post('create', ['as' => 'post.store', 'uses' => 'PostsController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'post.edit', 'uses' => 'PostsController@edit']);
			Route::post('/', ['as' => 'post.update', 'uses' => 'PostsController@update']);
			Route::delete('/', ['as' => 'post.delete', 'uses' => 'PostsController@delete']);
		});
	});

	/** Tag Routes */
	Route::group(['prefix' => 'authors'], function () {
		Route::get('/', ['as' => 'author.index', 'uses' => 'AuthorsController@index']);
		Route::any('/search', 'AuthorsController@search');

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'author.create', 'uses' => 'AuthorsController@create']);
			Route::post('create', ['as' => 'author.store', 'uses' => 'AuthorsController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'author.edit', 'uses' => 'AuthorsController@edit']);
			Route::post('/', ['as' => 'author.update', 'uses' => 'AuthorsController@update']);
			Route::delete('/', ['as' => 'author.delete', 'uses' => 'AuthorsController@delete']);
		});
	});

	Route::group(['prefix' => 'advs'], function () {
		Route::get('/', ['as' => 'adv.index', 'uses' => 'AdvsController@index']);
		// Route::any('/search', 'AuthorsController@search');

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'adv.create', 'uses' => 'AdvsController@create']);
			Route::post('create', ['as' => 'adv.store', 'uses' => 'AdvsController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'adv.edit', 'uses' => 'AdvsController@edit']);
			Route::post('/', ['as' => 'adv.update', 'uses' => 'AdvsController@update']);
			Route::delete('/', ['as' => 'adv.delete', 'uses' => 'AdvsController@destroy']);
		});
	});

	/** Tag Routes */
	Route::group(['prefix' => 'comments'], function () {
		Route::get('/', ['as' => 'comment.index', 'uses' => 'CommentController@index']);
		Route::any('/search', 'CommentController@search');

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'comment.create', 'uses' => 'CommentController@create']);
			Route::post('create', ['as' => 'comment.store', 'uses' => 'CommentController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'comment.edit', 'uses' => 'CommentController@edit']);
			Route::post('/', ['as' => 'comment.update', 'uses' => 'CommentController@update']);
			Route::delete('/', ['as' => 'comment.delete', 'uses' => 'CommentController@delete']);

			Route::post('/approve', ['as' => 'comment.approve', 'uses' => 'CommentController@approve']);
			Route::post('/reject', ['as' => 'comment.reject', 'uses' => 'CommentController@reject']);
		});
	});

	Route::group(['prefix' => 'layouts'], function () {
		Route::get('/', ['as' => 'layout.index', 'uses' => 'LayoutController@index']);
		Route::post('/', ['as' => 'layout.store', 'uses' => 'LayoutController@store']);
		Route::any('/search', 'LayoutController@search');

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'layout.create', 'uses' => 'LayoutController@create']);
			Route::post('create', ['as' => 'layout.store', 'uses' => 'LayoutController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'layout.edit', 'uses' => 'LayoutController@edit']);
			Route::post('/', ['as' => 'layout.update', 'uses' => 'LayoutController@update']);
			Route::delete('/', ['as' => 'layout.delete', 'uses' => 'LayoutController@delete']);
		});
	});

	Route::group(['prefix' => 'photos'], function () {
		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'photo.edit', 'uses' => 'UploadController@photo_by_id']);
			Route::post('/', ['as' => 'photo.update', 'uses' => 'UploadController@update_photo']);
			Route::delete('/', ['as' => 'photo.delete', 'uses' => 'UploadController@delete_photo']);
		});
	});

	Route::group(['prefix' => 'liveblogs'], function () {
		Route::get('/', ['as' => 'liveblog.index', 'uses' => 'LiveBlogController@index']);
		Route::any('/search', 'LiveBlogController@search');
		Route::get('/?sort={any?}', 'LiveBlogController@index');

		Route::group(['prefix' => 'create'], function () {
			Route::get('create', ['as' => 'liveblog.create', 'uses' => 'LiveBlogController@create']);
			Route::post('create', ['as' => 'liveblog.store', 'uses' => 'LiveBlogController@store']);
		});

		Route::group(['prefix' => '{id}'], function () {
			Route::get('/', ['as' => 'liveblog.bullets', 'uses' => 'LiveBlogController@bullets']);
			Route::get('/edit/{bullet_id}', ['as' => 'liveblog.edit', 'uses' => 'LiveBlogController@edit']);
			Route::post('/edit/{bullet_id}', ['as' => 'liveblog.edit', 'uses' => 'LiveBlogController@update']);

			Route::post('/', ['as' => 'liveblog.add', 'uses' => 'LiveBlogController@add']);

			Route::delete('/', ['as' => 'liveblog.delete', 'uses' => 'LiveBlogController@delete']);
		});
	});

	Route::post('upload', 'UploadController@upload');
});

Route::group(['domain' => env('RASHOVESHI'), 'namespace' => 'Rashoveshi'], function () {


	Route::any('poll/vote/{id}', function($id, Illuminate\Http\Request $request) {
		$choice = App\Choice::find($request->input('choice'));
		$choice->votes += 1;
		$choice->save();
		
	});

	Route::get('/{id}', ['as' => 'page.article', 'uses' => 'PostController@article']);
	Route::get('embed', 'PostController@embed');
	Route::post('/comments', 'CommentController@store');
	Route::post('/comments/reaction', 'CommentController@react');
	Route::get('/', ['as' => 'page.home', 'uses' => 'HomeController@index']);
	Route::get('/{tag}', ['as' => 'page.category', 'uses' => 'TagController@index']);

});

Route::get('/category', ['as' => 'page.category', 'uses' => 'PagesController@category']);
Route::get('/results', ['as' => 'page.results', 'uses' => 'PagesController@results']);
Route::get('/gallery', ['as' => 'page.gallery', 'uses' => 'PagesController@gallery']);
Route::get('/gallery/view', ['as' => 'page.gallery-detail', 'uses' => 'PagesController@gallery_detail']);
Route::get('/pages/liveblog', function () {
	return view('rashoveshi.pages.live');
});
Route::get('/pages/404', function () {
	return view('rashoveshi.pages.404');
});