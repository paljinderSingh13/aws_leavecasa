@extends('frontend.layout.materialize')
@section('content')
<div>

	@if(!empty($block))
	<h4 class="red-text">This is live ticket booking  so it is block for testing.</h4>

	@endif

	@if(!empty($error[0]['messages'][0]))
	
	<h4 class="red-text">{{ $error[0]['messages'][0]}}</h4>
	@else
	<h4 class="red-text">Something goes wrong!  </h4>
	@endif

</div>

@endsection