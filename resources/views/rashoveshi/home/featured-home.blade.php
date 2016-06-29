	<div class="large-12 medium-6 featured column nopadding">
		@if(!empty($featuredPosts->p_1->id))
		<a href="{{route('page.article', $featuredPosts->p_1->id)}}">
		@endif
			<div class="featured-inner">
				<div class="large-6 column nopadding-right">
					@if(!empty($featuredPosts->p_1))
						@if(!empty($featuredPosts->p_1->image))
							<div class="main-pic" style="background-image:url('{{asset('uploads/post/squareMedium_'.$featuredPosts->p_1->image)}}');');"></div>
						@else
							<div class="main-pic" style="background-image:url('{{asset('images/img-placeholder.png')}}');');"></div>
						@endif
					@endif
				</div>
				<div class="large-6 column nopadding-right feat-main-txt">
					@if(!empty($featuredPosts->p_1))
						<h1>{{!empty($featuredPosts->p_1->heading) ? $featuredPosts->p_1->heading : ""}}</h1>
						@if(!empty($featuredPosts->p_1->published_at))
				            <abbr class="timeago" title="{{$featuredPosts->p_1->published_at}}"></abbr>
				         @endif
						<p>{{!empty($featuredPosts->p_1->summary) ? $featuredPosts->p_1->summary : "" }}</p>
					@endif
				</div>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>



	{{-- Sub Featured --}}
	<div class="large-12 medium-6 column sub-featured-wrap">
		@foreach(range(2,4) as $idx)
			<div class="large-4 column sub-featured nopadding-right">
			@if(!empty($featuredPosts['p_'.$idx]->id))
			<a href="{{route('page.article', $featuredPosts['p_'.$idx]->id)}}">
			@endif
				<div class="sub-featured-inner">
					@if(!empty($featuredPosts['p_'.$idx]->image))
					<div class="sub-featured-img" style="background-image:url('{{asset('uploads/post/squareMedium_'.$featuredPosts['p_'.$idx]->image)}}');"></div>
					@endif
					@if(!empty($featuredPosts['p_'.$idx]->heading))
					<h2>{{$featuredPosts['p_'.$idx]->heading}}</h2>
					<div class="time">
						
					</div>
					@endif
				</div>
			</a>
		</div>
		@endforeach
	</div>