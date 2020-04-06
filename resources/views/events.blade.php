

@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
				
				<h1>Book Your Stall @ {{ $event->eventname }} ( {{ $event->place }} )</h1>	
				@foreach($stalls as $row)
					<div class="stalldiv">

							<h5 class="center">Stall #{{ $row->stallid }}</h5>
						@if($row->id == 0)

							<h1 class="center">FREE</h1>
							<h3 class="center"><a href="/book/{{ $event->id }}/{{ $row->stallid }}"></a></h3>

							  <center>
							  	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{ $row->stallid }}">Book Stall for ${{ $row->price }}</button>
							  </center>

							  <!-- Modal -->
							  <div class="modal fade" id="myModal{{ $row->stallid }}" role="dialog">
							    <div class="modal-dialog">
							      <!-- Modal content-->
							      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Book Stall {{ $row->stallid }} @ {{ $event->eventname }} ( {{ $event->place }} )</h4>
							        </div>
							        <div class="modal-body">
							          <p><img src="/xdata/stall/{{ $row->image}}" height="300" /></p>
							        </div>
							        <div class="modal-footer">
							        <a href="/book/{{ $event->id }}/{{ $row->stallid }}">
							          <button type="button" class="btn btn-default">Reserve</button></a>
							        </div>
							      </div>
							    </div>
							  </div>

 

						@else
							<h4 class="center">Booked</h4>
							<img src="/xdata/logos/{{ $row->complogo}}" height="80" /><br />
							<p align="center"><a href="http://{{ $row->compweb }}" title="Click to viist Website">{{ $row->compname }} / {{ $row->compcontact }}</a></p>
							<p class="center"><a href="/xdata/ppt/{{ $row->compppt }}">Download Prospectus</a></p>
						@endif	
					</div>

					@if($row->stallid % 3 == 0)
						<div class="clear"></div>
					@endif

				@endforeach

				</div>
			</div>
		</div>
	</div>
</div>
@endsection


		
