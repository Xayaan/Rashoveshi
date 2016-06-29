@extends('layouts.badha')


{{-- Web site Title --}}
@section('title', 'Bullets')

@section('content')
	{!! Form::model($bullet, array('class' =>'ui form post-form', 'autocomplete' =>'off', 'files' => true)) !!}

		{!! Form::hidden('post_id', $post->id) !!}
		{!! Form::hidden('id', $bullet->id) !!}

		<div class="ui two fields ">
		{{-- Fields on left --}}
			<div class="six wide field" style=" border-right: 1px solid rgb(232, 232, 232);">

				<div class="field {{ $errors->first('bullet', ' error') }}">
					<div class="editable">
					</div>
					{!! Form::textarea('bullet',$bullet->content,['placeholder'=>'ކެޕްޝަން','class'=>'content', 'style'=>'display:none;']) !!}
				</div>

				<button type="submit"class="ui primary button">Add</button>

			</div>
 	{!! Form::close() !!}

			{{-- Fields on Right --}}
			<div class="ten wide field">
					<h2 class="thaana  rtl heading_field2">{{$post->heading}}</h2>

					<table class="ui very basic definition celled blue table">
					  	<thead class="full-width">
					    	<tr>
					    		<th>Action</th>
					    		<th>Bullet</th>
					  			<th>#</th>
					  		</tr>
					  	</thead>
					  	<tbody>
					  	@foreach ($bullets as $bullet)
					  	   <tr>
					  	   	<td>
      			<a href="{{ route('liveblog.edit', [$post->id, $bullet->id]) }}" class="edit mini ui default button">Edit</a>


           
            <form method="post" action="{{ route('liveblog.delete', $bullet->id) }}" style="display:inline;">
              <!-- CSRF Token -->
              {!! csrf_field() !!}
              {!! method_field('delete') !!}
              <button  class="delete mini ui red button">Delete</button>
            </form>
          </td>
					      	<td class="rtl">
					      		@if($post->content_text !== '')
										<?php $content = json_decode($bullet->content_text);?>

										@foreach ($content as $idx => $value)

										@if ($value->type =="text")
										<p>{!! nl2br($value->source) !!}</p>
										@endif


										@if ($value->type == 'image')
										<figure>
										  <img src="{{asset('uploads/post/square_'. $value->source)}}" alt="">
										  @if(array_key_exists("markup",$value) && $value->markup->caption !== '')
										  <figcaption>{{$value->markup->caption}}</figcaption>
										  @endif
										</figure>
										@endif

										@if ($value->type == 'embed')
										<div class="embed" data-url="{{$value->source}}"></div>
										@endif

										@endforeach
										@endif	






					      	</td>
					      						    						      	<td>{{$bullet->id}}</td>

					    	</tr>

					    	@endforeach
					 	 </tbody>
					 </table>





			</div>

		</div>
		</div>
			{{-- End of Fields of RIGHT --}}
		</div>




{{-- MODEL --}}

<div class="ui small modal">
  	<div class="header">Update Photo</div>
  	<div class="image content">
	   	<img class="image small caption_image">
	   	<div class="description">
	   		<div class="ui form fluid">
				{!! Form::hidden('photo_id',null,['id'=>"photo_id"]) !!}

	        	<div class="ui rtl field">
			      {!! Form::textarea('caption',null,['placeholder'=>'ކެޕްޝަން','class'=>'thaana thaana_bold rtl caption_field','rows'=>'6', 'cols'=>'80','id'=>'caption_field']) !!}
		    	</div>

			</div>
	   	</div>
  	</div>
  	<div class="actions">
	    <div class="ui cancel button black">Cancel</div>
	    <div class="ui approve button positive">Update</div>
  	</div>
</div>
</section>
@stop

@section('scripts')
<script>
        $.getScript('//platform.twitter.com/widgets.js', function(){
            var k = 0;
            var tweet = document.getElementById('twitter-widget-'+k);
            var tweetParent, tweetID;
            while(tweet) {
                tweetParent = tweet.parentNode;
                tweetID = tweet.dataset.tweetId;
                $(tweet).remove();
                twttr.widgets.createTweet(
                  tweetID,
                  tweetParent
            );
            k++;
            tweet = document.getElementById('twitter-widget-'+k);
            }
        });
