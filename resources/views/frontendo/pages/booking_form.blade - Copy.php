@extends('frontend.layout.materialize')
@section('content')

@php
use App\Helpers\Hotel;

	$req_info = session::get('hotel_req');
	//dd($req_info, $recheck);
//echo data_get($recheck);
dump($recheck['hotel']['rate']['rooms']);
dump($recheck);


// if(!empty($recheck['hotel']['rate'])){
// 	$rate = $recheck['hotel']['rate'];
// }
// 		if(!empty($rate['cancellation_policy_code'])) {
// 				$cp = Hotel::get_policy_by_code($recheck['search_id'], $rate['rate_key'], $rate['cancellation_policy_code']);

// 				dump($cp);

// 		}	
	
@endphp

<div class="row mdb">
	<div class="col offset-l1  pushpin-demo-nav">
		<h4 class="white-text"> Booking Details</h4>
	</div>
</div>	

<div class="container">

<div class="row">
<h4>Traveller Information</h4>		

<div class="card col l8">
	<form method="post" action="{{ route('hotel.final.book') }}" class="card-content">
	{{ csrf_field() }}
	 <div class="row p1">
	 	<p class="f22w200 mdb-text pt2 pl1"> <span class="valign center">Contact Detail</span></p>
	 	<div class="col s12  l4">
	 			Title<select name="holder[title]">
	 				<option value="Mr."> Mr</option>
	 				<option value="Ms."> Ms</option>
	 				<option value="Mrs."> Mrs</option>
	 				<option value="Mstr."> Mstr</option>
	 			</select></div>
		  {{-- title<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]" > --}}
		   <div class="col s12  l4">name <input type="text" name="holder[name]" required></div>
		   <div class="col s12  l4">surname<input type="text" name="holder[surname]" required></div>
		   <div class="col s12  l4">email<input type="email" name="holder[email]" required></div>
		   <div class="col s12  l4">phone number<input type="text" name="holder[phone_number]" pattern="[1-9]{1}[0-9]{9}" maxLength="10" required></div>
		</div>
		<h5>Guest Info</h5>
   @foreach($req_info['rooms'] as $room_no => $room_val)

   @php

   dump($room_val);
   @endphp
	<p class="f22w200 mdb-text pt2 pl1">Room {{ $loop->iteration }}, <span class="valign center">Adult Info</span></p>
	@if(!empty($room_val['adults']))
			<!-- <h4 class="p1"> adult Info</h4> -->
		 @for($i=0; $i < $room_val['adults']; $i++ )

		 @if(!empty($recheck['hotel']['rate']['rooms'][$i]['room_reference']))
			<input type="hidden"  name="room[rooms][{{$i}}][room_reference]" value="{{ $recheck['hotel']['rate']['rooms'][$i]['room_reference'] }}">
		@endif


		 <div class="row p1">
		 	
		 <div class="col s12  l4">
		 			Title<select name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]">
		 				<option value="Mr."> Mr</option>
		 				<option value="Ms."> Ms</option>
		 				<option value="Mrs."> Mrs</option>
		 				<option value="Mstr."> Mstr</option>

		 				
		 			</select></div>
			  {{-- title<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]" > --}}
			   <div class="col s12  l4">name <input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][name]" required></div>
			   <div class="col s12  l4">surname<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][surname]" required></div>
			  <input type="hidden" value="AD" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][type]" >
			</div>
		 @endfor
	@endif


		 @if(!empty($room_val['children_ages']))

		 <h5>Child info</h5>
			<input type="hidden" name="room[rooms][{{$loop->index}}][no_of_infants]" value="{{ count($room_val['children_ages'])  }}">

		  	@for($c=0; $c < count($room_val['children_ages']); $c++ )
		 		@php
		 			$j = $i++;
		 		@endphp
		 		<div class="row">
		 		<div class="col s12  l4">	
		 	 	Title<select name="room[rooms][{{$loop->index}}][paxes][{{ $j }}][title]">
		 				<option value="Mr."> Mr</option>
		 				<option value="Ms."> Ms</option>
		 				<option value="Mrs."> Mrs</option>
		 				<option value="Mstr."> Mstr</option>
		 			</select></div>
			  	<div class="col s12  l4">Name <input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $j }}][name]" required></div>
			  	<div class="col s12  l4">Surname<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $j}}][surname]" required></div>
			  	<input type="hidden" value="CH" name="room[rooms][{{$loop->index}}][paxes][{{ $j }}][type]" >
			  	<input type="hidden" value="{{ $room_val['children_ages'][$c] }}" name="room[rooms][{{$loop->index}}][paxes][{{ $j }}][age]" >
			  </div>

		 	@endfor

		 @endif
	
