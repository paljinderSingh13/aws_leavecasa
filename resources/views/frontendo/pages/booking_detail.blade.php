@extends('frontend.layout.materialize')
@section('content')

 <div class="row mdb p1">
        <div class="col offset-l1 l5 s12">
            <p class="f28w100 white-text mt0 mb0">View Your Booking</p>
        </div>
       </div> 
   <div class="container"> 
   <div class="row lform">
    <div class="col card offset-l3 l5 mt4"> 
     <div class="card-content"> 
 <span class="card-title valign center">Hotel Booking</span>


<form  action="{{ route('book.status') }}" method="post" id="booking_status">
 {{ csrf_field() }} 

     
        <div class="row">
        <div class="input-field">
        <input id="bref" name="bref" type="text" class="validate" required>
          <label for="bref">Reference ID</label>
        </div>
      </div>

      <div class="row valign center">
               <button class="btn li-red " type="submit">Submit
            <i class="material-icons right">search</i>
          </button>
        </div>
      </div>
   
</form>	</div></div> </div></div>

<div class="container">
<div class="row">

<div class="col l8 s12">
@php
dump($status_res);
 //dump($status_res['booking_reference']);

@endphp
<a href="{{ route('cancel.hotel.book',['bref'=>$status_res['booking_reference']]) }}" class="btn li-red">Cancel
            <i class="material-icons right">search</i>
          </a>
		<table id="cancelTable"><tbody>
		
		<tr>
			<td>Hotel</td>
			<td>{{ $status_res['hotel']['name'] }}</td>
		</tr>
		<tr>
			<td>Hotel Contact</td>
			<td>{{ @$status_res['hotel']['phone_number'] }}</td>
		</tr>
		<tr>
			<td>Booking Id</td>
			<td>{{ $status_res['booking_id'] }}</td>
		</tr>
		<tr>
			<td>Booking Reference</td>
			<td>{{ $status_res['booking_reference'] }}</td>
		</tr>
		<tr>
			<td>Booking Status</td>
			<td class="lc">{{ $status_res['booking_status'] }}</td>
		</tr>
		<tr>
			<td>Payment Status</td>
			<td class="lc">{{ $status_res['payment_status'] }}</td>
		</tr>
		<tr>
			<td>Check In</td>
			<td class="lc">{{ $status_res['checkin'] }}</td>
		</tr>
		<tr>
			<td>Check Out</td>
			<td class="lc">{{ $status_res['checkout'] }}</td>
		</tr>
		<tr>
			<td>Cancellation</td>
			<td>
				@if($status_res['supports_cancellation']=='1')
				Yes
				@else
				No
				@endif
			</td>
		</tr> 
		<tr>
			<td>Country</td>
			<td>{{ $status_res['nationality'] }}</td>
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
			<th>{{ $status_res['holder']['name'] }}</th>
			<th>{{ $status_res['holder']['phone_number'] }}</th>
			<th>{{ $status_res['holder']['email'] }}</th>
		   </tr>
		
	</tbody></table>
</div>
</div></div>
@endsection