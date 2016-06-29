<div class="columists">
    <h3>ކޮލަމިސްޓުން </h3>
    <ul>
        @foreach($categories['column']['subs'] as $post)
            <a href="{{route('page.article',$post->id)}}">

            <li class="columist large-6 column nopadding end">
                <div class="columist-img-wrap large-4 small-4 column nopadding" style="background-image:url('{{asset('uploads/post/squareMedium_'. $post->image)}}')"> </div>
                <div class="columist-txt-wrap large-8 small-8 column">
                    <h6>{{$post->author->name}}</h6>
                    <h4>‏{{$post->heading}}</h4>
                    <abbr class="timeago" title="{{$post->published_at}}"></abbr>
                </div>
            </li>
            </a>
        @endforeach
    </ul>
</div>