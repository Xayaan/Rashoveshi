@extends('rashoveshi.layouts.default')

@section('content')
<div class="row results-view">
	<div class="large-8 column">
		<div class="no-results">
			<h1 class="text-center">"ސދފދސފސދފސދފ"</h1>
			<h5 class="text-center">ތިޔަ ލަފުޒު ހިމެނޭ ލިޔުމެއް ނުފެނުނު!</h5>
		</div>
		<div class="results">
			<h3>"ސދފދސފސދފސދފ"</h3>
			<ul>
				<li class="newsbox">
					<a href="#">
						<div class="large-3 small-4 column nopadding">
							<div class="newsbox-img" style="background-image:url('{{asset('images/img-placeholder.png')}}')"></div>
						</div>
						<div class="large-9 small-8 column">
							<h3>ޖަޕާނުގެ ބެޑްމިންޓަން އެސޯސިއޭޝަނާ މޫސަ ބައްދަލުކޮށްފި</h3>
							<div class="time">
								<time datetime="2015-11-18 22:20:04">8 ގަޑިއިރު ކުރިން</time>
							</div>
							<p class="hide-for-small-only">މިއަދު އެމްޑީޕީން ވަކިކުރައްވާފައިވާ ރައްޔިތުންގެ މަޖިލީހުގެ ނައިބްރައީސް ހުޅުހެންވޭރު ދާއިރާގެ މެމްބަރު ރީކޯ މޫސާ މަނިކު އެއްވެސް ޕާޓީއަކަށް ސޮއިކުރައްވަން ނޫޅުއްވާ ކަމަށް ވިދާޅުވެއްޖެ އެވެ.</p>
						</div>
					</a>
				</li>
				<li class="newsbox">
					<a href="#">
						<div class="large-3 small-4 column nopadding">
							<div class="newsbox-img" style="background-image:url('{{asset('images/img-placeholder.png')}}')"></div>
						</div>
						<div class="large-9 small-8 column">
							<h3>ޖަޕާނުގެ ބެޑްމިންޓަން އެސޯސިއޭޝަނާ މޫސަ ބައްދަލުކޮށްފި</h3>
							<div class="time">
								<time datetime="2015-11-18 22:20:04">8 ގަޑިއިރު ކުރިން</time>
							</div>
							<p class="hide-for-small-only">މިއަދު އެމްޑީޕީން ވަކިކުރައްވާފައިވާ ރައްޔިތުންގެ މަޖިލީހުގެ ނައިބްރައީސް ހުޅުހެންވޭރު ދާއިރާގެ މެމްބަރު ރީކޯ މޫސާ މަނިކު އެއްވެސް ޕާޓީއަކަށް ސޮއިކުރައްވަން ނޫޅުއްވާ ކަމަށް ވިދާޅުވެއްޖެ އެވެ.</p>
						</div>
					</a>
				</li>
				<li class="newsbox">
					<a href="#">
						<div class="large-3 small-4 column nopadding">
							<div class="newsbox-img" style="background-image:url('{{asset('images/img-placeholder.png')}}')"></div>
						</div>
						<div class="large-9 small-8 column">
							<h3>ޖަޕާނުގެ ބެޑްމިންޓަން އެސޯސިއޭޝަނާ މޫސަ ބައްދަލުކޮށްފި</h3>
							<div class="time">
								<time datetime="2015-11-18 22:20:04">8 ގަޑިއިރު ކުރިން</time>
							</div>
							<p class="hide-for-small-only">މިއަދު އެމްޑީޕީން ވަކިކުރައްވާފައިވާ ރައްޔިތުންގެ މަޖިލީހުގެ ނައިބްރައީސް ހުޅުހެންވޭރު ދާއިރާގެ މެމްބަރު ރީކޯ މޫސާ މަނިކު އެއްވެސް ޕާޓީއަކަށް ސޮއިކުރައްވަން ނޫޅުއްވާ ކަމަށް ވިދާޅުވެއްޖެ އެވެ.</p>
						</div>
					</a>
				</li>
			</ul>
		</div>
		<ul class="pagination">
			<li><a href="" class="arrow"><i class="fa fa-chevron-right"></i></a></li>
			<li><a href="1">1</a></li>
			<li><a href="2">2</a></li>
			<li><a href="3">3</a></li>
			<li><a href="4">4</a></li>
			<li><a href="5">5</a></li>
			<li><a href="6">6</a></li>
			<li><a href="7">7</a></li>
			<li><a href="8">8</a></li>
			<li><a href="9">9</a></li>
			<li><a href="10">10</a></li>
			<li><a href="11">11</a></li>
			<li><a href="12">12</a></li>
			<li><a href="2" class="arrow"><i class="fa fa-chevron-left"></i></a></li>
		</ul>
	</div>
	<div class="large-4 column hide-for-small-only">
		<div class="recents">
			{{-- TABS --}}
			@include('rashoveshi.home.recent-listing-home')
		</div>
		<div class="result-ad">
			<div class="ad">
				<img src="{{asset('images/ads/article-side.png')}}" style="border:1px solid #ddd;">
			</div>
		</div>
	</div>
</div>
@stop