@extends('frontend.layout.materialize')
@section('content')
@php

  dump($recheck);
@endphp

@if(!empty($recheck['errors']))

<h5 class="red-text fw100 ">Something went wrong Try Again </h5>

@else

<table class="striped" >
	<tbody>

		@foreach($recheck as $ckey	=> $cval)

@if(is_array($cval))

<tr>
			<td>{{ $ckey }} </td>
			<td> 
				<table class="striped">
					@foreach($cval as $nkey => $nval)
						@if(is_array($nval))

						@else
						<tr>
							<td>{{ $nkey }}</td>
							<td>{{ $nval }}</td>
						</tr>
						@endif
					@endforeach
				</table>

			</td>
</tr>

@else
		<tr>
			<td>{{ $ckey }} </td>
			<td> {{ $cval }}</td>
		</tr>
@endif

		@endforeach
	</tbody>

</table>
@endif


@endsection