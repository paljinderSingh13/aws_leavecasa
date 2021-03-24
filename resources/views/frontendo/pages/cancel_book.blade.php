@extends('frontend.layout.materialize')
@section('content')
<h4 class="valign center">cancel Status</h4>
<div class="row mb-2 ">

<div class="col l12 s12">
@php

 dump($cancel_res);

@endphp
<table>
	<tbody>
				
		@foreach($cancel_res as $ckey	=> $cval)


@if(is_array($cval))

<tr>
			<td>{{ $ckey }} </td>
			<td> 
				<table>
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


</div></div>

@endsection