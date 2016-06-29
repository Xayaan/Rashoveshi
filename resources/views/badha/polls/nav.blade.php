<div class="ui  small centered pointing  nomargin menu" style="text-align:center !important;border-radius: 0px;">
   <div class="ui container ">
			<a href="{{ URL::route('tag.index')}}" class="item  {{Request::is('tags') && Request::get('sort')==null ? 'active' : '' }} ">All Tags</a>
   		@foreach($types as $idx => $name)
			    <a class="item {{ ((Request::get('sort')==$idx) ? 'active' : '') }} " href="{{ url('tags?sort=') }}{{ $idx }}">{{ $name }}</a>

	    @endforeach
	</div>
</div>
