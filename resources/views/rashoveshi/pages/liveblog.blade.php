@extends('rashoveshi.layouts.default')
@section('content')
<div class="live">
    <div class="large-12 column nopadding report-bar">
      ރަށޮވެށިއަށް ޚަބަރެއް ދެއްވުމަށް: 7422233 / 9572233
    </div>
    <div class="clearfix"></div>
   <div class="live-header" style="background:url('{{asset('uploads/post/'.$post->mainImage->filename)}}')">
      <div class="live-overlayer"></div>
      <div class="header-overlay">
         <div class="row">
            <div class="large-2 column end text-center livelogo">
               <img src="{{asset('images/logo.png')}}" class="live-logo">
               <h3>ލައިވް ބްލޮގް</h3>
               <div>
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
            <div class="large-10 column end text-right titlewrap">
               <h2>{{$post->heading}}</h2>



            </div>

         </div>
      </div>
   </div>

   {{-- ARTICLE DETAILS --}}



   {{-- ARTICLE DETAILS END --}}



   <div class="live-content row">

      <div class="large-8 column end live-feed">
         <div class="new-block">
         
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
         </div>




      </div>   








      <div class="large-8 column end live-feed">
         @foreach($bullets as $bullet)
            <div class="news-block">
               <span class="meta">
                  <abbr style="color:#fff!important;" class="timeago" title="{{$bullet->created_at}}"></abbr>
               </span>

               @if($bullet->content_text !== '')
                  <?php $content = json_decode($bullet->content_text);?>

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
            </div>

         @endforeach
      </div>
   </div>   

   {{-- BLOG ARTICLE --}}

</div>




@endsection
