@extends('layouts.badha')
@section('sub-nav')
   @include('badha.tags.nav', $types)
@endsection
{{-- Web site Title --}}
@section('title', 'Create Tag')
@section('content')
    {!! Form::model($tag, array('class' =>'ui form tags-form', 'autocomplete' =>'off', 'files' => true)) !!}
    <div class="two fields">
        {{-- Fields on left --}}
        <div class="eight wide field">
        <div class="field {{ $errors->first('type_id', ' error') }}">
                {!! Form::label('type_id','Type')!!}
                <div class="one field">
                    <div class="field">
                        @if(isset($tagType))
                            {!! Form::select('type_id', $designations, $user->designation->id, ['class' => 'ui dropdown']) !!}
                        @else
                            {!! Form::select('type_id', $types, null, ['class' => 'ui dropdown']) !!}
                        @endif
                    </div>
                 </div>
            </div>

            <div class="field {{ $errors->first('name', ' error') }}">
                {!! Form::label('name','Name')!!}
                <div class="one field">
                    <div class="field">
                        {!! Form::text('name',null,['placeholder'=>'Enter a tag name', 'class' => 'thaana']) !!}
                    </div>
                 </div>
            </div>

            <div class="field {{ $errors->first('name', ' error') }}">
                {!! Form::label('name_en','Name EN')!!}
                <div class="one field">
                    <div class="field">
                        {!! Form::text('name_en',null,['placeholder'=>'Enter a tag name', ]) !!}
                    </div>
                 </div>
            </div>

            <div class="field {{ $errors->first('slug', ' error') }}">
                {!! Form::label('slug','Slug')!!}
                <div class="one field">
                    <div class="field">
                        {!! Form::text('slug',null,['placeholder'=>'Enter a tag slug']) !!}
                    </div>
                 </div>
            </div>

            <div class="field {{ $errors->first('layout', ' error') }}">
                {!! Form::label('layout','Layout')!!}
                <div class="one field">
                    <div class="field">
                        {!! Form::text('layout',null,['placeholder'=>'Enter a tag layout']) !!}
                    </div>
                 </div>
            </div>

            <div class="field {{ $errors->first('parent_id', ' error') }}">
                {!! Form::label('parent_id','Parent ID')!!}
                <div class="one field ui search selection dropdown">
                    {!! Form::hidden('parent_id',null,['id'=>'parent_id']) !!}
                    <i class="dropdown icon"></i>

                    {{ $psearch = null }}

                    {!! Form::text('parent_search',$psearch,['placeholder'=>'','class'=>'search thaana thaana_bold',"autocomplete"=>"off"]) !!}
                    <div class="default text">{{$psearch}}</div>
                </div>
             </div>



        </div>

        <div class="one field">

            <div class="field">
                {!! Form::label('Avatar','Avatar')!!}
                <div class="ui one card fluid" style="margin:0px !important;">
                    @if(isset($tag) && $tag->avatar == '')
                        <div id="avatarimage" class="profilecreate dropzone" data-img-type="tag" style="padding:0px;"></div>
                        {!! Form::hidden('avatar',null,['id'=>'avatarimage_upload']) !!}
                    @else
                        {!! Form::hidden('avatar',null,['id'=>'avatarimage_upload']) !!}
                        <div id="avatarimage" data-img-name="{{$tag->avatar}}" data-img-type="tag" class="profilecreate dropzone" style="padding:0px;"></div>
                    @endif
                </div>
            </div>

             <div class="field">
                {!! Form::label('og','Open Graph Image')!!}
                <div class="ui one card fluid" style="margin:0px !important;">
                    <div class="ui one card fluid" style="margin:0px !important;">
                    @if(isset($tag) && $tag->og == '')
                        <div id="ogimage" class="profilecreate dropzone" data-img-type="tag" style="padding:0px;"></div>
                        {!! Form::hidden('og',null,['id'=>'ogimage_upload']) !!}
                    @else
                        {!! Form::hidden('og',null,['id'=>'ogimage_upload']) !!}
                        <div id="ogimage" data-img-name="{{$tag->og}}" data-img-type="tag" class="profilecreate dropzone" style="padding:0px;"></div>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>



    <hr>
    <button class="ui button">Discard</button>
    <button type="submit"class="ui primary button"> Save</button>
    {!! Form::close() !!}

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $('.ui.search').dropdown({
            forceSelection:false,
            minCharacters : 1,
            allowAdditions: false,
            apiSettings: {
              url: '/tags/search?text={query}',
            }
        });

        /** Slugify */
        $("#name").on("change", function(e) {
            var slug = Badha.Utils.Slugify(this.value);
            $("#slug").val(slug);
         });

    });
    /** Initialize Dropzones */
    Badha.Utils.Dropzone('#avatarimage');
    Badha.Utils.Dropzone('#ogimage');
</script>































<script>
	$(document).ready(function(){
		$('.ui.search')
		  .dropdown({
		  	forceSelection:false,
		  	minCharacters : 1,
		  	allowAdditions: false,
		    apiSettings: {
		      url: '/tags/search?text={query}',
		    }
		  })
		;


		$('#name_en').change(function() {
		    $(this).val($.trim($(this).val()));
		    // Trim empty space

		    $(this).val($(this).val().replace(/\s+/g,' '));
		    // replace more then 1 space with only one

		    $('#slug').val($(this).val().toLowerCase());
		    $('#slug').val($('#slug').val().replace(/\W/g, ' '));
		    $('#slug').val($.trim($('#slug').val()));
		    $('#slug').val($('#slug').val().replace(/\s+/g, '-'));
		});

		$("#color").change(function(){
		  $("#cover_color").val($(this).val());
		});

	});


</script>
@endsection