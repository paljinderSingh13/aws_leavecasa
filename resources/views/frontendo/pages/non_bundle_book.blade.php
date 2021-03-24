@extends('frontend.layout.materialize')
@section('content')

@php
	$req_info = session::get('hotel_req');
	$price =0;
// dump($req_info);
//dump(json_encode($new_rates));
@endphp
<div class="row mdb">
	<div class="col offset-l1  pushpin-demo-nav">
		<h4 class="white-text"> Booking Details</h4>
	</div>
</div>

<div class="container"> 
	<div class="row">
		<div class="card col l8">
	<form method="post" action="{{ route('hotel.nonbunde.book') }}"  class="card-content">
		{{ csrf_field() }}

		<input type="hidden"  name="search_id" value="{{ $req['search_id'] }}">
<input type="hidden"  name="hotel_code" value="{{$req['hotel_code'] }}">
<input type="hidden"  name="city_code" value="{{ $req['city_code'] }}">
{{-- <input type="hidden"  name="group_code" value="{{$req['group_code'] }}"> --}}
<input type="hidden"  name="checkin" value="{{ $req_info['checkin']}}">
<input type="hidden"  name="checkout" value="{{ $req_info['checkout'] }}">
<input type="hidden"  name="booking_name" value="Acme{{ rand(000000,999999) }}">
<input type="hidden"  name="payment_type" value="AT_WEB">


		<div class="row p1 card-content">
		 	<p class="f22w200 mdb-text pt2 pl1"> <span class="valign center">Holder Info</span></p>
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
			   <input type="hidden" name="holder[client_nationality]" value="IN" >

		</div>

		@foreach($new_rates as $r_key => $r_val)

		@php
		//dump($loop);
			$index[] =	$loop->iteration;
		$price = $r_val['hotel']['rate']['price'] + $price;
		if(!empty($r_val['hotel']))
		{
			$put=$r_val['hotel']['rate'];
			//dump(1, $put);
		}
		else
		{
			$put=$r_val;
			//dump(2, $put);
		}




		//dd($new_rates);
		//dd($r_val['hotel']);
		@endphp
			<input type="hidden"  name="group_code" value="{{$put['group_code'] }}">
		@php
			//dd($new_rates);
		@endphp













		<div class="modal" id="modal{{ $loop->iteration }}"  tabindex="-1">
 <div class="modal-content">
      <h5 class="center-align">Cancellation Policy</h5>
@if(!empty($r_val['hotel']['rate']))
@php	
	$rate = $r_val['hotel']['rate'];
@endphp
@endif
@if(!empty($rate['cancellation_policy_code']))
@php
	$cp = Hotel::get_policy_by_code($r_val['search_id'], $rate['rate_key'], $rate['cancellation_policy_code']);

				//dump($cp);
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





			 @if(!empty($put['rate_key']))
					<input type="hidden"  name="booking_items[{{$loop->index}}][rate_key]" value="{{ $put['rate_key'] }}">
				@endif

				 @if(!empty($put['room_code']))
					<input type="hidden"  name="booking_items[{{$loop->index}}][room_code]" value="{{ $put['room_code'] }}">
				@endif
			<p class="f22w200 mdb-text pt2 pl1">Room {{ $loop->iteration }}</p>

@if(!empty($put['rooms'][0]['room_reference']))
<input type="hidden" name="booking_items[{{$loop->index}}][rooms][0][room_reference]" value="{{ $put['rooms'][0]['room_reference'] }}" >
@endif
@for($i=0; $i< $put['rooms'][0]['no_of_adults']; $i++  ) 

			@php
				$last_i = $i; 
			@endphp
			{{-- <p class="f22w200 mdb-text pt2 pl1"><span class="valign center">Adult Info </span> </p> --}}

			<input type="hidden" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $i }}][type]" value="AD" >
			<div class="row p1">
				<div class="col s12  l4">
		 			Title<select name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $i }}][title]">
		 				<option value="Mr."> Mr</option>
		 				<option value="Ms."> Ms</option>
		 				<option value="Mrs."> Mrs</option>
		 				<option value="Mstr."> Mstr</option>
		 			</select></div>
			  {{-- title<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]" > --}}
			   <div class="col s12  l4">name <input type="text" placeholder="Adult" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $i }}][name]" required></div>
			   <div class="col s12  l4">surname<input type="text" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $i }}][surname]" required></div>
			</div>
			@endfor

			@for($i=0; $i< $put['rooms'][0]['no_of_children']; $i++  ) 

			@php
				$j = $last_i + ($i +1); 
			@endphp

			<input type="hidden" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $j }}][type]" value="CH" >


{{-- 			<p class="f22w200 mdb-text pt2 pl1"><span class="valign center">child Info </span> </p> --}}
			<div class="row">
			<div class="col s12  l4">
		 			Title<select name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $j }}][title]">
		 				<option value="Mr."> Mr</option>
		 				<option value="Ms."> Ms</option>
		 				<option value="Mrs."> Mrs</option>
		 				<option value="Mstr."> Mstr</option>
		 			</select></div>
			  {{-- title<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]" > --}}
			   <div class="col s12  l4">name <input type="text"  placeholder="child" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $j }}][name]" required></div>
			   <div class="col s12  l4">surname<input type="text" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $j }}][surname]" required></div></div>
			   @if(!empty($r_val['hotel']))
			   <input type="hidden" value="{{ $put['rooms'][0]['children_ages'][$i] }}" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $j }}][age]" >
			   @else
			   <input type="hidden" value="{{ $req_info['rooms'][0]['children_ages'][$i] }}" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $j }}][age]" >
			   @endif
			   {{-- <div class="col s12  l4">Age<input type="text" name="booking_items[{{$loop->index}}][rooms][0][paxes][{{ $j }}][age]" ></div> --}}

			@endfor
		@endforeach

		{{-- <input type="submit" name="" value="submit"> --}}
		<button type="submit" class="btn red" name="">Continue</button>
</form>
	</div>
	<div class="col l4 s12">
	@php
    if(!empty($preserve['category']))
    {
      $dull = 5 - $preserve['category'];
    }
  @endphp
		<div class="card large">
      <div class="card-image">
        
        <img src="{{  data_get($preserve, 'images.url') }}" style="height:300px" >
      </div>
      {{-- <div class="card-stacked"> --}}
        <div class="card-content p2">
        	
        	 <h5 class="mdb-text">{{  data_get($preserve, 'name')}}</h5>
        	 <p>
        	  @if(!empty($preserve['category']))
        <span>
          @for($i=1; $i <= $preserve['category']; $i++)
            <i class="fas fa-star orange-text"></i>
          @endfor

          @if( is_numeric( $preserve['category'] ) && floor( $preserve['category'] ) != $preserve['category'])
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
              <span class="red-text right-align"> &#8377; {{ $price }} </span><br>

              @foreach($index as $ikey => $ival )
              	Room {{ $ival }} : <a href="javascript:modal_detail({{ $ival }})" class="modal-trigger">Cancellation Policy</a><br>
              @endforeach
          </p>
           <p><i class="fas fa-map-marker red-text lh35"></i>&nbsp; {{ Illuminate\Support\Str::limit(data_get($preserve, 'address'), 45, '...') }}</p>

			<h6>Check In:<span class="red-text"> {{ \Carbon\Carbon::parse($req_info['checkin'])->format('d M ,Y') }} </span></h6> <h6>Check Out:<span class="red-text"> {{  \Carbon\Carbon::parse($req_info['checkout'])->format('d M ,Y')}}</span></h6>
			
        </div>
        
      {{-- </div> --}}
    </div>
		</div>

</div>

@endsection