@extends('rashoveshi.layouts.default')

@section('content')
<div class="row article-view">
    <div class="large-12 column nopadding report-bar">
      ރަށޮވެށިއަށް ޚަބަރެއް ދެއްވުމަށް: 7422233 / 9572233
    </div>
    <div class="clearfix"></div>
 <div class="article large-8 column">
  <h1>{{$post->heading_detailed}}</h1>

  <div class="article-meta" style="">
   @if($post->published_at !== '')
   {{$post->published_at}}
   @endif
   <div class="share show-for-small-only">
    <a class="viberBtn show-for-small-only" href="viber://forward?text={{$post->heading_detailed}} http://rashoveshi.mv/{{ $post->id }}">
      <img src="{{asset('images/viber_share.png')}}">
    </a>
    <div class="tw">
      <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://rashoveshi.mv/{{ $post->id }}" data-via="rashoveshi">Tweet</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </div>
    <div class="fb">
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1766878270206798";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <div class="fb-like" data-href="http://rashoveshi.mv/{{ $post->id }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
    </div>
  </div>
</div>
<div class="clearfix"></div>

@if($post->image !=='')
<div class="article-img">
 <div class="article-image" style="background-image:url('{{ asset('uploads/post/big_'.$post->mainImage->filename)}}')"></div>
 @if($post->mainImage->caption !=='')
 <div class="pic-caption">
   <p>{{$post->mainImage->caption}}</p>
 </div>
 @endif
</div>
@endif

<div class="top-article-ads">
<!--  <div class="top-article-ad-image" style="background-image:url('images/ads/article-inads.png')"></div>
 -->

   @if(empty($advs['article_top']))
      <div class="bottom-article-ad-image" style="background-image:url('images/ads/article-inads.png')"></div>

   @else
<a href="https://foodhub.mv">
<?php
$ads = $advs['article_top'];
shuffle($ads)
?>

   <div class="hide-for-small show-for-medium bottom-article-ad-image" style="background-image:url('uploads/adv/<?php echo $ads[0]['desktop']; ?>')"></div>
  </a>
  <a href="https://foodhub.mv">
   <div class="hide-for-medium hide-form-large show-for-only-small bottom-article-ad-image" style=" background-position: center;
 background-repeat:no-repeat; border:none !important;  background-image:url('uploads/adv/<?php echo $ads[0]['mobile']; ?>')"></div>
</a>
   @endif

</div>

{{-- Article Main --}}
@if($post->content_text !== '')
<?php $content = json_decode($post->content_text);?>

@foreach ($content as $idx => $value)

@if ($value->type =="text")
<p>{!! nl2br($value->source) !!}</p>
@endif


@if ($value->type == 'image')
<figure>
  <img src="{{asset('uploads/post/'. $value->source)}}" alt="">
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

{{-- Article Main End --}}
<div class="clearfix"></div>



<div class="commentsBar">
  <h3>ކިޔުންތެރިންގެ ހިޔާލު</h3>
  @include('rashoveshi.modules.comments', $post->comments)
</div>
</div>
<div class="large-4 column article-sidebar nopadding">
  <div class="post-sidemeta hide-for-small-only">
   <h3>ލިޔުނީ</h3>
   <div class="right author-avatar large-2 column">
    <img src="{{asset('uploads/avatar/'. $post->author->avatar)}}">
  </div>
  <div class="left author-text large-10 column">
    <h6>{!!$post->author->name!!}</h6>
  </div>
  <div class="clearfix"></div>
  <div class="large-12 sharer">
    <div class="share">
      <a class="viberBtn show-for-small-only" href="viber://forward?text={{$post->heading_detailed}} http://rashoveshi.mv/{{ $post->id }}">
        <img src="{{asset('images/viber_share.png')}}">
      </a>
      <div class="tw">
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://rashoveshi.mv/{{ $post->id }}" data-via="rashoveshi">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      </div>
      <div class="fb">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1766878270206798";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="http://rashoveshi.mv/{{ $post->id }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
@include('rashoveshi.polls.latest-poll')
<div class="latest-side">
 <h3>އެންމެ ފަސް</h3>
 <ul class="newslisting" style="">
  @foreach($recentPosts as $post)
  <li><a href="{{route('page.article', $post->id)}}" class="font2 " data-id="54353">{{$post->heading}}</a></li>
  @endforeach
</ul>
</div>

<div class="clearfix"></div>
<div class="ad">


     @if(empty($advs['left_skyscrapper']))
       <img src="{{asset('images/ads/article-side.png')}}">

   @else
<?php $ads = $advs['left_skyscrapper'];
shuffle($ads)
?>
          <img class="hide-for-small show-for-medium" src="{{asset('uploads/adv/' . $ads[0]['desktop'] )}}">
          <img class="hide-for-medium hide-form-large show-for-only-small" src="{{asset('uploads/adv/' . $ads[0]['mobile'] )}}">



   @endif


</div>
<div class="bottom-article-ad" style="border:none;">

   @if(empty($advs['article_bottom']))
      <div class="bottom-article-ad-image" style="background-image:url('images/ads/article-inads.png')"></div>
   @else
<?php
$ads = $advs['article_bottom'];
shuffle($ads)
?>
   <div class="hide-for-small show-for-medium bottom-article-ad-image" style="background-image:url('uploads/adv/<?php echo $ads[0]['desktop']; ?>')"></div>
   <div class="hide-for-medium hide-form-large show-for-only-small bottom-article-ad-image" style=" background-position: center;
 background-repeat:no-repeat; border:none !important;  background-image:url('uploads/adv/<?php echo $ads[0]['mobile']; ?>')"></div>

   @endif



</div>

</div>
</div>


@stop
