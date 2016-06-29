@extends('layouts.badha')

@section('sub-nav')
   @include('badha.comments.nav')
@endsection
{{-- Web site Title --}}
@section('title', 'All Comments')

@section('content')
<section class="posts">
   <table class="ui  very basic    selectable red table">
   <thead class="full-width">
      <tr>
         <th class="seven wide">Comment</th>
         <th class="one wide">Status</th>
         <th class="two wide" >Date</th>
         <th class="three wide">Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($comments as $comment)
      <tr>
         <td class="comment-text"><h3>{{$comment->name}}:- </h3>{{$comment->comment}}</td>
         <td>{{commentStatus($comment->status)}}</td>
         <td>{{$comment->created_at}}</td>
         <td>
         <form method="post" action="{{ route('comment.approve', $comment->id) }}" style="display:inline;">
              {!! csrf_field() !!}
            <button class="edit tiny ui success button">
               <i class="checkmark icon"></i>Approve
            </button>
          </form>
           <form method="post" action="{{ route('comment.reject', $comment->id) }}" style="display:inline;">
              <!-- CSRF Token -->
              {!! csrf_field() !!}

              <button  class="delete tiny ui red button"><i class="remove icon"></i>Reject</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
   <tfoot>
    <tr>
    <th colspan="7" style="text-align:center;">
     {!! $comments->appends(['sort' => $sort[0]])->render(new Landish\Pagination\SemanticUI($comments))  !!}
    </th>
  </tr></tfoot>
   </table>
</section>
@stop

@section('scripts')


@endsection

