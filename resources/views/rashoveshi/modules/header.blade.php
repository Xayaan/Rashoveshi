<div class="header  hide-for-small-only">
	<div class="row ">
		{{-- Top Logo --}}
		<div class="small-2 large-2 columns logo-wrap">
			<a href="{{route('page.home')}}" target="_self"><img src="{{asset('images/logo.png')}}" class="logo" alt="Rashoveshi"></a>
		</div>

		{{-- Top Main Adv --}}
		<div class="small-10 large-10 columns nopadding topAdBar">
			<img src="{{asset('images/ads/header.png')}}">
		</div>
	</div>
</div>

@include('rashoveshi.modules.topnav')