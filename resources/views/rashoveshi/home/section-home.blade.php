

<div class="row hide-for-small-only">

<!-- Mid1 -->
@if(empty($advs['middleads_1']))
<div class="large-6 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/middleads.png')}}"></div>
@else
<?php
$ads = $advs['middleads_1'];
shuffle($ads)
?>
<div class="hide-for-small large-6 column middle-subad nopadding-right text-right">
    <a href="{{ $ads[0]['target'] }}" target="_blank"><img src="{{asset('uploads/adv/' . $ads[0]['desktop'] )}}"></a>
</div>
@endif


<!-- Mid2 -->
@if(empty($advs['middleads_2']))
<div class="large-6 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/middleads.png')}}"></div>
@else
<?php
$ads = $advs['middleads_2'];
shuffle($ads)
?>
<div class="hide-for-small large-6 column middle-subad nopadding-right text-right">
    <a href="{{ $ads[0]['target'] }}" target="_blank"><img src="{{asset('uploads/adv/' . $ads[0]['desktop'] )}}"></a>
</div>
@endif


</div>


<!-- Adv -->
<div class="row hide-for-medium hide-for-large bottom-vertical">

<!-- Mid1 -->
@if(empty($advs['middleads_1']))
<div class="large-12 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/bottomad.png')}}"></div>
@else
<?php
$ads = $advs['middleads_1'];
shuffle($ads)
?>
<div class="large-12 column middle-subad text-right" style="padding:20px;">
    <a href="{{ $ads[0]['target'] }}" target="_blank"><img src="{{asset('uploads/adv/' . $ads[0]['mobile'] )}}"></a>
</div>
@endif

</div>



<div class="row sections">
 <div class="large-12 column left nopadding category-news">


  {{--report--}}
  @if(!$categories['report']['featured']->isEmpty())
  <div class="large-6 column sub-featured nopadding-right end" style="padding-left:1px !important;">
    <h3>ރިޕޯޓް<i class="fa fa-list left"></i></h3>
   <a href="{{route('page.article', $categories['report']['featured'][0]->id)}}">
    <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['report']['featured'][0]->image)}}');"></div>
    <h4>{{$categories['report']['featured'][0]->heading}}</h4>
 </a>
 @if(!$categories['report']['subs']->isEmpty())
 <div class="section-more">
    <ul>
     @foreach($categories['report']['subs'] as $post)
     <li>
      <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
        <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}'); height:100%;"></div>
     </a>
     <a href="#" class="right ssiil large-9 nopadding-left column">{{$post->heading}}<br>
        <abbr class="timeago" title="{{$post->published_at}}"></abbr>
     </a>
     <div class="clearfix"></div>
  </li>
  @endforeach
</ul>
</div>
@endif
</div>
@endif
{{--BUSINESS--}}
@if(!$categories['business']['featured']->isEmpty())
<div class="large-6 column sub-featured nopadding-right end">
   <h3> ވިޔަފާރި <i class="fa fa-line-chart left"></i></h3>
  <a href="{{route('page.article', $categories['business']['featured'][0]->id)}}">
   <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['business']['featured'][0]->image)}}');"></div>
   <h4>{{$categories['business']['featured'][0]->heading}}</h4>
</a>
@if(!$categories['business']['subs']->isEmpty())
<div class="section-more">
   <ul>
    @foreach($categories['business']['subs'] as $post)
    <li>
     <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
       <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}'); height:100%;"></div>
    </a>
    <a href="#" class="right ssiil large-9 nopadding-left column">{{$post->heading}}<br>
       <abbr class="timeago" title="{{$post->published_at}}"></abbr>
    </a>
    <div class="clearfix"></div>
 </li>
 @endforeach
</ul>
</div>
@endif
</div>
@endif


<!-- Adv -->
<div class="row hide-for-medium hide-for-large bottom-vertical">

