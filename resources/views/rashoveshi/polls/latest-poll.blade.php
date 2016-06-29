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
				<div id="barWrapper"></div>
				<div id="pollResults"></div>
	    		<?php
	    			$colors = ['green', 'blue', 'orange', 'red', 'violet'];
	    			$colors2 = [
	    				'#569d46', '#285589', '#f09e2e', '#ce1e28', '#753977'
	    			];
	    			$colorCount = 0;
	    			$x = 0;
	    		?>
				<form action="{{ url('poll/vote/'.$poll->id) }}" method="POST" class="poll-form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    			<ul class="choices">
	    				<script>
	    					var data = [];
	    					var dataset = [];
	    					var barCategories = [];
	    					var barVotes = [];
	    				</script>
		    			@foreach($poll->choices as $choice)
		    				<?php $colorCount++; ?>
		    				<script>
	    						@if($totalVotes > 3)
		    						data.push({
								        value: '{{ round($choiceAvg[$x]) }}',
								        label: '{{ round($choiceAvg[$x]) }}%',
								        color: '{{ $colors2[$colorCount] }}'
							    	});
							    	dataset.push({{ round($choiceAvg[$x]) }});
				    				barCategories.push('{{ $choice->name }}');

									barVotes.push('{{ round($choiceAvg[$x]) }}');

							    @endif
		    				</script>
		    				<?php $x++ ?>
			    			<li class="choice">
			      				<span class="block {{ $colors[$colorCount] }}" style="display:none"></span>
			      				<input type="radio" name="vote" id="vote" class="vote" value="{{ $choice->id }}" style="    outline:5px solid  {{ $colors2[$colorCount] }};*filter: progid:DXImageTransform.Microsoft.dropshadow(OffX=-1, OffY=0,color=#FF0000) progid:DXImageTransform.Microsoft.dropshadow(OffX=1, OffY=0,color=#FF0000) progid:DXImageTransform.Microsoft.dropshadow(OffX=0, OffY=-1,color=#FF0000) progid:DXImageTransform.Microsoft.dropshadow(OffX=0, OffY=1,color=#FF0000);">
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
						
						<span class="poll-total-votes">ޖުމްލަ <span>{{ $totalVotes }}</span> ވޯޓް</span>
						<style>
						ul.share-buttons{
						  list-style: none;
						  padding: 0;
						  display: inline;
						  text-align: center;
						}
						ul.share-buttons li a img {
							width: 45px;
							margin-left: 10px;
						}
						</style>
						<hr>
						<?php 
						$socialText = $poll->title.$poll->desc.'The choices are:';
						$choicesText = '';
						$choiceX = 0;
						foreach ($poll->choices as $choice) {
							$choiceX++;
							$choicesText .= $choiceX.$choice->name.', ';
						}
						$socialText .= $choicesText;
						?>
						<ul class="share-buttons social-bar">
						  <li><a href="https://www.facebook.com/dialog/feed?app_id=511062222413367&amp;link=rashoveshi.mv&amp;picture={{ asset('images/pollShare.png') }}&amp;name={{ $poll->title }}&amp;caption={{ $poll->desc }}&amp;description=The choices are {{ $choicesText }}&amp;message=This is poll is so awesome. Share your voice!&amp;redirect_uri=http://rashoveshi.mv" title="Share on Facebook" target="_blank"><img class="social-icons" src="{{ asset('images/facebook-icon.png') }}"></a></li>
						  <li><a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Frashoveshi.mv&amp;text={{$socialText }}:%20http%3A%2F%2Frashoveshi.mv"  title="Tweet"><img class="social-icons" src="{{ asset('images/twitter.png') }}"></a></li>
						  <li><a href="https://plus.google.com/share?url=http%3A%2F%2Frashoveshi.mv" target="_blank" title="Share on Google+"><img class="social-icons" src="{{ asset('images/gooplus.png') }}"></a></li>
						</ul>
		  				<div class="clearfix"></div>
		  			</div>
		  			</form>
			
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.16/d3.min.js"></script>
 		<script>
		// var w = 250;
		// var h = 250;
		// var r = h/2;
		// var color = d3.scale.category20c();
		// var vis = d3.select('#pollResults').append("svg:svg").data([data]).attr("width", w).attr("height", h).append("svg:g").attr("transform", "translate(" + r + "," + r + ")");
		// var pie = d3.layout.pie().value(function(d){return d.value;});

		// // declare an arc generator function
		// var arc = d3.svg.arc().outerRadius(r);

		// // select paths, use arc generator to draw
		// var arcs = vis.selectAll("g.slice").data(pie).enter().append("svg:g").attr("class", "slice");
		// arcs.append("svg:path")
		//     .attr("fill", function(d, i){
		//         return d.data.color;
		//     })
		//     .attr("d", function (d) {
		//         // log the result of the arc generator to show how cool it is :)
		//         console.log(arc(d));
		//         return arc(d);
		//     });

		// // add the text
		// arcs.append("svg:text").attr("transform", function(d){
		// 			d.innerRadius = 0;
		// 			d.outerRadius = r;
		//     return "translate(" + arc.centroid(d) + ")";}).attr("text-anchor", "middle").text( function(d, i) {
		//     return data[i].label;}
		// 		);
 
 		$('.poll-form').submit(function(event) {
	        var formData = {
	            'choice': $('input[name="vote"]:checked').val(),
	            '_token': '{{ csrf_token() }}'
	        };

	        $.ajax({
	            type     : 'POST', 
	            url      : '{{ url('poll/vote/'.$poll->id) }}', 
	            data     : formData, 
	            dataType : 'text',
	            encode   : true
	        }).done(function(data) {
	            
					$('.vote').hide();
					$('.block').show();
					$('.poll-button').prop("disabled",true);
					tv = $('.poll-total-votes span').html();

					$('.poll-total-votes span').html(parseInt(tv) + 1);
	            
	        });

	        event.preventDefault();

	    });
		</script>
		<script>
	    	var colors = ['#285589', '#f09e2e', '#ce1e28', '#753977', '#569d46'];

			var w = 290;
			var h = 200;
			var barPadding = 10;

			var svg = d3.select("#barWrapper")
			            .append("svg")
			            .attr("width", w)
			            .attr("height", h);

			svg.selectAll("rect")
			   .data(dataset)
			   .enter()
			   .append("rect")
			   .attr("x", function(d, i) {
			   		return i * (w / dataset.length);
			   })
			   .attr("y", function(d) {
				    return h - (d * 3);
				})
			   .attr("width", w / dataset.length - barPadding)
			   .attr("height", function(d) {
				    return d * 3;
				})
			   .attr("fill", function(d, i) {
				    return colors[i];
				});

			svg.selectAll("text")
			   .data(dataset)
			   .enter()
			   .append("text")
			   .text(function (d) {
			   		return d + '%';
			   })
			   .attr("x", function(d, i) {
			        return i * (w / dataset.length) + 40;
			   })
			   .attr("y", function(d) {
			        return h - 5;
			   })
			   .attr("font-family", "sans-serif")
			   .attr("font-size", "18px")
			   .attr("fill", "black");

			</script>
	@endif