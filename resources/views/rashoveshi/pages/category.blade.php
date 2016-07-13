@extends('rashoveshi.layouts.default')

@section('content')
<div class="main-area categoryPg">
  <div class="row ">
    <div class="large-12 column nopadding report-bar">
      ރަށޮވެށިއަށް ޚަބަރެއް ދެއްވުމަށް: 7422233 / 9572233
    </div>
    <div class="clearfix"></div>

    <div class="large-8 medium-12 column right nopadding-right">
      {{-- Featured --}}
      @include('rashoveshi.tags.featured', $posts['posts'])
    </div>

    {{-- Recent and Populars --}}
    <div class="large-4 column left recents-popular nopadding-left show-for-large-up">
      {{-- TABS --}}
      @include('rashoveshi.home.recent-listing-home')
      @include('rashoveshi.polls.latest-poll')
    </div>
  </div>
</div>



<!--
<div class="home-sectionals">
  <div class="row">
    <div class="large-6 column middle-subad nopadding-right"><img src="images/stoAd.gif"></div>
    <div class="large-6 column middle-subad nopadding-right "><img src="images/stoAd2.gif"></div>
  </div>
  <div class="row sections">
    <div class="large-12 column more-news right nopadding">
     <h3>އެންމެ ފަހުން</h3>
     <ul>
       <li  class=" large-3 more-news-block column nopadding-right">
        <a href="#">
          <div class="block-img-wrap" style="background-image:url('http://f1.haveeru.com.mv/photos/2015/11/0_144759438466dfd3511043cdd38fc04bb0453c80388bcdcffa06870791958d97ebaf797087_news.jpg');">
          </div>
          <h4>އަންނަ އަހަރުގެ ބަޖެޓަކީ ގައުމީ ތަރައްގީގެ ދުވެލި ހަލުވިކުރުމަށް އެޙީވެދޭނެ ބަޖެޓެއް: އޮޑިޓަ ޖެނެރަލް</h4>
          <div class="clearfix"></div>
        </a>
      </li>
      <li  class=" large-3 more-news-block column nopadding-right">
        <a href="#">
          <div class="block-img-wrap" style="background-image:url('http://f1.haveeru.com.mv/photos/2015/11/0_144759438466dfd3511043cdd38fc04bb0453c80388bcdcffa06870791958d97ebaf797087_news.jpg');">
          </div>
          <h4>އަންނަ އަހަރުގެ ބަޖެޓަކީ ގައުމީ ތަރައްގީގެ ދުވެލި ހަލުވިކުރުމަށް އެޙީވެދޭނެ ބަޖެޓެއް: އޮޑިޓަ ޖެނެރަލް</h4>
          <div class="clearfix"></div>
        </a>
      </li>
      <li  class=" large-3 more-news-block column nopadding-right">
        <a href="#">
          <div class="block-img-wrap" style="background-image:url('http://f1.haveeru.com.mv/photos/2015/11/0_144759438466dfd3511043cdd38fc04bb0453c80388bcdcffa06870791958d97ebaf797087_news.jpg');">
          </div>
          <h4>އަންނަ އަހަރުގެ ބަޖެޓަކީ ގައުމީ ތަރައްގީގެ ދުވެލި ހަލުވިކުރުމަށް އެޙީވެދޭނެ ބަޖެޓެއް: އޮޑިޓަ ޖެނެރަލް</h4>
          <div class="clearfix"></div>
        </a>
      </li>
      <li  class=" large-3 more-news-block column nopadding-right">
        <a href="#">
          <div class="block-img-wrap" style="background-image:url('http://f1.haveeru.com.mv/photos/2015/11/0_144759438466dfd3511043cdd38fc04bb0453c80388bcdcffa06870791958d97ebaf797087_news.jpg');">
          </div>
          <h4>އަންނަ އަހަރުގެ ބަޖެޓަކީ ގައުމީ ތަރައްގީގެ ދުވެލި ހަލުވިކުރުމަށް އެޙީވެދޭނެ ބަޖެޓެއް: އޮޑިޓަ ޖެނެރަލް</h4>
          <div class="clearfix"></div>
        </a>
      </li>
      <li  class=" large-3 more-news-block column nopadding-right">
        <a href="#">
          <div class="block-img-wrap" style="background-image:url('http://f1.haveeru.com.mv/photos/2015/11/0_144759438466dfd3511043cdd38fc04bb0453c80388bcdcffa06870791958d97ebaf797087_news.jpg');">
          </div>
          <h4>އަންނަ އަހަރުގެ ބަޖެޓަކީ ގައުމީ ތަރައްގީގެ ދުވެލި ހަލުވިކުރުމަށް އެޙީވެދޭނެ ބަޖެޓެއް: އޮޑިޓަ ޖެނެރަލް</h4>
          <div class="clearfix"></div>
        </a>
      </li>
      <li  class=" large-3 more-news-block column nopadding-right">
        <a href="#">
          <div class="block-img-wrap" style="background-image:url('http://f1.haveeru.com.mv/photos/2015/11/0_144759438466dfd3511043cdd38fc04bb0453c80388bcdcffa06870791958d97ebaf797087_news.jpg');">
          </div>
          <h4>އަންނަ އަހަރުގެ ބަޖެޓަކީ ގައުމީ ތަރައްގީގެ ދުވެލި ހަލުވިކުރުމަށް އެޙީވެދޭނެ ބަޖެޓެއް: އޮޑިޓަ ޖެނެރަލް</h4>
          <div class="clearfix"></div>
        </a>
      </li>
      <li  class=" large-3 more-news-block column nopadding-right">
        <a href="#">
          <div class="block-img-wrap" style="background-image:url('http://f1.haveeru.com.mv/photos/2015/11/0_144759438466dfd3511043cdd38fc04bb0453c80388bcdcffa06870791958d97ebaf797087_news.jpg');">
          </div>
          <h4>އަންނަ އަހަރުގެ ބަޖެޓަކީ ގައުމީ ތަރައްގީގެ ދުވެލި ހަލުވިކުރުމަށް އެޙީވެދޭނެ ބަޖެޓެއް: އޮޑިޓަ ޖެނެރަލް</h4>
          <div class="clearfix"></div>
        </a>
      </li>
      <li  class=" large-3 more-news-block column nopadding-right">
        <a href="#">
          <div class="block-img-wrap" style="background-image:url('http://f1.haveeru.com.mv/photos/2015/11/0_144759438466dfd3511043cdd38fc04bb0453c80388bcdcffa06870791958d97ebaf797087_news.jpg');">
          </div>
          <h4>އަންނަ އަހަރުގެ ބަޖެޓަކީ ގައުމީ ތަރައްގީގެ ދުވެލި ހަލުވިކުރުމަށް އެޙީވެދޭނެ ބަޖެޓެއް: އޮޑިޓަ ޖެނެރަލް</h4>
          <div class="clearfix"></div>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="row cat-pagination">
  <ul class="pagination">
    <li><a href="" class="arrow"><i class="fa fa-chevron-right"></i></a></li>
    <li><a href="1">1</a></li>
    <li><a href="2">2</a></li>
    <li><a href="3">3</a></li>
    <li><a href="4">4</a></li>
    <li><a href="5">5</a></li>
    <li><a href="6">6</a></li>
    <li><a href="7">7</a></li>
    <li><a href="8">8</a></li>
    <li><a href="9">9</a></li>
    <li><a href="10">10</a></li>
    <li><a href="11">11</a></li>
    <li><a href="12">12</a></li>
    <li><a href="2" class="arrow"><i class="fa fa-chevron-left"></i></a></li>
  </ul>
</div>
<div class="row">
  <div class="large-6 column middle-subad nopadding-right"><img src="images/stoAd.gif"></div>
  <div class="large-6 column middle-subad nopadding-right "><img src="images/stoAd2.gif"></div>
</div>

</div> -->

@stop
