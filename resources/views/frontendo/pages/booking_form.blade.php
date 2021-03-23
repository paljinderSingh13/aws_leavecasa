@extends('frontend.layout.materialize')
@section('content')
@php
use App\Helpers\Hotel;

$req_info = session::get('hotel_req');
//dump($req_info);
@endphp
@if(!empty($error[0]['messages'][0])){{-- 
	<h4 class="red-text">{{ $error[0]['messages'][0]}}</h4> --}}
	<div class="col s12  l10 center-align white">
      <img src="{{ url('images/error-2.png') }}" class="bg-image-404" alt="">
      <h4 class="error-code m-0">Sorry ! {{ $error[0]['messages'][0]}}</h4>
      <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back
        TO Home</a>
    </div>

@else
@php
$room_ref = $recheck['hotel']['rate']['rooms'];	

$mark_price = 0;

    	 $mark_up = Hotel::city_rating_mark($recheck['hotel']["city_code"], $recheck['hotel']["category"]);
	     if($mark_up["amount_by"] == "rupee"){
      		$mark_price  = $mark_up["amount"];
      	}elseif($mark_up["amount_by"] == "percent"){
      		$price = data_get($recheck, 'hotel.rate.price');
      		$mark_price = Hotel::cal_markup_percent_val($price, $mark_up["amount"]); 
      	}
		$price = data_get($recheck, 'hotel.rate.price') + $mark_price;

//dump( $recheck['hotel']['rate']);

//dump($req_info);
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

<div class="row mdb">
	<div class="col offset-l1 pushpin-demo-nav">
		<h4 class="white-text"> Booking Details</h4>
	</div>
	
</div>	

<div class="container">


<div class="row">

@if(!Auth::guard('customer')->check())

    @if($errors->any())
        <div class="col l8 m9 s12"> 
          <h4 class="red-text">{{$errors->first()}}</h4>
        </div>
    @endif
  <script type="text/javascript">
    
    function openSignup(){
        regist = document.getElementById('reg');
        login = document.getElementById('login-form');
        login.style.display  = "none";
        regist.style.display = "block";
    }

     function openLogin(){
        regist = document.getElementById('reg');
        login = document.getElementById('login-form');
        login.style.display  = "block";
        regist.style.display = "none";
    }
</script>

<div class="col s6 card offset-s3 lform"> 
  <div id="login-form">
      <h4 class="center"> Login</h4>
    <form method="post" action="{{ route('login.customer') }}">
            {{csrf_field()}}
        <input type="hidden" name="redirect" value="{{ route('flight.details') }}">
        <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="fEmail" type="text" autocomplete="off" name="email" required>
          <label for="fEmail" class="center-align">Email</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="fpassword" type="password" name="password" autocomplete="off" required>
          <label for="fpassword" class="">Password</label>
        </div>
      </div>
        <div class="row">
        <div class="input-field col  s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col offset-s2 s8" >Login</button>
        </div>
      </div>
           
    </form>
    <div class="row">
        <div class="input-field col s6 m6 l6">
          <p class="margin medium-small"> <a onclick="openSignup()">Register Now!</a></p>
        </div>
      </div>
  {{--   <a onclick="openSignup()" id="signup"> Sign up</a> --}}
</div>

<div id="reg" style="display: none">
    <h4 class="center"> Sign Up</h4>
    <form method="post" action="{{ route('cust.reg') }}">
        {{ csrf_field() }}
  <div class="row">
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">person_outline</i>
          <input class="black-text" id="name"  name="name" type="text"  >
          <label for="name">Name</label>
        </div>
      </div>

    <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input class="black-text" name="email"  type="text" id="emal" >
          <label class="black-text" for="emal">email</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input class="black-text" name="password"  type="password" class="validate" id="pswd">
          <label class="black-text" for="pswd">Password</label>
        </div>
      </div>


       <div class="row">
        <div class="input-field col s12">
           <i class="material-icons prefix pt-2">lock_outline</i>
          <input class="black-text" id="phone"  name="mobile" type="text" class="validate">
          <label class="black-text" for="phone"> Phone</label>
        </div>
      </div>
    <div class="row">
        <div class="input-field col  s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col offset-s2 s8" >Sign Up</button>
        </div>
      </div>
     <div class="row">
          <p class="margin medium-small"><a onclick="openLogin()">Already have an account? Login</a></p>        
      </div>
       {{--  <a onclick="openLogin()" id=""> login</a> --}}
    </div>
  </div>
