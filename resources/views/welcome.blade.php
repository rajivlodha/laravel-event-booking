@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<h1>Welcome to Gala Events</h1>
					<p>This is a simple lorem ipsum text for the print industry, it does not carries any information, it was prepared by an anonymous user for the print industry and now it is being widely used in the website creating industry, when you have nothing to type or when you need some dummy text then lorem ipsum the widely used dummy text in the world.</p>


		<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDtxNYlvIT0UmwfM1jmqwFjj5ip9PNWjHk'></script>
		
		<div style='overflow:hidden;height:540px;width:800px;'>
			<div id='gmap_canvas' style='height:540px;width:800px;'></div>
			
		
		</div>

				<script type='text/javascript'>


				function init_map()
				{
					var myOptions = {zoom:4,center:new google.maps.LatLng(39.7392358,-104.990251),mapTypeId: google.maps.MapTypeId.ROADMAP};
				
					map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);


					var marker = [];
					var infowindow = [];

					@foreach($events as $row)
						
						marker[{{$row->id}}] = new google.maps.Marker({map: map,position: new google.maps.LatLng({{ $row->maplat }}, {{ $row->maplong }}  )});
					
						infowindow = new google.maps.InfoWindow({content:'<strong>{{ $row->eventname }}</strong><br>{{ $row->place }}<br> {{ date("F jS, Y", strtotime($row->eventdate)) }} <br /><strong><a href="/events/{{$row->id}}">Book Your Place</a></strong>'});
					
						google.maps.event.addListener(marker[{{$row->id}}], 'click', function(){infowindow.open(map,marker[{{$row->id}}]);});

						infowindow.open(map,marker[{{$row->id}}]);

					@endforeach

				}

				google.maps.event.addDomListener(window, 'load', init_map);

				</script>



				</div>

			</div>
		</div>
	</div>
</div>
@endsection
