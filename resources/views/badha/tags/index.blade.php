@extends('layouts.badha')
@section('sub-nav')
   @include('badha.tags.nav')
@endsection
{{-- Web site Title --}}
@section('title', 'All Tags')

@section('content')
<section class="tags">
   <button onclick="location.href='{{route('tag.create')}}'" class="ui  button " style="float:right; margin-top:-5px; margin-bottom:15px;"><i class="icon tags"></i>Add New</button>
   <table class="ui very basic table">
   <thead>
      <tr>
         <th class="one wide" >#</th>
         <th class="two wide">Name Dhivehi</th>
         <th class="two wide">Name English</th>
         <th class="two wide">Slug</th>
         <th class="two wide">Parent</th>
         <th class="two wide">Type</th>
         <th class="three wide">Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($tags as $tag)
      <tr>
         <td>{{$tag->id}}</td>
         <td>{{$tag->name}}</td>
         <td>{{$tag->name_en}}</td>
         <td>{{$tag->slug}}</td>
         <td>@if($tag->parent == '') - @else {{$tag->parent->name_en}} @endif</td>
         <td>{{$tag->type->name}}</td>
         <td>
           <button onclick="location.href='{{ route('tag.edit', $tag->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>
           <form method="post" action="{{ route('tag.delete', $tag->id) }}" style="display:inline;">
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
     {!! (new Landish\Pagination\SemanticUI($tags))->render() !!}
    </th>
  </tr></tfoot>

   </table>



</section>
@stop
