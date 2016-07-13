	@if(!$posts['posts']['featured']->isEmpty())
	<div class="large-12 medium-6 featured column nopadding">
		<a href="{{route('page.article', $posts['posts']['featured'][0]->id)}}">
			<div class="featured-inner">
				<div class="large-6 column nopadding-right">
					@if($posts['posts']['featured'][0]->image != '')
						<div class="main-pic" style="background-image:url('{{asset('uploads/post/squareMedium_'.$posts['posts']['featured'][0]->image)}}');');"></div>
					@else
						<div class="main-pic" style="background-image:url('{{asset('images/img-placeholder.png')}}');');"></div>
					@endif
				</div>
				<div class="large-6 column nopadding-right feat-main-txt">
					<h1>{{$posts['posts']['featured'][0]->heading}}</h1>
					@if($posts['posts']['featured'][0]->published_at !== '')
			            <abbr class="timeago" title="{{$posts['posts']['featured'][0]->published_at}}"></abbr>
			         @endif
					<p>{{$posts['posts']['featured'][0]->summary}}</p>
				</div>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
	@endif



	{{-- Sub Featured --}}
	<?php $counter = 1; ?>
	@if(!$posts['posts']['subs']->isEmpty())
	<div class="large-12 medium-6 column sub-featured-wrap">
		@foreach($posts['posts']['subs'] as $post)
			<div class="large-4 column sub-featured nopadding-right">
				<a href="{{route('page.article', $post->id)}}">
					<div class="sub-featured-inner">
						<div class="sub-featured-img" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}');"></div>

						<h2>{{$post->heading}}</h2>
						<div class="time">
							@if($post->image !== '')
				            	<abbr class="timeago" title="{{$post->published_at}}"></abbr>
				         	@endif
						</div>
					</div>
				</a>
			</div>
			@if ($counter++ % 3 == 0)
				</div>
				<div class="large-12 medium-6 column sub-featured-wrap">
			@endif
		@endforeach
	</div>
	@endif
