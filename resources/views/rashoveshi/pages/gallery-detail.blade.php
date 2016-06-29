@extends('rashoveshi.layouts.default')
@section('content')
<div class="gallery-view">
   <div class="row gallery-view-inner">
      <div class="title-wrap">
         <h3 style="width:70%">{{$post->heading}}</h3>
         <div class="gallery-share" >
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
                  }(document, 'script', 'facebook-jssdk'));
               </script>
               <div class="fb-like" data-href="http://rashoveshi.mv/{{ $post->id }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>

         </div>
         <div class="clearfix"></div>
      </div>
      <div id="gallery-1" class="royalSlider rsDefault" style="width:100%; background:#222 !important;">
      <?php $content = json_decode($post->content_text);?>
         @foreach ($content as $idx => $value)
         @if($value->type == "gallery")
               @foreach($value->images as $image)

                      <img class="rsImg" src="{{asset('uploads/post/big_'. $image->source)}}" data-rsTmb="{{asset('uploads/post/square_'. $image->source)}}" alt="image description" />

               @endforeach
         @endif
      @endforeach
      </div>
     </div>
   </div>
</div>



@stop
@section('scripts')
<script type="text/javascript">
   $(document).ready(function(){

  $('#gallery-1').royalSlider({
      controlNavigation: 'thumbnails',
     autoScaleSlider: true,
      autoScaleSliderWidth: 960,
      autoScaleSliderHeight: 600,
   });


   });
</script>
@endsection