</form>

{{--  <input type="text" name="email">
<input type="password" name="password"> --}}
</div>
</div>
 </div>  

 @endif




















	<!-- @if(!Auth::guard('customer')->check())
	<div class="row">
		<h4 class="center">
		<a class="red-text sel_tab" href="javascript:login()" >LOGIN</a> /
        <a class="red-text sel_tab" href="javascript:signup()" >SIGNUP</a> 
	   </h4>
	</div>
	@endif -->


{{-- <h4>Traveller Information</h4>		 --}}
@if(Auth::guard('customer')->check())
<div class="row">
<div class="card col l8 z-depth-4 border-radius-8">
	
	<form method="post" action="{{ route('hotel.final.book') }}" class="card-content">
	{{ csrf_field() }}
	 <div class="row p1">
	 	<p class="f22w200 mdb-text pt2 pl1 #ffcdd2 red lighten-4"> <span class="valign center">Contact Detail</span></p>
	 	
	 	<input type="hidden" name="price" value="{{ $price }}">

	 	<div class="col s12  l4">
	 			Title<select name="holder[title]">
	 				<option value="Mr."> Mr</option>
	 				<option value="Ms."> Ms</option>
	 				<option value="Mrs."> Mrs</option>
	 				<option value="Mstr."> Mstr</option>
	 			</select></div>
		  {{-- title<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]" > --}}
		   <div class="col s12  l4">Name <input type="text" name="holder[name]" required></div>
		   <div class="col s12  l4">Surname<input type="text" name="holder[surname]" required></div>
		   <div class="col s12  l4">Email<input type="email" name="holder[email]" required></div>
		   <div class="col s12  l4">Phone Number<input type="text" name="holder[phone_number]" pattern="[1-9]{1}[0-9]{9}" maxLength="10" required></div>
		   
		</div>

		
		
			
             

		<h5>Guest Info</h5>



@if(!empty($room_ref[0]['max_room_occupancy']))

@foreach($req_info['rooms'] as $room_no => $room_val)

<p class="f22w200 mdb-text pt2 pl1 #ffcdd2 red lighten-4">Room {{ $loop->iteration }}, <span class="valign center">Adult Info</span></p>
	@if(!empty($room_val['adults']))
			<!-- <h4 class="p1"> adult Info</h4> -->

			 @if(!empty($room_ref[0]['room_reference']))
			<input type="hidden"  name="room[rooms][{{$loop->index}}][room_reference]" value="{{ $room_ref[0]['room_reference'] }}">
		@endif
		 
		 @for($i=0; $i < $room_val['adults']; $i++ )
		 <div class="row p1"> 
		 	<div class="col s12  l4">
		 			Title<select name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]">
		 				<option value="Mr."> Mr</option>
		 				<option value="Ms."> Ms</option>
		 				<option value="Mrs."> Mrs</option>
		 				<option value="Mstr."> Mstr</option>

		 				
		 			</select></div>
			  {{-- title<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]" > --}}
			   <div class="col s12  l4">Name <input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][name]" required></div>
			   <div class="col s12  l4">Surname<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][surname]" required></div>
			  <input type="hidden" value="AD" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][type]" >
			</div>
		 @endfor
	@endif


	@if(!empty($room_val['children_ages']))

		 
		 <p class="f22w200 mdb-text pt2 #ffcdd2 red lighten-4"> <span class="valign center">Child Info</span></p>
			<input type="hidden" name="room[rooms][{{$loop->index}}][no_of_infants]" value="{{ count($room_val['children_ages'])}}">

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
			  	<input type="hidden" value="{{ $room_val['children_ages'][$c] }}"  name="room[rooms][{{$loop->index}}][paxes][{{ $j }}][age]" >

			  	{{-- value="{{ $room_val['children_ages'][$c] }}" --}}
			  </div>

		 	@endfor

		 @endif

	@endforeach
