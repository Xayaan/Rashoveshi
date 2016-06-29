	@if(isset($poll))
		<style>
			.poll {
				background-color: #fff;
				border-top: 3px solid #66b922;
				padding: 10px;
				padding-bottom: 0px;
			}

			.poll-head {
				color: #66b922;
			}

			.choice-footer {
				padding: 5px;
			}

			.poll-button {
				background-color: #7BC93A;
				margin-left: 15px;
			    padding: 15px 30px !important;
			    color: #fff;
			    font-size: 16px;
			    font-weight: bold;
			    float: right;
			}

			.poll-total-votes {
				float: left;
			}

			ul.choices {
				list-style: none;
				margin-right: 0;
				float: right;
			}

			#pollResults {
				float: left;
				margin: 10px;
			}

			.choice {
				padding: 5px;
			}

			.choice .block {
				float: right;
			}

			.choice .option {
				margin-right: 15px;
			}

			.block {
				width: 20px;
				height: 20px;
			}

			.green {
				background-color: #569d46;
			}

			.orange {
				background-color: #f09e2e;
			}

			.red {
				background-color: #ce1e28;
			}

			.blue {
				background-color: #285589;
			}

			.violet {
				background-color: #753977;
			}
		</style>
		<div class="column poll">
	    	<h4 class="poll-head"><i class="fa fa-list left"></i>   ރަށޮވެށި ޕޯލް</h4>
				<hr>
				<h5>
					{{ $poll->title }}
				</h5>
				<p>
					{{ $poll->desc }}
				</p>
				<canvas id="pollResults" width="150" height="150"></canvas>
	    		<?php
	    			$colors = ['green', 'blue', 'orange', 'red', 'violet'];
	    			$colorCount = 0;
	    			$x = 0;
	    		?>
				<form action="{{ url('poll/vote/'.$poll->id) }}" method="POST" class="poll-form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    			<ul class="choices">
	    				<script>
	    					pieData = [];
	    				</script>
		    			@foreach($poll->choices as $choice)
		    				<?php $colorCount++; ?>
		    				<script>
	    						@if($totalVotes > 3)
		    						pieData.push({
								        value: '{{ round($choiceAvg[$x]) }}',
								        label: '%',
								        color: '{{ $colors[$colorCount] }}'
							    	});
							    	console.log($x);
							    @endif
		    				</script>
		    				<?php $x++ ?>
			    			<li class="choice">
			      				<span class="block {{ $colors[$colorCount] }}" style="display:none"></span>
			      				<input type="radio" name="vote" id="vote" class="vote" value="{{ $choice->id }}">
				     			<span class="option">
							     	{{ $choice->name }}
							     </span>
							     <div class="clearfix"></div>
				  			</li>
				  		@endforeach
	  				</ul>
			  		<hr>
		  			<div class="choice-footer">
						<button type="submit" class="button poll-button">ވޯޓް ދެއްވުމަށް</button>
						</form>
						<span class="poll-total-votes">ޖުމްލަ {{ $totalVotes }} ވޯޓް</span>
		  				<div class="clearfix"></div>
		  			</div>
			</div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
		<script>
		$('.poll-form').submit(function(event) {
	        var formData = {
	            'choice': $('input[name="vote"]:checked').val(),
	            '_token': '{{ csrf_token() }}'
	        };

	        $.ajax({
	            type     : 'POST', 
	            url      : '{{ url('poll/vote/'.$poll->id) }}', 
	            data     : formData, 
	            dataType : 'json',
	            encode   : true
	        }).done(function(data) {
	            console.log('Voted!');
	        });

	        event.preventDefault();

			$('.vote').hide();
			$('.block').show();

			var context = document.getElementById('pollResults').getContext('2d');
			var pollResults = new Chart(context).Pie(pieData);
	    });
		</script>
	@endif