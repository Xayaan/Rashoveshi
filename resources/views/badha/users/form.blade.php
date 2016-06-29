@extends('layouts.badha')
@if(Sentinel::hasAnyAccess('user.*'))
	@section('sub-nav')
	   @include('badha.users.nav')
	@endsection
@endif
{{-- Web site Title --}}
@section('title', $user->exists === false ? 'Create User' : 'Update User')  {{ $user->name }}

@section('content')


	{!! Form::model($user, array('class' =>'ui form user-form', 'autocomplete' =>'off', 'files' => true)) !!}

	<div class="two fields">
		{{-- Fields on left --}}
		<div class="eleven wide field" >

			<div class="field {{ $errors->first('first_name', ' error') }}">
				{!! Form::label('first_name','First Name')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('first_name',null,['placeholder'=>'Enter the users first name.']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('middle_name', ' error') }}">
				{!! Form::label('middle_name','Middle Name')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('middle_name',null,['placeholder'=>'Enter the users middle name.']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('last_name', ' error') }}">
				{!! Form::label('last_name','Last Name')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('last_name',null,['placeholder'=>'Enter the users last name.']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('dob', ' error') }}">
				{!! Form::label('dob','Date of birth')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('dob',null,['placeholder'=>'Enter the users date of birth.', 'class' => 'dob']) !!}
				    </div>
				 </div>
			</div>



			<div class="field {{ $errors->first('email', ' error') }}">
				{!! Form::label('email','Email')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::email('email',null,['placeholder'=>'Enter the users email.']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('designation_id', ' error') }}">
				{!! Form::label('designation_id','Designation')!!}
				<div class="one field">
				    <div class="field">
				    	@if(isset($userDesignations))
					   		{!! Form::select('designation_id', $designations, $user->designation->id, ['class' => 'ui dropdown']) !!}
					   	@else
					   		{!! Form::select('designation_id', $designations, null, ['class' => 'ui dropdown']) !!}
				    	@endif
				    </div>
				 </div>
			</div>
	</div>
		{{-- End of fields on left --}}

		{{-- Fields on right --}}
		<div class="one field">
			<div class="field">
				{!! Form::label('Avatar','Avatar')!!}
				<div class="ui one card fluid" style="margin:0px !important;">
					@if(isset($user) && $user->avatar == '')
						<div id="profileimage" class="profilecreate dropzone" data-img-type="avatar" style="padding:0px;"></div>
						{!! Form::hidden('avatar',null,['id'=>'profileimage_upload']) !!}
					@else
						{!! Form::hidden('avatar',null,['id'=>'profileimage_upload']) !!}
						<div id="profileimage" data-img-name="{{$user->avatar}}" data-img-type="avatar" class="profilecreate dropzone" style="padding:0px;"></div>
					@endif
				</div>
			</div>

			@if(Sentinel::hasAnyAccess(['user.*']))
			<div class="field {{ $errors->first('roles', ' error') }}">
				{!! Form::label('roles[]','Roles')!!}
				<div class="one field">
				    <div class="field">
				    	@if(isset($userRoles))
					   		{!! Form::select('roles[]', $roles, $userRoles, ['class' => 'ui dropdown', 'multiple' => 'multiple']) !!}
					   	@else
					   		{!! Form::select('roles[]', $roles, null, ['class' => 'ui dropdown', 'multiple' => 'multiple']) !!}
				    	@endif
				    </div>
				 </div>
			</div>
			@endif

			<div class="field {{ $errors->first('password', ' error') }}">
				{!! Form::label('password','Password')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::password('password',null,['placeholder'=>'Enter the user password (only if you want to modify it).']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('password_confirm', ' error') }}">
				{!! Form::label('password_confirm','Confirm Password')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::password('password_confirm',null,['placeholder'=>'Confirm the user password (only if you want to modify it).']) !!}
				    </div>
				 </div>
			</div>






		</div>
		{{-- End of fields on right --}}




	</div>




		<hr>

		<button class="ui button">Discard</button>
		<button type="submit"class="ui primary button"> Save</button>

		<script type="text/javascript">


			$(document).ready(function(){
				//dropdown
				$('.ui.dropdown').dropdown();

				$('#dob').datetimepicker({
					datepicker:true,
					timepicker:false,
					format:'Y-m-d'
				});
			});




			$newuser = $('.user-form').data('newuser');
			if($newuser === true){
				$('.user-form').form({
			    on: 'blur',
			    fields: {
			      	match: {
			        	identifier  : 'password_confirm',
			        	rules: [{
			            	type   : 'match[password]',
			            	prompt : 'The password and its confirmation are not the same!'
			          	}]
			      	},
			      	email: {
				        identifier  : 'email',
				        rules: [
				          {
				            type   : 'empty',
				            prompt : 'Please enter a value'
				          }
				        ]
			      	},
			      	password: {
				        identifier  : 'password',
				        rules: [
				          {
				            type   : 'empty',
				            prompt : 'Please enter a value'
				          }
				        ]
			      	},
			    }
			 });
			}



		</script>
	</form>

	<div class="text-right">
		@if ($user->exists === true && Sentinel::hasAccess('admin') && $currentUser->id != $user->id)
			@if (Activation::completed($user))
			<a class="btn btn-warning" href="{{ route('user.deactivate', $user->id) }}">Deactivate</a>
			@else
			<a class="btn btn-primary" href="{{ route('user.reactivate', $user->id) }}">Activate</a>
			@endif
			<a href="{{ route('user.delete', $user->id) }}" data-action-delete class="btn btn-danger">Delete</a>
			@endif
			{{-- <a class="btn btn-default" href="{{ route('users.index') }}">Cancel</a> --}}
	</div>

	</form>

	</div>


@endsection


@section('scripts')
<script type="text/javascript">

		Badha.Utils.Dropzone('#profileimage');
</script>
@endsection