<!-- Mid3 -->
@if(empty($advs['middleads_2']))
<div class="large-12 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/bottomad.png')}}"></div>
@else
<?php
$ads = $advs['middleads_2'];
shuffle($ads)
?>
<div class="large-12 column middle-subad text-right" style="padding:20px;">
    <a href="{{ $ads[0]['target'] }}" target="_blank"><img src="{{asset('uploads/adv/' . $ads[0]['mobile'] )}}"></a>
</div>
@endif

</div>




{{--sports--}}
@if(!$categories['sports']['featured']->isEmpty())
<div class="large-6 column sub-featured nopadding-right end">
 <h3> ކުޅިވަރު <i class="fa fa-futbol-o left"></i></h3>
 <a href="{{route('page.article', $categories['sports']['featured'][0]->id)}}">
  <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['sports']['featured'][0]->image)}}');"></div>
  <h4>{{$categories['sports']['featured'][0]->heading}}</h4>
</a>
@if(!$categories['sports']['subs']->isEmpty())
<div class="section-more">
  <ul>
   @foreach($categories['sports']['subs'] as $post)
   <li>
    <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
      <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}'); height:100%;"></div>
   </a>
   <a href="#" class="right ssiil large-9 nopadding-left column">{{$post->heading}}<br>
      <abbr class="timeago" title="{{$post->published_at}}"></abbr>
   </a>
   <div class="clearfix"></div>
</li>
@endforeach
</ul>
</div>
@endif
</div>
@endif

{{--politics--}}
@if(!$categories['politics']['featured']->isEmpty())
<div class="large-6 column sub-featured nopadding-right end">
 <h3>ސިޔާސީ<i class="fa fa-globe left"></i></h3>
 <a href="{{route('page.article', $categories['politics']['featured'][0]->id)}}">
  <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['politics']['featured'][0]->image)}}');"></div>
  <h4>{{$categories['politics']['featured'][0]->heading}}</h4>
</a>
@if(!$categories['politics']['subs']->isEmpty())
<div class="section-more">
  <ul>
   @foreach($categories['politics']['subs'] as $post)
   <li>
    <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
      <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}'); height:100%;"></div>
   </a>
   <a href="#" class="right ssiil large-9 nopadding-left column">{{$post->heading}}<br>
      <abbr class="timeago" title="{{$post->published_at}}"></abbr>
   </a>
   <div class="clearfix"></div>
</li>
@endforeach
</ul>
</div>
@endif
</div>
@endif

<div class="row hide-for-medium hide-for-large bottom-vertical">

<!-- Mid3 -->
@if(empty($advs['middleads_3']))
<div class="large-12 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/bottomad.png')}}"></div>
@else
<?php
$ads = $advs['middleads_3'];
shuffle($ads)
?>
<div class="large-12 column middle-subad text-right" style="padding:20px;">
    <a href="{{ $ads[0]['target'] }}" target="_blank"><img src="{{asset('uploads/adv/' . $ads[0]['mobile'] )}}"></a>
</div>
@endif

</div>



{{--environment--}}
@if(!$categories['environment']['featured']->isEmpty())
<div class="large-6 column sub-featured nopadding-right end">
 <h3> ތިމާވެށި <i class="fa fa-leaf left"></i></h3>
 <a href="{{route('page.article', $categories['environment']['featured'][0]->id)}}">
  <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['environment']['featured'][0]->image)}}');"></div>
  <h4>{{$categories['environment']['featured'][0]->heading}}</h4>
</a>
@if(!$categories['environment']['subs']->isEmpty())
<div class="section-more">
  <ul>
   @foreach($categories['environment']['subs'] as $post)
   <li>
    <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
      <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}'); height:100%;"></div>
   </a>
   <a href="#" class="right ssiil large-9 nopadding-left column">{{$post->heading}}<br>
      <abbr class="timeago" title="{{$post->published_at}}"></abbr>
   </a>
   <div class="clearfix"></div>
</li>
@endforeach
</ul>
</div>
@endif
</div>
@endif

