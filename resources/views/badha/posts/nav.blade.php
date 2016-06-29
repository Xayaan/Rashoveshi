<div class="ui  small centered pointing  nomargin menu" style="text-align:center !important;border-radius: 0px;">
   <div class="ui container ">
        <a href="{{ url('posts') }}" class="item  {{ (Request::is('posts') && Request::get('sort')==null ? 'active' : '') }} ">Published</a>
        <a href="{{ url('posts?sort=drafts') }}" class="item  {{ ((Request::get('sort')=='drafts') ? 'active' : '') }} " >Drafts

        @if($count['drafts'] >=1)
            <div class="ui label">
                {{$count['drafts']}}
            </div>
        @endif

        </a>
    	@if(Sentinel::hasAccess(['post.review']))
    		<a href="{{ url('posts?sort=review') }}" class="item  {{ ((Request::get('sort')=='review') ? 'active' : '') }} ">Review
    		@if($count['review'] >=1)
    			<div class="ui label">{{$count['review']}}</div>
    		@endif
    	</a>
    	@endif

    	{{-- <a href="{{ URL::route('permissions.index')}}" class="item  {{ URL::route('permissions.index') === URL::current() ? 'active' : '' }}">New</a> --}}
	</div>
</div>




