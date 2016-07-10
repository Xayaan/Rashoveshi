<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ elixir("css/badha-01.css") }}">
    <script src="{{ elixir("js/badha-01.js") }}"></script>
    <title>Badha :: @section('title') @show </title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
</head>
<body>
   	@include('badha.modules.nav')

    @yield('sub-nav')

	<div class="ui column doubling grid container" style="margin-top:10px; min-height:600px;">
		<div class="fourteen column">
			<h3 class="ui  dividing header" style="margin-bottom:10px;">@yield('title')</h3>
			@include('badha.modules.notifications')
			@yield('content')
		</div>
	</div>
	{{-- @include('modules.footer') --}}
    <script src="/build/js/plugins/ckeditor/ckeditor.js"></script>
	@yield('scripts')
</body>
</html>
