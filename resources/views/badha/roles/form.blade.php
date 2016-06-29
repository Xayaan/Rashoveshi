@extends('layouts.badha')

@section('sub-nav')
   @include('badha.users.nav')
@endsection

{{-- Web site Title --}}
@section('title', $role->exists === false ? 'Create Role' : 'Update Role')

@section('content')
  	<form  method="post" action="" class="ui form user-form" autocomplete="off" data-newuser="{{ $role->exists === false ? 'true' : 'false' }}">
	{!! csrf_field() !!}


			<div class="field {{ $errors->first('name', ' error') }}">
				<label>Name</label>
	    		<input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" placeholder="Enter the role  name.">
			</div>

			<div class="field {{ $errors->first('slug', ' error') }}">
				<label>Slug</label>
			    <input type="text" name="slug" id="slug" value="{{ old('slug', $role->slug) }}" placeholder="Enter the role slug.">
			</div>

			<div class="field {{ $errors->first('permissions', ' error') }}">
				<label>Permissions</label>
			</div>

			<table class="ui compact celled  table">
			  <thead>
			    <tr>
			      <th class="one wide">Allow</th>
			      <th class="one wide">Deny</th>
			      <th>Permission</th>
			      <th>Description</th>

			    </tr>
			  </thead>
			<tbody>
				@foreach($permissions as $permission)
					@if(isset($role->permissions) && array_key_exists($permission->name, $role->permissions))
						@if($role->permissions["$permission->name"] == "true")
							<td class="collapsing center aligned">
								<input type="radio" name="permissions[{{$permission->name}}]"  value="true" checked><label></label>
							</td>
							<td class="collapsing center aligned">
								<input type="radio" name='permissions[{{$permission->name}}]' value="false" >
							</td>
						@else
							<td class="collapsing center aligned">
				    			<input type="radio" name='permissions[{{$permission->name}}]' value="true" >
							</td>
							<td class="collapsing center aligned"><input type="radio" name='permissions[{{$permission->name}}]'  checked value="false">
						</td>
						@endif
					@else
						<td class="collapsing center aligned"><input type="radio" name='permissions[{{$permission->name}}]' value="true" ></td>
						<td class="collapsing center aligned"><input type="radio" name='permissions[{{$permission->name}}]'  value="false" checked></td>
					@endif


						<td>{{$permission->name}}</td>
						<td>{{$permission->description}}</td>
					</tr>
				@endforeach
			  {{-- 	<option value="{{$qualification->id}}" @if(isset($userQualifications)){{in_array($qualification->id, $userQualifications) ? ' selected="selected"' : null }} @endif>{{$qualification->name}}</option>

 --}}			  </tbody>
</table>

	<button  class="ui button">Discard</button><!--{{ route('roles.index') }} -->
	<button type="submit"class="ui primary button"> Save</button>
	@if ($role->exists === true && $role->users->count() === 0)
	<button onclick="location.href='{{ route('role.delete', $role->id) }}'" class="delete ui red button"><i class="erase icon"></i>Delete</button>
	@endif

	</form>







	<script type="text/javascript">


		$('.ui.checkbox').checkbox();
	</script>
</section>
@stop



