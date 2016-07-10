@extends('layouts.badha')

@section('sub-nav')
<div class="ui  small centered pointing  nomargin menu" style="text-align:center !important;border-radius: 0px;">
   <div class="ui container ">
        <a href="{{ url('posts') }}" class="item  {{ (Request::is('posts') && Request::get('sort')==null ? 'active' : '') }} ">Published</a>
        <a href="{{ url('posts?sort=drafts') }}" class="item  {{ ((Request::get('sort')=='drafts') ? 'active' : '') }} " >Drafts
      @if(isset($count))
        @if($count['drafts'] >=1)
            <div class="ui label">
                {{$count['drafts']}}
            </div>
        @endif
       @endif

        </a>
      @if(Sentinel::hasAccess(['post.review']))
        <a href="{{ url('posts?sort=review') }}" class="item  {{ ((Request::get('sort')=='review') ? 'active' : '') }} ">Review
       @if(isset($count))
        @if($count['review'] >=1)
          <div class="ui label">{{$count['review']}}</div>
        @endif
       @endif
      </a>
      @endif

      {{-- <a href="{{ URL::route('permissions.index')}}" class="item  {{ URL::route('permissions.index') === URL::current() ? 'active' : '' }}">New</a> --}}
  </div>
</div>






@endsection
{{-- Web site Title --}}
@section('title', $post->exists === false ? 'Create Post' : 'Update Post')

