	<div class="large-4 column poll">
    	<h4><i class="fa fa-list left"></i>  ރަސޮވެށި ޕޮލް</h4>
			<hr>
			<h5>
				{{ $poll->title }}
			</h5>
			<p>
				{{ $poll->desc }}
			</p>
			<canvas id="pollResults" width="150" height="150" style="display:none"></canvas>
    		{{ 
    			$colors = ['green', 'blue', 'orange', 'red', 'violet'];
    			$colorCount = 0;
    		}}
			<form action="{{ url('poll/'.$poll->id.'vote') }}" method="POST"></form>
    			<ul class="choices">
    				<script>
    					pieData = [];
    				</script>
	    			@foreach($poll->choices as $choice)
	    				{{ $colorCount++ }}
	    				<script>
	    					pieData.push({
						        value: {{ $choiceAvg[$colorCount] }},
						        label: {{ $choice->name }},
						        color: {{ $color[$colorCount] }}
						    });
	    				</script>
		    			<li class="choice">
		      				<span class="block {{ $color[$colorCount] }}" style="display:none"></span>
		      				<input type="radio" name="vote" id="vote" value="{{ $choice->id }}">
			     			<span class="option">
						     	{{ $choice->name }}
						     </span>
						     <div class="clearfix"></div>
			  			</li>
			  		@endforeach
  				</ul>
		  		<hr>
	  			<div class="choice-footer">
					<button type="submit" class="button poll-button">ޯޓް ދެއްވުމައް</button>
					<span class="poll-total-votes">ުމްލަ ވޯޓް</span>
	  				<div class="clearfix"></div>
	  			</div>
			</form>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
	<script>
	$('form').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'choice': $('input[name="vote"]:checked').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : '{{ url('polls/'.$poll->id.'/vote') }}', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
                        encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                // here we will handle errors and validation messages
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
		$('#vote').hide();
		$('.block').show();
		$('#pollResults').show();
		var context = document.getElementById('pollResults').getContext('2d');
		var pollResults = new Chart(context).Pie(pieData);
    });
	</script>
@endsection