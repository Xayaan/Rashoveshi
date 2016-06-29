<div class="title-bar show-for-small-only" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title"><a href="{{route('page.home')}}" target="_self"><img src="{{asset('images/logo.png')}}" class="mobile-logo" alt="Rashoveshi"></a></div>
</div>

<div class="top-bar" id="example-menu">
  <div class="menu-wrapp">
    <div class="top-bar-right">
      <ul class="dropdown menu" data-dropdown-menu>
        <li><a href="{{url('/news')}}"> ޚަބަރު </a></li>
        <li><a href="{{url('/politics')}}">ސިޔާސީ</a></li>
        <li><a href="{{url('/sports')}}"> ކުޅިވަރު </a></li>
        <li><a href="{{url('/business')}}"> ވިޔަފާރި </a></li>
        <li><a href="{{url('/report')}}"> ރިޕޯޓް </a></li>
        <li><a href="{{url('/people')}}">މީހުން</a></li>
        <li><a href="{{url('/environment')}}">ތިމާވެށި</a></li>
        <li><a href="{{url('/history')}}">ތާރީޙް</a></li>
        <li><a href="{{url('/school')}}">ސްކޫލް</a></li>
      </ul>
    </div>
    <div class="top-bar-left hide-for-small-only">
      <ul class="menu">
       <li><input type="search" class="atk" placeholder="ހޯދާ"></li>
     </ul>
   </div>
 </div>
</div>
