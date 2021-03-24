@extends('frontend.layout.materialize')
@section('content')


<div>
	

	<p> {{ $urls }}</p>

	<a class="btn" 
	href="{{$urls}}"> Payment redirect </a>
</div>

@endsection 