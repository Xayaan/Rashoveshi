@extends('layouts.badha')

{{-- Web site Title --}}
@section('title', 'Create Author')

@section('content')


	{!! Form::model($author, array('class' =>'ui form author-form', 'autocomplete' =>'off', 'files' => true)) !!}

	<div class="two fields">
		{{-- Fields on left --}}
		<div class="eleven wide field">

			<div class="field {{ $errors->first('name', ' error') }}">
				{!! Form::label('name','Name ')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('name',null,['placeholder'=>'Enter the authors name.', 'class' => 'thaana']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('name_en', ' error') }}">
				{!! Form::label('name_en','Name EN')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('name_en',null,['placeholder'=>'Enter the authors name.']) !!}
				    </div>
				 </div>
			</div>


			<div class="field {{ $errors->first('post', ' error') }}">
				{!! Form::label('post','Post')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('post',null,['placeholder'=>'Enter the author post.', 'class' => 'thaana']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('post_en', ' error') }}">
				{!! Form::label('post_en','Post EN')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('post_en',null,['placeholder'=>'Enter the authors post.']) !!}
				    </div>
				 </div>
			</div>



			<div class="field {{ $errors->first('twitter', ' error') }}">
				{!! Form::label('twitter','Twitter')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('twitter',null,['placeholder'=>'Enter the authors Twitter ID.']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('facebook', ' error') }}">
				{!! Form::label('facebook','Facebook')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('facebook',null,['placeholder'=>'Enter the authors Facebook ID.']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('user_id', ' error') }}">
				{!! Form::label('user_id','Associated User')!!}
				<div class="one field">
				    <div class="field">
				    	@if(isset($authors))
					   		{!! Form::select('designation_id', $designations, $user->designation->id, ['class' => 'ui dropdown']) !!}
					   	@else
					   		{!! Form::select('user_id', $users, null, ['class' => 'ui dropdown search selection']) !!}
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
					@if(isset($author) && $author->avatar == '')
						<div id="profileimage" class="profilecreate dropzone" data-img-type="avatar" style="padding:0px;"></div>
						{!! Form::hidden('avatar',null,['id'=>'profileimage_upload']) !!}
					@else
						{!! Form::hidden('avatar',null,['id'=>'profileimage_upload']) !!}
						<div id="profileimage" data-img-name="{{$author->avatar}}" data-img-type="avatar" class="profilecreate dropzone" style="padding:0px;"></div>
					@endif
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
				$('.ui.dropdown').dropdown({
					 allowCategorySelection: true
				});

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
	{{-- 	@if ($user->exists === true && Sentinel::hasAccess('admin') && $currentUser->id != $user->id)
			@if (Activation::completed($user))
			<a class="btn btn-warning" href="{{ route('user.deactivate', $user->id) }}">Deactivate</a>
			@else
			<a class="btn btn-primary" href="{{ route('user.reactivate', $user->id) }}">Activate</a>
			@endif
			<a href="{{ route('user.delete', $user->id) }}" data-action-delete class="btn btn-danger">Delete</a>
			@endif
 --}}			{{-- <a class="btn btn-default" href="{{ route('users.index') }}">Cancel</a> --}}
	</div>

	</form>

	</div>


@endsection


@section('scripts')
<script type="text/javascript">

	// Set Dropzone
	Badha.Utils.Dropzone('#profileimage');

	 $('.thaana').thaana({keyboard: 'phonetic'});
</script>
@endsection