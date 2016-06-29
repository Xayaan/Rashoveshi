<ul class="tabs" data-tabs>
    <li class="tabs-title is-active"><a href="#panel11">އެންމެ ފަސް</a></li>
    <!-- <li class="tabs-title "><a href="#panel21">ޓްރެންޑިން</a></li> -->
</ul>
{{-- TAB CONTENTS --}}
<div class="tabs-content">
    <div class="tabs-panel is-active" id="panel11">
        <ul>
            @foreach($recentPosts as $post)
            <li><a href="{{route('page.article', $post->id)}}" class="faseyha">{{$post->heading}}</a>
                <div class="datetime"></div></li>
                @endforeach
            </ul>
        </div>
        <div class="tabs-panel" id="panel21">
            <p>This is the second panel of the basic tab example. This is the second panel of the basic tab example.</p>
        </div>
    </div>
