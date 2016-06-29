@extends('layouts.badha')


{{-- Web site Title --}}
@section('title', 'All Authors')

@section('content')
<section class="authors">
   <button onclick="location.href='{{route('author.create')}}'" class="ui default button " style="float:right; margin-top:-5px; margin-bottom:15px;">
      <i class="icon users"></i>
      Add New
      </button>
	<table class="ui very basic selectable celled blue table">
  	<thead class="full-width">
    	<tr>
    		<th>Name</th>
    		<th>Name DV</th>
  			<th>Actions</th>
  		</tr>
  	</thead>
  	<tbody>
  		@foreach ($authors as $author)
    	<tr>
      		<td>
        		<h4 class="ui image header">
                @if($author->avatar =='')
                  <img src="{{asset('images/missing_author.png')}}" alt="" class="ui mini rounded image"/>
                @else
                  <img src="{{ url() }}/uploads/avatar/{{$author->avatar}}" alt="" class="ui mini rounded image"/>
                @endif
          			<div class="content">
                  {{ $author->name_en }}
                  <div class="sub header">{{$author->post_en}}</div>
                </div>

      			</h4>
      		</td>
      		<td>
            <h4 class="ui image header">
              <div class="content">
              {{ $author->name }}
              <div class="sub header">{{$author->post}}</div>
              </div>
            </h4>
          </td>
      		<td>
      			<button onclick="location.href='{{ route('author.edit', $author->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>



          </td>
    	</tr>
    	@endforeach
 	 </tbody>
	</table>

	<div class="pull-right">
		{!! $authors->render() !!}
	</div>



</section>


@stop