@else

		
   @foreach($room_ref as $room_no => $room_val)
   {{-- @foreach($room_ref as $refkey => $refVal) @if($refVal['no_of_adults'] == $room_val ) --}}


	<p class="f22w200 mdb-text pt2 pl1 #ffcdd2 red lighten-4">Room {{ $loop->iteration }}, <span class="valign center">Adult Info</span></p>
	@if(!empty($room_val['no_of_adults']))
			<!-- <h4 class="p1"> adult Info</h4> -->
		 @if(!empty($room_val['room_reference']))
			<input type="hidden"  name="room[rooms][{{$loop->index}}][room_reference]" value="{{ $room_val['room_reference'] }}">
		@endif

		 @for($i=0; $i < $room_val['no_of_adults']; $i++ )
		 <div class="row p1"> 
		 	<div class="col s12  l4">
		 			Title<select name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]">
		 				<option value="Mr."> Mr</option>
		 				<option value="Ms."> Ms</option>
		 				<option value="Mrs."> Mrs</option>
		 				<option value="Mstr."> Mstr</option>

		 				
		 			</select></div>
			  {{-- title<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][title]" > --}}
			   <div class="col s12  l4">Name <input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][name]" required></div>
			   <div class="col s12  l4">Surname<input type="text" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][surname]" required></div>
			  <input type="hidden" value="AD" name="room[rooms][{{$loop->index}}][paxes][{{ $i }}][type]" >
			</div>
		 @endfor
	@endif


		 @if(!empty($room_val['no_of_children']))

		 
		 <p class="f22w200 mdb-text pt2 #ffcdd2 red lighten-4"> <span class="valign center">Child Info</span></p>
			<input type="hidden" name="room[rooms][{{$loop->index}}][no_of_infants]" value="{{ $room_val['no_of_children']}}">

		  	@for($c=0; $c < $room_val['no_of_children']; $c++ )
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
			  	<input type="hidden" value="{{ $room_val['children_ages'][$c] }}"  name="room[rooms][{{$loop->index}}][paxes][{{ $j }}][age]" >

			  	{{-- value="{{ $room_val['children_ages'][$c] }}" --}}
			  </div>

		 	@endfor

		 @endif
	
@endforeach

@endif


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


	@if(Auth::guard('customer')->check())
<button type="submit" class="btn li-red" name="">Continue</button>
@endif
</br>
<a href="javascript:modal_detail(0)">Cancellation Policy</a>
</form>
<div class="modal" id="modal0"  tabindex="-1">
    <div class="modal-content" >
      {{-- <h5 class="center-align">{{ $hotel['name'] }}</h5> --}}
        <div class="row">
        	<div>
        <ul class="tabs">
          <li class="tab" style="line-height: 35px; height: 33px;">
            <a id="firstTab" class="active lc" href="#rate">Rate Comment</a>
          </li>
          <li class="tab" style="line-height: 35px; height: 33px;">
            <a href="#cancel" class="lc">Cancellation</a>
          </li>
        
        </ul>
      </div>
      @if(!empty($recheck['hotel']['rate']))
		@php	
			$rate = $recheck['hotel']['rate'];
		@endphp
		@endif

	@if(!empty($rate['rate_comments']))		
      <div id="rate">
      	@foreach($rate['rate_comments'] as $raKey =>$raVal)
      		
      			{!! str_replace("\r\n",'<br/>', $raVal ) !!}
	      	@endforeach
	</div>
	@endif
	<div id="cancel">		      	

