<div class="row">
  <div class="large-6 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/middleads.png')}}"></div>
  <div class="large-6 column middle-subad nopadding-right text-left "><img src="{{asset('images/ads/middleads.png')}}"></div>
</div>
<div class="row sections">
  <div class="large-12 column left nopadding category-news">

   {{-- REPORT --}}
   <div class="large-6 column sub-featured nopadding-right end">
    <h3>ރިޕޯޓް<i class="fa fa-list left"></i></h3>
    @if(!$categories['report']['featured']->isEmpty())
    <a href="{{route('page.article', $categories['report']['featured'][0]->id)}}">
      <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['report']['featured'][0]->image)}}');"></div>
      <h4>{{$categories['report']['featured'][0]->heading}}</h4>
    </a>
    @endif
    @if(!$categories['report']['subs']->isEmpty())
    <div class="section-more">
      <ul>
        @foreach($categories['report']['subs'] as $post)
        <li>
          <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
           <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}');"></div>
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

 {{-- POLITICS --}}
 <div class="large-6 column sub-featured nopadding-right end">
  <h3>ސިޔާސީ<i class="fa fa-globe left"></i></h3>
  @if(!$categories['politics']['featured']->isEmpty())
  <a href="{{route('page.article', $categories['politics']['featured'][0]->id)}}">
   <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['politics']['featured'][0]->image)}}');"></div>
   <h4>{{$categories['politics']['featured'][0]->heading}}</h4>
 </a>
 @endif
 @if(!$categories['politics']['subs']->isEmpty())
 <div class="section-more">
   <ul>
     @foreach($categories['politics']['subs'] as $post)
     <li>
       <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
        <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}');"></div>
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

{{--SPORTS --}}
<div class="large-6 column sub-featured nopadding-right end">
  <h3> ކުޅިވަރު <i class="fa fa-futbol-o left"></i></h3>
  @if(!$categories['sports']['featured']->isEmpty())
  <a href="{{route('page.article', $categories['sports']['featured'][0]->id)}}">
   <div class="category-news-image"style="background-image:url('{{asset('uploads/post/medium_'. $categories['sports']['featured'][0]->image)}}');"></div>
   <h4>{{$categories['sports']['featured'][0]->heading}}</h4>
 </a>
 @endif
 @if(!$categories['sports']['subs']->isEmpty())
 <div class="section-more">
   <ul>
     @foreach($categories['sports']['subs'] as $post)
     <li>
       <a href="{{route('page.article', $post->id)}}" class="right large-3 nopadding column ssiiw">
        <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}');"></div>
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
         <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}');"></div>
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
{{-- environment --}}
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
         <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}');"></div>
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
{{-- school --}}
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
         <div class="ssii" style="background-image:url('{{asset('uploads/post/squareMedium_'.$post->image)}}');"></div>
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

<div class="row hide-for-small-only">
  <div class="large-6 column middle-subad nopadding-right text-right"><img src="{{asset('images/ads/middleads.png')}}"></div>
  <div class="large-6 column middle-subad nopadding-left text-left "><img src="{{asset('images/ads/middleads.png')}}"></div>
</div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
</div>
<div class="gallery-section">
 {{-- GALLERY --}}
 @include('rashoveshi.home.gallery-home')
 {{-- END OF GALLERY --}}
</div>
<div class="low-section">
  <div class="row">
    <div class="large-8 columns-main column nopadding-right right">
     {{-- COLUMNIST --}}
     @include('rashoveshi.home.columnist-home', $categories['column'])
     {{-- END OF COLUMNIST --}}
   </div>
   <div class="large-4 column nopadding-right bottom-ad">
    {{-- ADV --}}
    <img src="{{asset('images/ads/bottomad.png')}}">
  </div>
</div>
