@extends('rashoveshi.layouts.default')

@section('content')
<div class="main-area">
	<div class="row ">
		<div class="large-12 column nopadding report-bar">
			ރަށޮވެށިއަށް ޚަބަރެއް ދެއްވުމަށް: 7422233 / 9572233
		</div>
		<div class="clearfix"></div>

		@include('rashoveshi.home.breaking-home', $featuredPosts)
		<div class="large-8 medium-12 column right nopadding">
			{{-- Featured --}}
			@include('rashoveshi.home.featured-home')
			@if(!isset($poll))
				@include('rashoveshi.home.old-listing')
			@endif
		</div>

		{{-- Recent and Populars --}}
		<div class="large-4 column left recents-popular nopadding-left show-for-large-up">
			{{-- TABS --}}
			@include('rashoveshi.home.recent-listing-home', $recentPosts)
			@include('rashoveshi.polls.latest-poll')
		</div>
	</div>
</div>

<div class="home-sectionals">
	@include('rashoveshi.home.section-home', [$categories, $advs])
</div>
@stop