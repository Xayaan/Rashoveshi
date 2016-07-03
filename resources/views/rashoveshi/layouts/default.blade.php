<!DOCTYPE html>
<html class="no-js" lang="dv" dir="rtl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title><?=Meta::get('title');?></title>

	<?=Meta::get('site_name', 'rashoveshi.mv');?>
	<?=Meta::get('site_name', 'rashoveshi.mv');?>
	<?=Meta::get('url');?>
	<?=Meta::get('locale', 'en_EN');?>
	<?=Meta::get('fb:app_id', '1766878270206798');?>
	<?=Meta::get('og:type', 'article');?>

	<?=Meta::get('title');?>
	<?=Meta::get('description');?>
	<?=Meta::get('image')[0];?>
	<?=Meta::get('url');?>
	<?=Meta::get('article:publisher', 'https://www.facebook.com/Rashoveshi-433216383537044');?>

	<meta content="@rashoveshi" data-page-subject="true" name="twitter:site" />
	<meta content="@rashoveshi" data-page-subject="true" name="twitter:creator" />

	<?=Meta::get('twitter:domain', 'rashoveshi.mv');?>
	<?=Meta::get('twitter:widgets:csp', 'on');?>
	<?=Meta::get('twitter:card', 'summary_large_image');?>
	<?=Meta::get('twitter:image:src');?>

	<link rel="shortcut icon" type="image/x-icon" href="{{asset('/favicon.ico')}}">

	<link rel="apple-touch-icon" sizes="57x57" href="{{asset('apple-icon-57x57.png')}}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{asset('apple-icon-60x60.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('apple-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('apple-icon-76x76.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('apple-icon-114x114.png')}}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{asset('apple-icon-120x120.png')}}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{asset('apple-icon-144x144.png')}}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{asset('apple-icon-152x152.png')}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-icon-180x180.png')}}">
	<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('android-icon-192x192.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon-96x96.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
	<link rel="manifest" href="{{asset('manifest.json')}}">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="{{asset('ms-icon-144x144.png')}}">
	<meta name="theme-color" content="#ffffff">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://cdn.rawgit.com/Pagawa/PgwSlideshow/master/pgwslideshow.min.css'>
	<link rel="stylesheet" href="{{ elixir("css/rashoveshi-01.css") }}">

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-72154429-1', 'auto');
		ga('send', 'pageview');

	</script>

	<style type="text/css">
		.fixed {
		    position: fixed;
		    top: 0;
		    width:100%;
		}
	</style>

</head>

<body>
	@section('header')
	@include('rashoveshi.modules.header')
	@show

	@yield('content')

	@section('footer')
	@include('rashoveshi.modules.footer')
	@show
	<script src="{{ elixir("js/rashoveshi-01.js") }}"></script>
    <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
	@yield('scripts')

</body>
</html>
