@extends('frontend.layout.materialize')
@section('content')
<div>

	
<h5> Error </h5>
<h6 class="red-text"> {{ $desc }}</h6>
{{-- <ul>
	@foreach($desc as $key => $val)
		<li><label>{{ $key }}</label> {{  $val  }}</li>
	@endforeach
</ul> --}}
	
	

</div>

@endsection