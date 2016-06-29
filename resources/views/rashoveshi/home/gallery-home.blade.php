@if(!$categories['photo']['featured']->isEmpty())
<div class="row galleries-wrap nopadding">
    <div class="large-12">
        <h3 class="section-title"> <i class="fa fa-camera"></i> ފޮޓޯ </h3>
    </div>
    <div class="small-12 small-centered columns nopadding">


        <a href="{{route('page.article', $categories['photo']['featured'][0]->id)}}">
        <div class="large-4 columns featured-gallery-main">
            <div class="featured-gallery-main-img" style="background-image:url('{{asset('uploads/post/medium_'. $categories['photo']['featured'][0]->image)}}');"></div>
            <h3 style="width:100%;">{{$categories['photo']['featured'][0]->heading}}</h3>
        </div>
        </a>

        <div class="large-8 columns galleries-wrap-sub">
            @if(!$categories['photo']['subs']->isEmpty())
            @foreach($categories['photo']['subs'] as $gallery)
            <a href="{{route('page.article', $gallery->id)}}">
            <div class="large-6 small-6 home-sub-gallery columns nopadding-right">
                <div class="home-sub-gallery-inner">
                    <div class="large-6 nopadding columns subgallery-img" style="background-image:url('{{asset('uploads/post/square_'. $gallery->image)}}');"></div>
                    <div class="large-6 nopadding columns subgallery-txt">
                        <h3>{{$gallery->heading}}</h3>
                       <abbr class="timeago" title="{{$gallery->published_at}}"></abbr>
                    </div>
                </div>
            </div>
            </a>
            @endforeach
            @endif

    </div>
</div>
@endif
<!-- <div class="photos">
    <h3>ފޮޓޯ</h3>
    <div class="orbit" role="region" aria-label="Picture Gallery" data-orbit>
        <ul class="orbit-container">
            <button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9664;</button>
            <button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9654;</button>
            <li class="is-active orbit-slide">
                <div>
                    <img src="http://lorempixel.com/640/400/transport/1" alt="slide 1" />
                    <figcaption class="orbit-caption">ސައުދި އަރަބިއްޔާގެ އިސްލާމިކް މިނިސްޓަރ ރާއްޖެއަށް ޒިޔާރަތްކުރެއްވުން</figcaption>
                </div>
            </li>
            <li class="orbit-slide">
                <div>
                    <img src="http://lorempixel.com/640/400/transport/2" alt="slide 2" />
                    <figcaption class="orbit-caption">ސައުދި އަރަބިއްޔާގެ އިސްލާމިކް މިނިސްޓަރ ރާއްޖެއަށް ޒިޔާރަތްކުރެއްވުން</figcaption>
                </div>
            </li>
            <li class="orbit-slide">
                <div>
                    <img src="http://lorempixel.com/640/400/transport/3" alt="slide 3" />
                    <figcaption class="orbit-caption">ސައުދި އަރަބިއްޔާގެ އިސްލާމިކް މިނިސްޓަރ ރާއްޖެއަށް ޒިޔާރަތްކުރެއްވުން</figcaption>
                </div>
            </li>
            <li class="orbit-slide">
                <div>
                    <img src="http://lorempixel.com/640/400/transport/4" alt="slide 4" />
                    <figcaption class="orbit-caption">ސައުދި އަރަބިއްޔާގެ އިސްލާމިކް މިނިސްޓަރ ރާއްޖެއަށް ޒިޔާރަތްކުރެއްވުން</figcaption>
                </div>
            </li>
        </ul>
    </div>
    <div class="albums">
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/1);">
                </div>
            </a>
        </div>
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/2);">
                </div>
            </a>
        </div>
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/3);">
                </div>
            </a>
        </div>
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/4);">
                </div>
            </a>
        </div>
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/5);">
                </div>
            </a>
        </div>
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/2);">
                </div>
            </a>
        </div>
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/6);">
                </div>
            </a>
        </div>
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/6);">
                </div>
            </a>
        </div>
        <div class="album">
            <a href="#">
                <div class="album-inner" style="background-image:url(http://lorempixel.com/g/200/200/sports/6);">
                </div>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
 -->