@extends('frontend.layout.materialize1')
@section('content')


@if(!empty($recheck['errors']))
<h5 class="red-text fw100 ">Something went wrong Try Again </h5>

@else
@php

$req_info = session::get('hotel_req');
dump($req_info);
dump($recheck);
@endphp

 @php
     $adult=0;
     $childs=0;
     foreach($req_info['rooms'] as $room_nos => $room_vals){	
     if(!empty($room_vals['adults'])){	
		  $adult+= $room_vals['adults'];
		 } 

	if(!empty($room_vals['children_ages'])){	
		$childs+= count($room_vals['children_ages']);
		 } 
		}


	@endphp

<div class="row">
    <div class="card mdb">
        <div class="card-content">
          <div class="col l1 offset-l2">
             <i class="material-icons medium white-text">thumb_up</i> 
          </div>
          <div class="col l7">
           <h5 class="white-text mt-0">{{ $recheck['holder']['title'] }} <span class="lc">{{ $recheck['holder']['name'] }}</span> Your Booking is confirmed now. Thank You!</h5>
           <p class="white-text">Your Booking Reference is <span class="">{{ $recheck['booking_reference'] }}</span></p>
          
        </div>
    </div>
</div></div>
<div class="row mdb">
	<div class="col l7">
<div class="card  z-depth-4 border-radius-8">
	<div class="card-content">
	<table><tbody>
		<tr>
			<td>Booking Id</td>
			<td>{{ $recheck['booking_id'] }}</td>
		</tr>
		<tr>
			<td>Payment </td>
			<td class="lc">{{ $recheck['payment_status'] }}</td>
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
		
	</table>
</div>
</div>
</div>
<div class="col l5">	
 <div class="card  z-depth-4 border-radius-8">
 	 <div class="card-content p2">
 	<table><tbody>
	<tr>
		<h5 class="card-title red-text">
 			HOTEL DETAILS
 		</h5>
 	 	<p class="lc">Name : 
 		{{ $recheck['hotel']['name'] }}
 	</p>
 	<p class="lc">Address : 
 		{{ $recheck['hotel']['address'] }}
 	</p>
 </tr>
 <tr>
  		<h5 class="card-title red-text">BOOKING SUMMARY</h5>	
 		<h6><i class="fas fa-home green-text"></i>{{ count($req_info['rooms']) }} Rooms  , <i class="fas fa-user-tie mdb-text"></i> {{ $adult }}  Adults ,<i class="fas fa-child mdb-text"></i> {{ $childs }} Child
				</h6>
 		<p class="lc">Booking Date : 
 			{{ $recheck['booking_date'] }}
 		</p>	
 			<p class="lc"> Check-in : 
 				{{ \Carbon\Carbon::parse($recheck['checkin'])->format('d M ,Y') }}
 	</p>
 	<p class="lc"> Check-out : 
 		{{ \Carbon\Carbon::parse($recheck['checkout'])->format('d M ,Y') }}
 	</p>
 </tr>
 <tr> 	
 			<span class="card-title red-text">
 			CHARGES
 		</span> 		
 </tr></tbody>
</table>
</div>
</div></div></div>
<div class="row">
    </div>
 @php
//dump($recheck);
 @endphp   
@endif
@endsection