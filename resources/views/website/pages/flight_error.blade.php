@extends('frontend.layout.materialize')
@section('content')
<div>

	@if(!empty($error_message))
	
	<h4 class="red-text">{{ $error_message}}</h4>
	@else
	<h4 class="red-text">Something goes wrong!  </h4>
	@endif

</div>

@endsection