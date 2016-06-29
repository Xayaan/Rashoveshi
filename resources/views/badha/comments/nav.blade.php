<div class="ui  small centered pointing  nomargin menu" style="text-align:center !important;border-radius: 0px;">
   <div class="ui container ">
		<a href="{{ url('comments') }}" class="item  {{ (Request::is('comments') && Request::get('sort')==null ? 'active' : '') }} ">Published</a>
            <a href="{{ url('comments?sort=pending') }}" class="item  {{ ((Request::get('sort')=='pending') ? 'active' : '') }} ">Pending
            @if($count['pending'] >=1)
                <div class="ui label">{{$count['pending']}}</div>
            @endif
        </a>
    	<a href="{{ url('comments?sort=rejected') }}" class="item  {{ ((Request::get('sort')=='rejected') ? 'active' : '') }} " >Rejected</a>


	</div>
</div>




