<!DOCTYPE html>
<html>
<html>
<head>
    <link rel="stylesheet" href="{{ elixir("css/badha-01.css") }}">
    <script src="{{ elixir("js/badha-01.js") }}"></script>
    <title>Badha CMS :: @section('title') @show </title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <style type="text/css">
    body {
      background-color: #690E09;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
</head>
<body>
  @include('badha.modules.notifications')
  @yield('content')
</body>

</html>
