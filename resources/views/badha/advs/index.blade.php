@extends('layouts.badha')


{{-- Web site Title --}}
@section('title', 'All Advs')

@section('content')
<section class="advs">
   <button onclick="location.href='{{route('adv.create')}}'" class="ui default button " style="float:right; margin-top:-5px; margin-bottom:15px;">
      <i class="icon users"></i>
      Add New
      </button>
	<table class="ui very basic selectable celled blue table">
  	<thead class="full-width">
    	<tr>
        <th>#</th>
    		<th>Name</th>
    		<th>Page</th>
        <th>Position</th>
        <th>Desktop</th>
        <th>Mobile</th>
        <th>Metrics <small>(clicks/impressions)</small></th>
  			<th>Actions</th>
  		</tr>
  	</thead>
  	<tbody>
  		@foreach ($advs as $adv)
    	<tr>
        <td>{{$adv->id}}</td>
        <td>{{$adv->name}}</td>
        <td>{{$adv->page}}</td>
        <td>{{$adv->position}}</td>
        <td>  <div class="" style=" height:50px; width:200px; background-size:100% 100%; background-image:url('{{ asset('uploads/adv/'. $adv->desktop)}}')"></div></td>
        <td> <div class="" style=" height:50px; width:50px; background-size:100% 100%; background-image:url('{{ asset('uploads/adv/'. $adv->mobile)}}')"></div></td>
        <td>{{ number_format($adv->metrics()->ofType('click')->count()) }} / {{ number_format($adv->metrics()->ofType('impression')->count()) }}</td>
        @if(Request::is('posts') && Request::get('sort')==null)
            @if($currentUser->hasAccess('post.update'))
                <td>
                 <button onclick="location.href='{{ route('adv.edit', $adv->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>
                 <form method="post" action="{{ route('adv.delete', $adv->id) }}" style="display:inline;">
                    <!-- CSRF Token -->
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                    <button  class="delete tiny ui red button"><i class="erase icon"></i>Delete</button>
                  </form>
               </td>
            @endif
          @else
              <td>
               <button onclick="location.href='{{ route('adv.edit', $adv->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>
               <form method="post" action="{{ route('adv.delete', $adv->id) }}" style="display:inline;">
                  <!-- CSRF Token -->
                  {!! csrf_field() !!}
                  {!! method_field('delete') !!}
                  <button  class="delete tiny ui red button"><i class="erase icon"></i>Delete</button>
                </form>
             </td>
          @endif

      </tr>
    	@endforeach
 	 </tbody>
	</table>

	<div class="pull-right">
		{!! $advs->render() !!}
	</div>



</section>


@stop
