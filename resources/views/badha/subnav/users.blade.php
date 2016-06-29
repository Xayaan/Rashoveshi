<div class="ui  small centered pointing  nomargin menu" style="text-align:center !important;border-radius: 0px;">
   <div class="ui container ">
		<a href="{{ URL::route('users.index')}}" class="item  {{ URL::route('users.index') === URL::current() ? 'active' : '' }}">All</a>
    	<a href="{{ URL::route('roles.index')}}" class="item  {{ URL::route('roles.index') === URL::current() ? 'active' : '' }}">Roles</a>
	</div>
</div>