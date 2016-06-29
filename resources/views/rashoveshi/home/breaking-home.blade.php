
@if($breaking)
<div class="large-12 column breaking nopadding">
	<h2 class="breaking-title right">
		ކުއްލި ޙަބަރު
	</h2>
	<a href="{{route('page.article', $featuredPosts->p_breaking->id)}}">
		<h3 class="breaking-content right small-12 ">
			{{$featuredPosts->p_breaking->heading}}
		</h3></a>
	</div>
	@endif

	@if($live)
	<div class="large-12 column breaking nopadding">
		<h2 class="breaking-title right">
			ލައިވް ބްލޮގް
		</h2>
		<a href="{{route('page.article', $featuredPosts->p_live->id)}}">
		<h3 class="breaking-content right small-12 ">
			{{$featuredPosts->p_live->heading}}
		</h3></a>
	</div>
	@endif

	@if($developing)
	<div class="large-12 column breaking nopadding">
		<h2 class="breaking-title developing right">
			ނިއުޅެމުންދާ
		</h2>
		<a href="{{route('page.article', $featuredPosts->p_developing->id)}}">
			<h3 class="breaking-content right small-12 ">
				{{$featuredPosts->p_developing->heading}}
			</h3></a>
		</div>
		@endif