<div style="background:#7B0000;" class="ui  inverted menu stackable small noround nomargin-bottom ">
    <div class="ui container">
        <a class="item"><img src="{{asset('images/badha_logo.png')}}"></a>
        <a href="{{URL::route('badha.dashboard')}}" class="item {{ (Request::is('/') ? 'active' : '') }}"><i class="home icon"></i>Home</a>

        @if(Sentinel::hasAnyAccess(['user.*']))
        <a href="{{URL::route('users.index')}}" class="item {{ (Request::is('users*') ? 'active' : '') }}"><i class="user icon"></i>Users</a>
        <a href="{{URL::route('author.index')}}" class="item {{ (Request::is('authors*') ? 'active' : '') }}"><i class="users icon"></i>Authors</a>
        @endif

        <a href="{{URL::route('post.index')}}" class="item {{ (Request::is('posts*') ? 'active' : '') }}"><i class="write icon"></i>Posts</a>

        <a href="{{URL::route('liveblog.index')}}" class="item {{ (Request::is('liveblog*') ? 'active' : '') }}"><i class="write icon"></i>Liveblog</a>

        <a href="{{URL::route('tag.index')}}" class="item {{ (Request::is('tags*') ? 'active' : '') }}"><i class="tags icon"></i>Tags</a>

        <a href="{{URL::route('poll.index')}}" class="item {{ (Request::is('polls*') ? 'active' : '') }}"><i class="list icon"></i>Polls</a>

        @if(Sentinel::hasAccess('post.review'))
        <a href="{{URL::route('comment.index')}}" class="item {{ (Request::is('layouts*') ? 'active' : '') }}"><i class="comments icon"></i>Comments</a>

        <a href="{{URL::route('layout.index')}}" class="item {{ (Request::is('layouts*') ? 'active' : '') }}"><i class="layout block icon"></i>Layout</a>
        <a href="{{URL::route('adv.index')}}" class="item {{ (Request::is('advs*') ? 'active' : '') }}"><i class="layout block icon"></i>Adv Management</a>
        @endif
        {{-- <a href="{{URL::route('badha.dashboard')}}" class="item {{ (Request::is('/') ? 'active' : '') }}"><i class="setting icon"></i>Settings</a> --}}


        <div class="right menu">
            <div class="ui dropdown item">
                {{-- <img class="ui avatar image" src="{{asset('images/sample_avatar.jpg')}}"> --}}
                {{-- <img class="ui avatar image" src=""> --}}
                 @if($currentUser->avatar =='')
                    <img class="ui avatar image" src="{{asset('images/missing_user.png')}}">
                @else
                    <img class="ui avatar image" src="{{ url() }}/uploads/avatar/{{$currentUser->avatar}}">
                @endif
                {{ $currentUser->first_name }} {{ $currentUser->middle_name }} {{ $currentUser->last_name }} <i class="dropdown icon"></i>
                <div class="menu">
                    <a href="{{URL::route('user.edit', array($currentUser->id))}}" class="item">Edit Profile</a>
                    <a href="{{URL::route('user.logout')}}" class="item">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.ui.dropdown').dropdown();
    });
</script>
