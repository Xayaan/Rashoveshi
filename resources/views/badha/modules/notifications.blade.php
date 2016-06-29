@if ($message = Session::get('success'))
<div class="ui success message">
	<i class="close icon"></i>
  	<div class="header">
    	{{ $message }}
  	</div>
</div>
@endif


@if (count($errors) > 0)
	<div class="ui error message">
		<i class="close icon"></i>
	  	<div class="header">
	    	There was some errors with your submission
	  	</div>
	  	<ul class="list">
	    	@foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
	 	</ul>
	</div>
@endif

<script type="text/javascript">
	$(document).ready(function(){
		$('.message .close').on('click', function() {
			    $(this)
			      .closest('.message')
			      .transition('fade')
			    ;
 			});
	});
</script>