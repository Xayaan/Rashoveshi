@extends('layouts.badha')

{{-- Web site Title --}}
@section('title', 'Create Advs')

@section('content')


	{!! Form::model($adv, array('class' =>'ui form adv-form', 'autocomplete' =>'off', 'files' => true)) !!}

	<div class="two fields">
		{{-- Fields on left --}}
		<div class="eleven wide field">

			<div class="field {{ $errors->first('name', ' error') }}">
				{!! Form::label('name','Name ')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('name',null,['placeholder'=>'Name']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('targe', ' error') }}">
				{!! Form::label('target','Target')!!}
				<div class="one field">
				    <div class="field">
					    {!! Form::text('target', null,['placeholder'=>'http://target.com/?uta...']) !!}
				    </div>
				 </div>
			</div>

			<div class="field {{ $errors->first('position', ' error') }}">
				{!! Form::label('position','Position')!!}
				<div class="one field">
				    <div class="field">
				    	@if(isset($adv))
						<div class="ui dropdown button">
						<?php $adv->position = $adv->page . ',' . $adv->position;?>
													{!! Form::hidden('position',null) !!}

						  	<span class="text">Choose Position</span>
						  	<i class="dropdown icon"></i>
						  	<div class="menu">
						    	<div class="item">
						      	<i class="dropdown icon"></i>
						      	<span class="text">Homepage</span>
						      	<div class="menu">
						        		<div data-value="home,leaderboad" class="item">Leaderboard</div>
						        		<div data-value="home,middleads_1" class="item">Middleads 1</div>
						        		<div data-value="home,middleads_2" class="item">Middleads 2</div>
						        		<div data-value="home,middleads_3" class="item">Middleads 3</div>
						        		<div data-value="home,middleads_4" class="item">Middleads 4</div>
						        		<div data-value="home,bottom" class="item">Bottom</div>
						      	</div>
						    	</div>

						    	<!-- Article -->
						    	<div class="item">
						      	<i class="dropdown icon"></i>
						      	<span class="text">Article</span>
						      	<div class="menu">
						        		<div data-value="article,leaderboad" class="item">Leaderboard</div>
						        		<div data-value="article,left_skyscrapper" class="item">Left Skyscrapper</div>
						        		<div data-value="article,article_top" class="item">Article Top</div>
						        		<div data-value="article,article_bottom" class="item">Article Bottom</div>
						      	</div>
						    	</div>
						  	</div>
						</div>
					  	@else
					  		{!! Form::select('position', $page.','.$position, null, ['class' => 'ui dropdown search selection']) !!}
				    	@endif
				   </div>
				</div>
			</div>

			<div class="field">
				{!! Form::label('Desktop','Desktop')!!}
				<div class="ui one card fluid" style="margin:0px !important;">
					@if(isset($adv) && $adv->desktop == '')
						<div id="desktopimage" class="profilecreate dropzone" data-img-type="adv" style="padding:0px;"></div>
						{!! Form::hidden('desktop',null,['id'=>'desktopimage_upload']) !!}
					@else
						{!! Form::hidden('desktop',null,['id'=>'desktopimage_upload']) !!}
						<div id="desktopimage" data-img-name="{{$adv->desktop}}" data-img-type="adv" class="profilecreate dropzone" style="padding:0px;"></div>
					@endif
				</div>
			</div>

			<div class="field">
				{!! Form::label('Mobile','Mobile')!!}
				<div class="ui one card fluid" style="margin:0px !important;">
					@if(isset($adv) && $adv->mobile == '')
						<div id="mobileimage" class="profilecreate dropzone" data-img-type="adv" style="padding:0px;"></div>
						{!! Form::hidden('mobile',null,['id'=>'mobileimage_upload']) !!}
					@else
						{!! Form::hidden('mobile',null,['id'=>'mobileimage_upload']) !!}
						<div id="mobileimage" data-img-name="{{$adv->mobile}}" data-img-type="adv" class="profilecreate dropzone" style="padding:0px;"></div>
					@endif
				</div>
			</div>
		</div>
		{{-- End of fields on left --}}

		{{-- Fields on right --}}
		<div class="one field">








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
	Badha.Utils.Dropzone('#mobileimage');
	Badha.Utils.Dropzone('#desktopimage');

</script>
@endsection