@endforeach


@php

 //dump($recheck);

@endphp



<input type="hidden"  name="search_id" value="{{ $recheck['search_id'] }}">
<input type="hidden"  name="hotel_code" value="{{ data_get($recheck, 'hotel.hotel_code') }}">
<input type="hidden"  name="city_code" value="{{ data_get($recheck, 'hotel.city_code') }}">
<input type="hidden"  name="rate_key" value="{{ data_get($recheck, 'hotel.rate.rate_key') }}">
<input type="hidden"  name="room_code" value="{{ data_get($recheck, 'hotel.rate.room_code') }}">
<input type="hidden"  name="group_code" value="{{ data_get($recheck, 'hotel.rate.group_code') }}">
<input type="hidden"  name="checkin" value="{{ $req_info['checkin']}}">
<input type="hidden"  name="checkout" value="{{ $req_info['checkout'] }}">
<input type="hidden"  name="booking_name" value="Acme{{ rand(000000,999999) }}">



<button type="submit" class="btn red" name="">Continue</button>
<a href="javascript:modal_detail(0)" class="modal-trigger">Cancellation Policy</a>
</form>
<div class="modal" id="modal0"  tabindex="-1">
 <div class="modal-content">
      <h5 class="center-align">Cancellation Policy</h5>
@if(!empty($recheck['hotel']['rate']))
@php	
	$rate = $recheck['hotel']['rate'];
@endphp
@endif
@if(!empty($rate['cancellation_policy_code']))
@php
	$cp = Hotel::get_policy_by_code($recheck['search_id'], $rate['rate_key'], $rate['cancellation_policy_code']);

				dump($cp);
