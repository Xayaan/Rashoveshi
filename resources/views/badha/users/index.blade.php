@extends('layouts.badha')

@section('sub-nav')
   @include('badha.users.nav')
@endsection

{{-- Web site Title --}}
@section('title', 'All Users')

@section('content')
<section class="users">
   <button onclick="location.href='{{route('user.create')}}'" class="ui default button " style="float:right; margin-top:-5px; margin-bottom:15px;">
      <i class="icon user"></i>
      Add New
      </button>
	<table class="ui very basic definition celled blue table">
  	<thead class="full-width">
    	<tr>
    		<th>Name</th>
    		<th>Email</th>
  			<th>Actions</th>
  		</tr>
  	</thead>
  	<tbody>
  		@foreach ($users as $user)
    	<tr>
      		<td>
        		<h4 class="ui image header">
                @if($user->avatar =='')
                  <img src="{{asset('images/missing_user.png')}}" alt="" class="ui mini rounded image"/>
                @else
                  <img src="{{ url() }}/uploads/avatar/{{$user->avatar}}" alt="" class="ui mini rounded image"/>
                @endif
          			<div class="content">
          				{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
          				<div class="sub header">{{$user->designation->name}}</div>
          			</div>
      			</h4>
      		</td>
      		<td>{{ $user->email }}</td>
      		<td>
      			<button onclick="location.href='{{ route('user.edit', $user->id) }}'" class="edit tiny ui default button"><i class="edit icon"></i>Edit</button>

            @if ($currentUser->id != $user->id)
            <form method="post" action="{{ route('user.delete', $user->id) }}" style="display:inline;">
              <!-- CSRF Token -->
              {!! csrf_field() !!}
              {!! method_field('delete') !!}
              <button  class="delete tiny ui red button"><i class="erase icon"></i>Delete</button>
            </form>
            @endif

          </td>
    	</tr>
    	@endforeach
 	 </tbody>
	</table>

	<div class="pull-right">
		{!! $users->render() !!}
	</div>



</section>


@stop