@section('content')
	{!! Form::model($post, array('class' =>'ui form post-form', 'autocomplete' =>'off', 'files' => true)) !!}

		<div class="ui two fields ">
		{{-- Fields on left --}}
			<div class="sixteen wide field" style=" border-right: 1px solid rgb(232, 232, 232);">

				<div class="field {{ $errors->first('heading', ' error') }}">
					<div class="one field">
					    <div class="field rtl">
						    {!! Form::text('heading',null,['placeholder'=>'ސުރުޚީ', 'class' => 'thaana thaana_bold rtl heading_field']) !!}
					    </div>
					 </div>
				</div>

				<div class="field {{ $errors->first('heading_detailed', ' error') }}">
					<div class="one field">
					    <div class="field">
						    {!! Form::text('heading_detailed',null,['placeholder'=>'ދިގު ސުރުޚީ', 'class' => 'thaana thaana_bold rtl heading_field']) !!}
					    </div>
					 </div>
				</div>

				<div class="field {{ $errors->first('heading_latin', ' error') }}">
					<div class="one field">
					    <div class="field">
						    {!! Form::text('heading_latin',null,['placeholder'=>'Latin Heading', 'class' => 'englishtext heading_field']) !!}
					    </div>
					 </div>
				</div>

				<div class="field {{ $errors->first('summary', ' error') }}">
					<div class="one field">
					    <div class="field">
						    {!! Form::text('summary',null,['placeholder'=>'ޚުލާޞާ', 'class' => 'thaana rtl heading_field']) !!}
					    </div>
					 </div>
				</div>

				<div class="field">
				<div class="ui one card fluid" style="margin:0px !important;">
					@if(isset($post) && $post->image == '')
						<div id="profileimage" class="profilecreate dropzone" data-img-type="post" style="padding:0px;"></div>
						{!! Form::hidden('image',null,['id'=>'profileimage_upload']) !!}
					@else
						{!! Form::hidden('image',null,['id'=>'profileimage_upload']) !!}
						<div id="profileimage" data-img-name="{{$post->image}}" data-photoid="{{$post->mainImage->id}}" data-img-type="post" class="profilecreate dropzone" style="padding:0px;"></div>
					@endif
				</div>
			</div>

				<div class="field {{ $errors->first('content', ' error') }}">
					{!! Form::textarea('content', null, ['placeholder'=>'ކެޕްޝަން', 'id' => 'editor', 'class' => 'thaana']) !!}
				</div>
			</div>

			{{-- Fields on Right --}}
			<div class="seven wide field">

				<div class="field {{ $errors->first('status', ' error') }}">
					{!! Form::label('status','Status')!!}
					<div class="field">
					   <div class="ui  dropdown button fluid">
							{!! Form::hidden('status',null) !!}
							<span class="text">Status</span>
							<div class="menu">
								<div class="item" data-value="0">Draft</div>
							    <div class="item" data-value="2">Review</div>
							    @if(Sentinel::hasAnyAccess(['user.*']))
							    	<div class="item" data-value="1">Publish</div>
							    @endif
							</div>
						</div>
					</div>
				</div>

				<div class="field {{ $errors->first('status', ' error') }}"></div>


				<div class="field cat-tag-search">
			{!! Form::label('tag','Category & Tags')!!}
			<label for="tag" >
				<div class="one field main_tag_field">
					<div class="ui label">
					Main: <div class="detail thaana thaana_bold">@if (isset($post->parentTag->name)){{ $post->parentTag->name }}@endif</div>
					</div>
					{!! Form::hidden('tag',null,['class'=>'main_tag']) !!}
				</div>
			</label>

		    <div class="ui fluid multiple search cat-search selection dropdown main-tag">
				{!! Form::hidden('tags_list',$tags,['id'=>'tags']) !!}
				<i class="dropdown icon"></i>

				<div class="menu rtl">
					@foreach ($categories as $idx => $cagtegory)
						<div class="item thaana thaana_bold rtl" data-value="{{ $idx}}">
							<img class="ui avatar image" src="{{ asset('images/icons/tags-Category.png')}}" alt=""> {{ $cagtegory }}
						</div>
					@endforeach

					@foreach($post->tags as $tags)
						<div class="item thaana thaana_bold rtl" data-value="{{ $tags->id }}">
							<img class="ui avatar image" src="{{ asset('images/icons/tags-'.$tags->type->name.'.png')}}" alt="">
						{{$tags->name}}
						</div>
					@endforeach

				</div>

				{!! Form::text('parent_search',null,['placeholder'=>'','class'=>'rtl search atk thaana thaana_bold',"autocomplete"=>"off"]) !!}
				<div class="default text"></div>
		    </div>

		</div>

		<div class="field author-search">
			{!! Form::label('authors','Authors')!!}
		    <div class="ui floating  dropdown selection fluid">

		    	{{-- @endif --}}
				{!! Form::hidden('created_by',$userAuthor,['id'=>'authors']) !!}
				<i class="dropdown icon"></i>

				<div class="menu rtl">
					@foreach ($authors as $author)
						<div class="item thaana thaana_bold rtl" data-value="{{ $author->id }}">
						<img class="ui mini avatar image" src="{{asset('uploads/avatar/'.$author->avatar)}}">{{ $author->name }}</div>
					@endforeach
				</div>
				<div class="default text"></div>
		    </div>
		</div>


		@if(Sentinel::hasAccess(['post.publish']))
		<div class="field ">
		 	{!! Form::label('published_at','Publish Date/Time')!!}
			<div class="one field  ui labeled input">
				<div class="ui label">
     				<i class="calendar icon" style="padding-left:10px;"></i>
  				</div>
			    {!! Form::text('published_at',null,['placeholder'=>'Publish Date/Time','class'=>'published_at']) !!}
			</div>
		</div>
		@endif
		<div class="field" style="margin-top:8px;">
			<button  class="ui button">Discard</button><!--{{ route('roles.index') }} -->
			<button type="submit"class="ui primary button"> Save</button>
		</div>
		</div>
			{{-- End of Fields of RIGHT --}}
		</div>



	</form>




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
/*CKEDITOR.replace('editor', {
    customConfig: '/build/js/ckeditor/basic.conf.js',
});*/

//$('#editor').redactor();

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

Badha.Utils.Dropzone('#profileimage');
























</script>


@endsection

