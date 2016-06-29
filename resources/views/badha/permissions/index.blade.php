@extends('layouts.badha')

@section('sub-nav')
   @include('badha.users.nav')
@endsection

{{-- Web site Title --}}
@section('title', 'All permissions')

@section('content')
<section class="roles">
  <button onclick="location.href='{{route('permission.create')}}'" class="ui default button " style="float:right; margin-top:-5px; margin-bottom:15px;">
  <i class="icon users"></i>
  Add New
  </button>
  @if ($permissions->count())

	<table class="ui very basic definition celled blue table">
  	<thead class="full-width">
    	<tr>
    		<th>Name</th>
    		<th>Description</th>
  			<th>Actions</th>
  		</tr>
  	</thead>
  	<tbody>
  	@foreach ($permissions as $permission)
      <tr>
      		<td ><i class="tiny circular privacy  inverted teal icon " style="margin-left:10px; margin-right:5px;"></i>{{ $permission->name }}</td>
          <td>{{ $permission->description }}</td>

          <td>
      			<button onclick="location.href='{{ route('permission.edit', $permission->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>

            @if(!$currentUser->hasAccess([$permission->name]))
            <form method="post" action="{{ route('permission.delete', $permission->id) }}" style="display:inline;">
              <!-- CSRF Token -->
              {!! csrf_field() !!}
              {!! method_field('delete') !!}
              <button  class="delete tiny ui red button"><i class="erase icon"></i>Delete</button>
            </form>
            @endif
          </td>
    	</tr>
    	@endforeach
 	 </tbody>
	</table>

	<div class="pull-right">
		{!! $permissions->render() !!}
	</div>

  @else
  <div class="well">

    Nothing to show here.

  </div>
  @endif

</section>


@stop



