@extends('layouts.badha')

@section('sub-nav')
   @include('badha.users.nav')
@endsection
{{-- Web site Title --}}
@section('title', $permission->exists === false ? 'Create Permission' : 'Update Permission')

@section('content')
  	<form  method="post" action="" class="ui form user-form" autocomplete="off" data-newuser="{{ $permission->exists === false ? 'true' : 'false' }}">
	{!! csrf_field() !!}


			<div class="field {{ $errors->first('name', ' error') }}">
				<label>Name</label>
	    		<input type="text" name="name"  value="{{ old('name', $permission->name) }}" placeholder="Enter the permission  name.">
			</div>

			<div class="field {{ $errors->first('description', ' error') }}">
				<label>Description</label>
			    <input type="text" name="description"  value="{{ old('description', $permission->description) }}" placeholder="Enter the permission description">
			</div>

			<button  class="ui button">Discard</button><!--{{ route('roles.index') }} -->
			<button type="submit"class="ui primary button"> Save</button>

			@if(!$currentUser->hasAccess([$permission->name]))
            <form method="post" action="{{ route('permission.delete', $permission->id) }}" style="display:inline;">
              <!-- CSRF Token -->
              {!! csrf_field() !!}
              {!! method_field('delete') !!}
              <button  class="delete tiny ui red button"><i class="erase icon"></i>Delete</button>
            </form>
            @endif
	</form>
</section>
@stop



