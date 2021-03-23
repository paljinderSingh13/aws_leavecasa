@extends('frontend.layout.materialize')
@section('content')

<h5 class="center-align">Booking Details</h5>
@if(!empty($recheck['errors']))
@php
  dump(json_encode($recheck));
@endphp
<h5 class="red-text fw100 ">Something went wrong Try Again </h5>

@else
@php

//  dd($recheck);
@endphp
<div class="row">
	<div class="col l7">
<div class="card">
	<
	<table><tbody>
		
		<tr>
			<td>Hotel</td>
			<td>{{ $recheck['hotel']['name'] }}</td>
		</tr>
		<tr>
			<td>Booking Id</td>
			<td>{{ $recheck['booking_id'] }}</td>
		</tr>
		<tr>
			<td>Booking Reference</td>
			<td>{{ $recheck['booking_reference'] }}</td>
		</tr>
		<tr>
			<td>Booking Date</td>
			<td>{{ $recheck['booking_date'] }}</td>
		</tr>
		<tr>
			<td>Booking Status</td>
			<td class="lc">{{ $recheck['status'] }}</td>
		</tr>
		<tr>
			<td>Payment Status</td>
			<td class="lc">{{ $recheck['payment_status'] }}</td>
		</tr>
		<tr>
			<td>Check In</td>
			<td class="lc">{{ $recheck['checkin'] }}</td>
		</tr>
		<tr>
			<td>Check Out</td>
			<td class="lc">{{ $recheck['checkout'] }}</td>
		</tr>
		<tr>
			<td>Cancellation</td>
			<td>
				@if($recheck['supports_cancellation']=='1')
				Yes
				@else
				No
				@endif
			</td>
		</tr> 
		<tr>
			<td>Country</td>
			<td>{{ $recheck['holder']['client_nationality'] }}</td>
		</tr>
	</tbody>
</table>
<h5>Guest Detail</h5>
<table>
		<tr>
		    <th>Name</th>
			<th>Contact</th>
			<th>Email</th>
		   </tr>
		   <tr>
			<th>{{ $recheck['holder']['name'] }}</th>
			<th>{{ $recheck['holder']['phone_number'] }}</th>
			<th>{{ $recheck['holder']['email'] }}</th>
		   </tr>
		
	</tbody></table>

</div>
</div>
<div class="col l5">
 <div class="card">
 	<p>
 		{{ $recheck['hotel']['name'] }}
 	</p>
 	<p>
 		{{ $recheck['hotel']['address'] }}
 	</p>

 </div>	
</div>
</div>
@endif
@endsection