{{--environment--}}
@if(!$categories['school']['featured']->isEmpty())
<div class="large-6 column sub-featured nopadding-right end">
<h3> ސްކޫލް <i class="fa fa-book left"></i></h3>
 <a href="{{route('page.article', $categories['school']['featured'][0]->id)}}">
  <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['school']['featured'][0]->image)}}');"></div>
  <h4>{{$categories['school']['featured'][0]->heading}}</h4>
</a>
@if(!$categories['school']['subs']->isEmpty())
<div class="section-more">
  <ul>
   @foreach($categories['school']['subs'] as $post)
   <li>
    <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
      <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}'); height:100%;"></div>
   </a>
   <a href="#" class="right ssiil large-9 nopadding-left column">{{$post->heading}}<br>
      <abbr class="timeago" title="{{$post->published_at}}"></abbr>
   </a>
   <div class="clearfix"></div>
</li>
@endforeach
</ul>
</div>
@endif
</div>
@endif


<div class="clearfix"></div>



<div class="row hide-for-small-only bottom-vertical">

<!-- Mid3 -->
@if(empty($advs['middleads_3']))
<div class="large-6 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/middleads.png')}}"></div>
@else
<?php
$ads = $advs['middleads_3'];
shuffle($ads)
?>
<div class="hide-for-small large-6 column middle-subad nopadding-right text-right">
    <a href="{{ $ads[0]['target'] }}" target="_blank"><img src="{{asset('uploads/adv/' . $ads[0]['desktop'] )}}"></a>
</div>
@endif


<!-- Mid4 -->
@if(empty($advs['middleads_4']))
<div class="large-6 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/middleads.png')}}"></div>
@else
<?php
$ads = $advs['middleads_4'];
shuffle($ads)
?>
<div class="hide-for-small large-6 column middle-subad nopadding-right text-right">
    <a href="{{ $ads[0]['target'] }}" target="_blank"><img src="{{asset('uploads/adv/' . $ads[0]['desktop'] )}}"></a>
</div>
@endif


</div>


<!-- Adv -->
<div class="row hide-for-medium hide-for-large bottom-vertical">

<!-- Mid1 -->
@if(empty($advs['middleads_1']))
<div class="large-12 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/bottomad.png')}}"></div>
@else
<?php
$ads = $advs['middleads_1'];
shuffle($ads)
?>
<div class="large-12 column middle-subad text-right" style="padding:20px;">
    <a href="{{ $ads[0]['target'] }}" target="_blank"><img src="{{asset('uploads/adv/' . $ads[0]['mobile'] )}}"></a>
</div>
@endif

</div>




<div class="clearfix"></div>

</div>
<div class="clearfix"></div>

</div>
</div>
<div class="gallery-section">
  {{-- GALLERY --}}
  @include('rashoveshi.home.gallery-home')
  {{-- END OF GALLERY --}}
  <div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<div class="low-section">
 <div class="row">
  <div class="large-8 columns-main column nopadding-right right">
    {{-- COLUMNIST --}}
    @include('rashoveshi.home.columnist-home', $categories['column'])
    {{-- END OF COLUMNIST --}}
 </div>
 <div class="large-4 column nopadding-right bottom-ad">
  {{-- ADV --}}




   @if(empty($advs['bottom']))
  <img src="{{asset('images/ads/bottomad.png')}}">
   @else
<?php
$ads = $advs['bottom'];
shuffle($ads);
?>
    <a href="{{ $ads[0]['target'] }}" target="_blank">
        <img class="hide-for-small show-for-medium " src="{{asset('uploads/adv/' . $ads[0]['desktop'])}}">
    </a>
    <a href="{{ $ads[0]['target'] }}" target="_blank">
        <img class="hide-for-medium hide-form-large show-for-only-small " src="{{asset('uploads/adv/' . $ads[0]['mobile'])}}">
    </a>



   @endif
</div>
</div>
</div>

