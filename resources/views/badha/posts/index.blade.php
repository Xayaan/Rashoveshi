@extends('layouts.badha')

@section('sub-nav')
<div class="ui  small centered pointing  nomargin menu" style="text-align:center !important;border-radius: 0px;">
   <div class="ui container ">
        <a href="{{ url('posts') }}" class="item  {{ (Request::is('posts') && Request::get('sort')==null ? 'active' : '') }} ">Published</a>
        <a href="{{ url('posts?sort=drafts') }}" class="item  {{ ((Request::get('sort')=='drafts') ? 'active' : '') }} " >Drafts
      @if(isset($count))
        @if($count['drafts'] >=1)
            <div class="ui label">
                {{$count['drafts']}}
            </div>
        @endif
      @endif

        </a>
      @if(Sentinel::hasAccess(['post.review']))
        <a href="{{ url('posts?sort=review') }}" class="item  {{ ((Request::get('sort')=='review') ? 'active' : '') }} ">Review
      @if(isset($count))
        @if($count['review'] >=1)
          <div class="ui label">{{$count['review']}}</div>
        @endif
      @endif
      </a>
      @endif

      {{-- <a href="{{ URL::route('permissions.index')}}" class="item  {{ URL::route('permissions.index') === URL::current() ? 'active' : '' }}">New</a> --}}
  </div>
</div>





@endsection
{{-- Web site Title --}}
@section('title', 'All Posts')

@section('content')
<section class="posts">
   <button onclick="location.href='{{route('post.create')}}'" class="ui default button " style="float:right; margin-top:-5px; margin-bottom:15px;"><i class="icon write"></i>Add New</button>
   <table class="ui very basic table definition  selectable ">
   <thead class="full-width">
      <tr>
         <th>#</th>
         <th class="four wide">Heading</th>
         <th>View</th>
         <th>Created by</th>
         <th>Created Date</th>
         <th>Published Date</th>
         <th>Status</th>
         <th>Category</th>
         @if(Request::is('posts') AND Request::get('sort') == [null])
            @if($currentUser->hasAccess('post.update'))
              <th>Actions</th>
            @endif
          @else
            <th>Actions</th>
          @endif
      </tr>
   </thead>
   <tbody>

    @if(count($posts) >= 1)
      @foreach ($posts as $post)
      <tr>
         <td>{{$post->id}}</td>
         <td style="font-family: MV Waheed; text-align: right;">{{$post->heading}}</td>
         <td>{{$post->views['views']}}</td>
         <td>{{$post->author->name_en}} </td>
         <td>{{$post->created_at}}</td>
         <td>{{$post->published_at}}</td>
         <td> {{ articleStatus($post->status) }}</td>
         <td>{{$post->parentTag->name_en}}</td>

          @if(Request::is('posts') && Request::get('sort')==null)
            @if($currentUser->hasAccess('post.update'))
                <td>
                 <button onclick="location.href='{{ route('post.edit', $post->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>
                 <form method="post" action="{{ route('post.delete', $post->id) }}" style="display:inline;">
                    <!-- CSRF Token -->
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                    <button  class="delete tiny ui red button"><i class="erase icon"></i>Delete</button>
                  </form>
               </td>
            @endif
          @else
              <td>
               <button onclick="location.href='{{ route('post.edit', $post->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>
               <form method="post" action="{{ route('post.delete', $post->id) }}" style="display:inline;">
                  <!-- CSRF Token -->
                  {!! csrf_field() !!}
                  {!! method_field('delete') !!}
                  <button  class="delete tiny ui red button"><i class="erase icon"></i>Delete</button>
                </form>
             </td>
          @endif


      </tr>
      @endforeach
      @endif
   </tbody>
    <th colspan="7" style="text-align:center;">
     {!! $posts->appends(['sort' => $sort[0]])->render(new Landish\Pagination\SemanticUI($posts))  !!}
    </th>
   </table>
</section>
@stop

@section('scripts')


@endsection

{{-- 		'heading',
		'heading_detailed',
		'heading_latin',
		'summary',
		'content',
		'content_text',
		'image',
		'created_by',
		'status',
		'language',
		'published_at', --}}