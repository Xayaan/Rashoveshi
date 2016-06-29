@extends('layouts.badha')
{{-- Web site Title --}}
@section('title', 'All Polls')

@section('content')
<section class="tags">
   <button onclick="location.href='{{route('poll.create')}}'" class="ui  button " style="float:right; margin-top:-5px; margin-bottom:15px;"><i class="icon list"></i>Add New</button>
   <table class="ui very basic table">
   <thead>
      <tr>
         <th class="one wide" >#</th>
         <th class="two wide">Title</th>
         <th class="two wide">No. Of Choices</th>
         <th class="three wide">Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($polls as $poll)
      <tr>
         <td>{{$poll->id}}</td>
         <td>{{$poll->title}}</td>
         <td>{{$poll->choices->count()}}</td>
         <td>
           <button onclick="location.href='{{ route('poll.edit', $poll->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>
           <form method="post" action="{{ route('poll.delete', $poll->id) }}" style="display:inline;">
              <!-- CSRF Token -->
              {!! csrf_field() !!}
              {!! method_field('delete') !!}
              <button  class="delete tiny ui red button"><i class="erase icon"></i>Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
   <tfoot>
    <tr>
    <th colspan="7" style="text-align:center;">
     {!! (new Landish\Pagination\SemanticUI($polls))->render() !!}
    </th>
  </tr></tfoot>

   </table>



</section>
@stop
