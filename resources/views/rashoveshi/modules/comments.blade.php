<div class="comment-msg" style="display:none;">

</div>

{!! Form::open(['url'=>'comments','class'=>'comment-form','enctype'=>"multipart/form-data",'id'=>'comments-form']) !!}
	{!! Form::hidden('parent', null,['class'=>'parent-id']); !!}
	{!! Form::hidden('post_id', $post->id); !!}

	<div class="row">
	    <div class="large-12 columns">
	        {!! Form::text('name',null,['placeholder'=>'ނަން','class'=>'atk comment-name','required'=>'true','autocomplete'=>'off']) !!}
	    </div>
	</div>

	<div class="row">
	    <div class="large-12 columns">
	        {!! Form::textarea('comment',null,['placeholder'=>'ޚިޔާލު ފާޅުކުރައްވާ','rows'=>'3','id' => 'comments1', 'class'=>'atk comment-detail','required'=>'true']) !!}
	    </div>
	</div>

	<div class="row">
	    <button type="submit" class="button button-primary post-comment submit-comment-btn">ކޮމެންޓު ފޮނުވާ</button>
	</div>
{!! Form::close() !!}

{{-- END OF COMMENTS FORM --}}

<ul class="comment-list">
@if($post->comments)
@foreach($post->comments as $comment)
    <li class="{{$comment->id}}">
        <i class="fa fa-commenting-o"></i>
        <h2>{{$comment->name}}</h2>
        <abbr class="timeago" title="{{$comment->created_at}}"></abbr>
        <div class="clear"></div>
        <p>{{$comment->comment}}</p>
        <div class="meta">
            <div class="reactions" data-comment-id="{{$comment->id}}">
              	<div class="positive <?php if (isset($_COOKIE['comment_r_' . $comment->id]) && $_COOKIE['comment_r_' . $comment->id] == "positive") {echo "active";}
?> " data-count="{{$comment->positive}}">
                	<i class="fa fa-thumbs-up"></i>
                	<span>{{$comment->positive}}</span>
              	</div>
              	<div class="negative <?php if (isset($_COOKIE['comment_r_' . $comment->id]) && $_COOKIE['comment_r_' . $comment->id] == "negative") {echo "active";}
?> " data-count="{{$comment->negative}}">
                	<i class="fa fa-thumbs-down"></i>
                	<span>{{$comment->negative}}</span>
              	</div>
            </div>

            <div class="reply" data-id="{{$comment->id}}">
              	<i class="fa fa-reply"></i>
              	<span>REPLY</span>
            </div>

          </div>
        </li>
@endforeach
@endif

@section('scripts')
<script>
CKEDITOR.plugins.addExternal( 'smiley', '/build/js/ckeditor/plugins/smiley/', 'plugin.js' );
CKEDITOR.replace('comments1', {
    customConfig: '/build/js/ckeditor/smiley.conf.js',
    extraPlugins: 'smiley',
});
</script>
@stop

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('comments.form').on('click','submit-comment-btn',function(e){
			e.preventDefault();
			alert('asd');
		});
	})
</script>
@endsection