@if(!empty($rate['cancellation_policy_code']))
@php
	$cp = Hotel::get_policy_by_code($recheck['search_id'], $rate['rate_key'], $rate['cancellation_policy_code'],123);

	//			dump($cp);
@endphp
@endif

	<table id="cancel_detail">
		@if(!empty($rate['non_refundable'])&&($rate['non_refundable']==true))
		<tr><h6 class=""><span class="orange-text"> &#2547;</span>  This is Non-refundable</h6></tr>
		@else
		@if(!empty($rate['cancellation_policy']["details"][0]["from"]))
		<tr> <h6><span class="orange-text"> &#2547;</span> Cancellation charges starts from
			{{ \Carbon\Carbon::parse($rate['cancellation_policy']["details"][0]["from"])->format('d M ,Y H:i:s') }}</h6>
		</tr>

		@elseif(!empty($cp['details'][0]['from']))
		<tr> <h6><span class="orange-text"> &#2547;</span> Cancellation charges starts from
			{{ \Carbon\Carbon::parse($cp['details'][0]['from'])->format('d M ,Y H:i:s') }}
		</h6></tr>		 
		 @endif



		@if(!empty($rate['cancellation_policy']['under_cancellation']) && ($rate['cancellation_policy']["under_cancellation"] == true))
		<tr> <h6><span class="orange-text"> &#2547;</span> This booking  is under cancellation and you have to pay charges
			  </h6>
		</tr>
		

		@elseif(!empty($cp['under_cancellation']) && ($cp['under_cancellation'] == true))
		<tr> <h6><span class="orange-text"> &#2547;</span> This booking  is under cancellation and you have to pay charges
			  </h6>
		</tr>
		@else
		<tr> <h6><span class="orange-text"> &#2547;</span> This booking  is not under cancellation and you don't have to pay charges from till date.
			  </h6>
		</tr>
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
		@elseif(!empty($cp['details'][0]['percent']))
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$cp['details'][0]['percent']}} %</h6></tr>				                
		@endif	                
		@endif
     </table>
			      	
    </div></div>
    
  </div></div>
</div>


<div class="col l4 s12 sticky1">
	@php
    if(!empty($recheck['hotel']['category']))
    {
    	

    	
      	$dull = 5 - $recheck['hotel']['category'];
    }
  @endphp
		<div class="card large  z-depth-4 border-radius-8">
      <div class="card-image">
        @if(!empty(data_get($recheck, 'hotel.images.url')))
        <img src="{{  data_get($recheck, 'hotel.images.url') }}" style="height:300px" >
        @else
        <img src="{{ asset('images/demo_hotel.jpg') }}" style="height:300px" >
        @endif
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
              {{-- $price =  data_get($recheck, 'hotel.rate.price') +  $mark_price; --}}
              <span class="red-text right-align"> &#8377;{{ $price  }}</span></p>
              <h6><i class="fas fa-home green-text"></i>{{ count($req_info['rooms']) }} Rooms  , <i class="fas fa-user-tie mdb-text"></i> {{ $adult }}  Adults ,<i class="fas fa-child mdb-text"></i> {{ $childs }} Child
				</h6>
           <p><i class="fas fa-map-marker red-text lh35"></i>&nbsp; {{ Illuminate\Support\Str::limit(data_get($recheck, 'hotel.address'), 30, '..') }}</p>

			<h6>Check In:<span class="red-text"> {{ \Carbon\Carbon::parse($req_info['checkin'])->format('d M ,Y') }} </span></h6> <h6>Check Out:<span class="red-text"> {{  \Carbon\Carbon::parse($req_info['checkout'])->format('d M ,Y')}}</span></h6>
			
        </div>
        
      {{-- </div> --}}
    </div>
		</div>

		@endif
			
	</div>
	</div>
@endif

</div>	



@endsection