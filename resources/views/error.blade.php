@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<h1>Oops, Error Occured</h1>
		@if(isset($error_message))
			<p><strong>{!! $error_message !!}</strong></p>
		@else
			<p><strong>Something is wrong at the server side, the server could not understand the request you have made.</strong></p>
		@endif
	</div>
</div>		


@endsection