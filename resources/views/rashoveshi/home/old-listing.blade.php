<?php $counter = 1 ?>
<div class="large-12 medium-6 column sub-featured-wrap">
		@foreach($oldPosts as $oldPost)
			<div class="large-4 column sub-featured nopadding-right">
			<a href="{{route('page.article', $oldPost->id)}}">
				<div class="sub-featured-inner">
					<div class="sub-featured-img" style="background-image:url('{{asset('uploads/post/squareMedium_'.$oldPost->image)}}');"></div>

					<h2>{{$oldPost->heading}}</h2>
					<div class="time">
						@if($oldPost->image !== '')
			            	<abbr class="timeago" title="{{$oldPost->published_at}}"></abbr>
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