/** Set Content Editor */
var ContentEditor = new MediumEditor('.editable',{
	extensions: {
        'thaanakbd': new MediumEditor.extensions.thaanaKbd(),
    },
    placeholder: {
        text: '...'
    }
});

$(document).on("click",".post-form .dz-preview",function(e){
	e.preventDefault();
	var id = $('#profileimage').data('photoid');
	var photo = $('#profileimage').data('img-name');

	url = '/uploads/post/square_' + photo;

  	Badha.Photo.GetById(id,function(data){
  		var caption = data.caption;

  		$('.caption_field').val(caption);
	  	$('.caption_image').attr('src', url);

  	});

  	$('.ui.modal').modal({
    	blurring: true,
    	onApprove : function() {
    		var _data = {};
		  		_data['id'] = id;
		  		_data['caption'] = $('#caption_field').val();

     	 	Badha.Photo.UpdateById(_data);
    	}
  	}).modal('show');

});


$(document).ready(function(){
	$('.thaana').thaana({keyboard: 'phonetic'});

	$('.ui.search').dropdown({
		forceSelection:false,
		minCharacters : 1,
		apiSettings: {
			url: '/tags/search?text={query}',
		},
	});

	$('.published_at').datetimepicker({
		datepicker:true,
		timepicker:true,
		format:'Y-m-d H:i:s'
	});

	if($('textarea.content').val() !== ''){
		$('.editable').html($('textarea.content').val());
	}
});

$(document).on("click",".cat-tag-search a.label",function(e){
	var tag_value = $(this).html().replace(/<\/?[^>]+(>|$)/g, "");
	$(".main_tag_field .detail").html(tag_value);
	$(".main_tag_field .main_tag").val($(this).data("value"));
	$(this).removeClass("active");
	$('#actionbutton').removeAttr('disabled');
	$('#autosavesettings').removeAttr('disabled');
	return false;
});


$(function () {
	/** Content Editor Options */
	var token = $("meta[name='csrf-token']").attr('content');
	$('.editable').mediumInsert({
	   	editor: ContentEditor,
	   	addons: {
	        images: {
	        	actions:{
	        		caption: {
		                label: '<span class="fa fa-cogs"></span>',
		                clicked: function ($el) {

							var id = $el.data('photoid');
							var photo = $el.data('photoname');
						  	url = '/uploads/post/square_' + photo;

						  	Badha.Photo.GetById(id,function(data){
						  		var caption = data.caption;
						  		$('.caption_field').val(caption);
							  	$('.caption_image').attr('src', url);
							  	Badha.Utils.UpdatePhotoCaption($el, caption);
							  	Badha.Utils.UpdateEditor('textarea', ContentEditor);
							});

							$('.ui.modal').modal({
							   	blurring: true,
							   	onApprove : function() {
							   		var _data = {};
								  		_data['id'] = id;
								  		_data['caption'] = $('#caption_field').val();
							     	 	Badha.Photo.UpdateById(_data, function(resp){
						     	 			Badha.Utils.UpdatePhotoCaption($el, resp.caption);
						     	 			Badha.Utils.UpdateEditor('textarea', ContentEditor);
						     	 		});
						    	}
						  	}).modal('show');
		                },
		            },
		            remove:{
		            	clicked:function($el){
		            		var id = $el.data('photoid');
		            		Badha.Photo.DeleteById(id);

		            		var $event = $.Event('keydown');
	                        $event.which = 8;
    	                    $(document).trigger($event);
		            	}
		            }
	        	},
	            fileUploadOptions: {
	            	preview:false,
	                url: '/upload',
	                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
	                formData:[
	                	{ name:'_token', value:token },
	                	{ name:'_type', value:'post' }
	                ],
	            },
       		    uploadCompleted: function ($el, data) {
       		    	// console.log(data.result);

       		   		$el.find('img').attr('data-photoName',data.result.files[0].name);
       		   		$el.find('img').attr('data-photoID',data.result.files[0].id);

       		    },
       		},

       	}
	});

	/** Update TextArea Content */
	ContentEditor.subscribe('editableInput', function (event, editable) {
	  	Badha.Utils.UpdateEditor('textarea', ContentEditor);
	});

});

// Badha.Utils.Dropzone('#profileimage');
























</script>


@endsection