@endphp
@endif


          
	      	


	<table id="cancel_detail">
		@if(!empty($rate['non_refundable'])&&($rate['non_refundable']==true))
		<tr><h6 class=""><span class="orange-text"> &#2547;</span>  This is Non-refundable</h6></tr>
		@endif
		{{-- <tr><h6 class=""><span class="orange-text"> &#2547;</span>  Cancellations are only allowed before 					{{ \Carbon\Carbon::parse($hotel_req['checkin'])->format('d M ,Y') }}</h6></tr> --}}
		{{-- <tr><h6 class=""><span class="orange-text"> &#2547;</span>  All time mentioned above is in destination time.</h6></tr> --}}
		{{-- <tr><h6 class=""><span class="orange-text"> &#2547;</span>  Cancellation not allowed.</h6></tr> --}}
		@if(!empty($rate['cancellation_policy']["details"][0]["from"]))
		<tr> <h6><span class="orange-text"> &#2547;</span> Cancellation charges starts from
			{{ \Carbon\Carbon::parse($rate['cancellation_policy']["details"][0]["from"])->format('d M ,Y H:i:s') }}</h6>
		</tr>

		@elseif(!empty($cp['details'][0]['from']))
		<tr> <h6><span class="orange-text"> &#2547;</span> Cancellation charges starts from
			{{ \Carbon\Carbon::parse($cp['details'][0]['from'])->format('d M ,Y H:i:s') }}
		</h6></tr>		 
		 @endif


		 @if(!empty($cp['no_show_fee']['flat_fee']) && (!empty($cp['no_show_fee']['currency'])))
			<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{ $cp['no_show_fee']['currency'] }} {{ $cp['no_show_fee']['flat_fee'] }} </h6></tr>

		@elseif(!empty($rate['cancellation_policy']['no_show_fee']['flat_fee']) &&(!empty($rate['cancellation_policy']['no_show_fee']['currency'])))

		   <tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$rate['cancellation_policy']['no_show_fee']['currency']}}  {{ $rate['cancellation_policy']['no_show_fee']['flat_fee']}} .</h6></tr>			                
		 @elseif(!empty($rate['cancellation_policy']['details'][0]['flat_fee']) &&(!empty($rate['cancellation_policy']['details'][0]['currency'])))

		   <tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$rate['cancellation_policy']['details'][0]['currency']}}  {{ $rate['cancellation_policy']['details'][0]['flat_fee']}} .</h6></tr>			                  
	   @endif

		@if(!empty($cp['cancel_by_date']))
		<tr> <h6><span class="orange-text"> &#2547;</span> Free cancellation till 			
			{{ \Carbon\Carbon::parse($cp['cancel_by_date'])->format('d M ,Y H:i:s') }}
			</h6></tr>	

		@elseif(!empty($rate['cancellation_policy']['cancel_by_date']))
		<tr><h6> <span class="orange-text"> &#2547;</span> Free cancellation till 						              
			{{ \Carbon\Carbon::parse($rate['cancellation_policy']['cancel_by_date'])->format('d M ,Y H:i:s') }}
		</h6></tr>		 
		 @endif
	
		

	   @if(!empty($rate['cancellation_policy']['no_show_fee']['percent']))
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$rate['cancellation_policy']['no_show_fee']['percent']}} %</h6></tr>			                
		@elseif(!empty($cp['no_show_fee']['percent']))
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$cp['no_show_fee']['percent']}} %</h6></tr>	
		@elseif(!empty($rate['cancellation_policy']['details'][0]['percent']))
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$rate['cancellation_policy']['details'][0]['percent']}} %</h6></tr>			                
		@endif
     </table>
			      	
    </div>

</div>	
</div>


<div class="col l4 s12">
	@php
    if(!empty($recheck['hotel']['category']))
    {
      $dull = 5 - $recheck['hotel']['category'];
    }
  @endphp
		<div class="card large">
      <div class="card-image">
        
        <img src="{{  data_get($recheck, 'hotel.images.url') }}" style="height:300px" >
      </div>
      {{-- <div class="card-stacked"> --}}
        <div class="card-content p2">
        	
        	 <h6 class="mdb-text">{{  data_get($recheck, 'hotel.name')}}</h6>
        	 <p>
        	  @if(!empty($recheck['hotel']['category']))
        <span>
          @for($i=1; $i <= $recheck['hotel']['category']; $i++)
            <i class="fas fa-star orange-text"></i>
          @endfor

          @if( is_numeric( $recheck['hotel']['category'] ) && floor( $recheck['hotel']['category'] ) != $recheck['hotel']['category'])
            <i class="fas fa-star-half-alt orange-text"></i>
             @php
              $dull--;
             @endphp
          @endif


          @if($dull > 0)
            @for($j=0; $j<$dull; $j++)
              <i class="fas fa-star "></i>
            @endfor
          @endif
          

        </span>
              @endif
              <span class="red-text right-align"> &#8377; {{ data_get($recheck, 'hotel.rate.price') }} </span></p>
           <p><i class="fas fa-map-marker red-text lh35"></i>&nbsp; {{ Illuminate\Support\Str::limit(data_get($recheck, 'hotel.address'), 45, '...') }}</p>

			<h6>Check In:<span class="red-text"> {{ \Carbon\Carbon::parse($req_info['checkin'])->format('d M ,Y') }} </span></h6> <h6>Check Out:<span class="red-text"> {{  \Carbon\Carbon::parse($req_info['checkout'])->format('d M ,Y')}}</span></h6>
			
        </div>
        
      {{-- </div> --}}
    </div>
		</div>
			
	</div>
	

</div>	
@endsection