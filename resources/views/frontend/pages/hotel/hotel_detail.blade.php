@extends('frontend.layout.materialize')
@section('content')

	<style type="text/css">
		.h-90{
			height:90px;
		}

		.changeimg{
			cursor: pointer;
		}

	</style>

@php 
use App\Helpers\Hotel;
$mark_price = 0;

dump(@$hotel_imgs, @$hotel);
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

<div class="home1 h-50" style="">
  <div class="home_slider_container1">
    <div class="owl-carousel owl-theme home_slider1">
      <div class="owl-item home_slider_item1">
        <div class="home_slider_background1" style="background-image:url(/../images/bg.jpg)"></div>
        <div class="home_slider_content1 text-center">
          <div class="home_slider_content_inner1" data-animation-in="flipInX" data-animation-out="animate-out fadeOut">
          </div>
        </div>
      </div>
    </div>
  </div>   
</div>
<section class="section" id="content">
	<div class="container">


		@if(!empty($hotel_imgs))
		<div class="row">
			
				<img class="col-8 main-img" src="{{$hotel['hotel']['images']['url']}}">
			
			<div class="col-4">

				<div class="row">
					@foreach($hotel_imgs['regular'] as $img_key =>$img_val)
						
						<img class="col-4 img-responsive img-thumbnail h-90 changeimg" src="{{ $img_val['url'] }}" >
						
					@endforeach
					
				</div>
				
			</div>
			
		</div>






		@endif
			@php
			$end = $first = 1;
			$children = array_column($hotel_req['rooms'], 'children_ages');
			$other = $hotel;
			$hotel = $hotel['hotel'];
			if(!empty($hotel['category'])){
			$dull = 5 - $hotel['category'];
			}
			@endphp	
			@php
			$adult=0;
			$child=0;
			foreach($hotel_req['rooms'] as $room_no => $room_val){
			if(!empty($room_val['adults'])){
			$adult+= $room_val['adults'];
			}
			if(!empty($room_val['children_ages'])){
			$child+= count($room_val['children_ages']);
			}
			}
			@endphp


			<div class="row card scrollspy z-depth-4 border-radius-8" id="description-tab">
	 <div class="card-content mb-0">
	 		    <h4 class="mt0 black-text">{{ $hotel['name'] }}
	 		    @if(!empty($hotel['category']))
	 			<span class="fs15">
      @php
        $rating = floor($hotel['category']);
        $decimalstart = $hotel['category'] - $rating;
      $pointrating = $decimalstart * 10;
      $rating2 = ceil($hotel['category']);
      $unfieldstar = 5-$rating2;
      @endphp
      @for($i=0;$i<$rating;$i++)
      <img src="{{ url('/images/star/star.png') }}"  width="16" height="16">
      @endfor 
      @if(strpos($decimalstart,'.') !== false)
      <img src="{{ url('/images/star/star'.$pointrating.'.png') }}" width="16" height="16">
      @endif
      @for($j=0;$j<$unfieldstar;$j++)
      <img src="{{ url('/images/star/unfield-star.png') }}" width="16" height="16">
      @endfor
				</span>
			@endif
		</h4>
	 		    <h6 class="mt0"><i class="fas fa-map-marker red-text"></i> {{ $hotel['address'] }}</h6>


	 		    
	 		    <h6><i class="fas fa-home green-text"></i>{{ count($hotel_req['rooms']) }} Rooms  , <i class="fas fa-user-tie mdb-text"></i> {{ $adult }}  Adults ,<i class="fas fa-child mdb-text"></i> {{ $child }} Child
	</h6>
	 		</div>










		<div class="row mt-5 mb-1 justify-content-md-left">
			<div class="col"><br>
				
	 			<p class="mt0 ">
					<span class="fs15 white-text text-darken-4">
						<i class="far fa-clock orange-text"></i> Check In :
					{{ \Carbon\Carbon::parse($hotel_req['checkin'])->format('d M ,Y') }}
						</span>
					<span class="fs15 white-text text-darken-4">
						&nbsp;<i class="far fa-clock orange-text"></i> Check Out :
					{{ \Carbon\Carbon::parse($hotel_req['checkout'])->format('d M ,Y') }}
						</span>	
						
				</p>
			</div>
		</div>

{{-- map --}}


		<div class="row card scrollspy z-depth-4 border-radius-8" id="description-tab">
	 		    	<div class="col-12 map">
	 			<iframe src="https://maps.google.com/maps?q={{ $hotel['geolocation']['latitude'] }},{{ $hotel['geolocation']['longitude'] }}&hl=en&z=14&amp;output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
	 		   </div>
	 			</div>



	 			<div class="col-12 l12 s12 ">

	 				<!-- Button trigger modal -->

	 				<ul class="collection">
	 				<li class="collection-item row">
	 					<div class="col-5 l5"><h6>Room type</h6></div>
	 					<div class="col-3 l3"><h6>Meal type</h6></div>
	 					<div class="col-2 l2"><h6>Price</h6></div>
	 					<div class="col-2 l2"><h6>Select</h6></div>
	 				</li>
	 			@foreach($hotel['rates'] as $r_key => $r_val )
	 			@php
	 			// dump(json_encode($r_val));
	 			//dump(json_encode($r_val['cancellation_policy']));
	 			@endphp
	 			@if($r_val['no_of_rooms'] != count($hotel_req['rooms'])  )

	 				@if(!empty($first))
	 			 		<form method="post" action="{{ route('hotel.book') }}">
	 			 		{{ csrf_field() }}
	 					@php
	 						$first =0;
	 					@endphp
	 				@endif
	 			@else
	 				<form method="post" action="{{ route('hotel.book') }}">
	 					{{ csrf_field() }}
	 			@endif
	 			{{-- <form method="post" action="{{ route('hotel.recheck') }}"> --}}

	 				

	 			@if($r_val['no_of_rooms'] != count($hotel_req['rooms']))

	 			<h6> Adult 

	 			{{$r_val['rooms'][0]['no_of_adults']}}  Children {{$r_val['rooms'][0]['no_of_children']}}

	 		</h6>
@php		
	// dump($r_val);
	 				
	 			@endphp


	 			@endif
	 				
			      <li class="collection-item row">
			      	<input type="hidden"  value="{{ $other['search_id'] }}" name="search_id">
			      	<input type="hidden"  value="{{ $hotel['hotel_code'] }}" name="hotel_code">
			      	<input type="hidden"  value="{{ $hotel['city_code'] }}" name="city_code">
			      	<input type="hidden"  value="{{ $r_val['group_code'] }}" name="group_code">
			      	<input type="hidden"  value="{{ $r_val['rate_key'] }}" name="rate_key">
			      	@if(!empty($r_val['rooms'][0]['room_reference']))
			      		<input type="hidden"  value="{{ $r_val['rooms'][0]['room_reference'] }}" name="room_reference">

			      	@endif

			      @if(!empty($r_val['room_code']))
			      	<input type="hidden"  value="{{ $r_val['room_code'] }}" name="room_code">
			      @endif

                <label style="font-size: 15px;"><div class="col l5">
			    @if($r_val['no_of_rooms'] != count($hotel_req['rooms']))
			    	{{-- {{$loop->index}} --}}
			    	 <input type="checkbox" name="rate_index[]" value="{{$loop->index}}"> 
			    @endif
			      <span class="black-text lc">
			      	{{ count($r_val['rooms']) }} &#10005; {{ $r_val['rooms'][0]['description'] }} 

			      	@if(!empty($r_val['non_refundable']))
			      		<p>Non Refundable</p>
			      	@endif
			    </span></div>
                  </label>
			      	@if(!empty($r_val['boarding_details']))
			      		<div class="col-3 l3"><span class="orange-text">{{ implode(', ', $r_val['boarding_details']) }}</span></div>
			      		@else
			      		<div class="col-3 l3"><span class="orange-text">Room Only</span></div>
			      	@endif

			      	@php

			      	if(!empty($mark_up["amount_by"]) && $mark_up["amount_by"] == "percent"){
			      		$mark_price = Hotel::cal_markup_percent_val($r_val['price'], $mark_up["amount"]);
			      	}else{
			      		$mark_price=0;
			      	}

			      	
    				$total_price = $r_val['price'] + $mark_price;

			      	@endphp
			    	<div class="col-2 l2"><h5 class="mc0"> &#8377;
			    	{{--  {{ $total_price  }}  = {{  $r_val['price']}} + {{ $mark_price}} --}}
			    	{{ $total_price }}
			    	{{--  --}}
			    	</h5>
			    	{{-- <input type="hidden"  value="{{ $r_val['price'] }}" name="price">	 --}}
			    	{{-- <a href="javascript:modal_detail({{ $loop->index }})" class="modal-trigger"">Rate Comment</a> --}}
			    	</div>
			    	
			    @if($r_val['no_of_rooms'] != count($hotel_req['rooms'])  )
			    <a href="javascript:modal_detail({{ $loop->index }})" >Cancellation Policy</a>
			    @else
			    	<div class="col-2 l2"><button type="submit" class="btn li-red">Book</button>
			    		<a href="javascript:modal_detail({{ $loop->index }})" >Cancellation Policy</a>

			    		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#policy_model_{{ $loop->index }}">
  Launch demo modal 
</button>

<!-- Modal -->
<div class="modal fade" id="policy_model_{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




			    	</div>

			    @endif

			      </li>
			 

			 @if($r_val['no_of_rooms'] != count($hotel_req['rooms'])  )

	 				@if($loop->last)
	 					 
						<button type="submit" class="btn li-red">Book</button>
	 					 </form>
	 					
	 				@endif
	 			@else
	 				</form>
	 			@endif

	 			<div class="modal" id="modal{{ $loop->index }}"  tabindex="-1">
    <div class="modal-content" id="{{ $loop->index }}">
      <h5 class="center-align">{{ $hotel['name'] }}</h5>
        <div class="row">
        	<div>
        <ul class="tabs">
          <li class="tab" style="line-height: 35px; height: 33px;">
            <a id="firstTab" class="active lc" href="#rate{{$loop->index}}">Rate Comment</a>
          </li>
          <li class="tab" style="line-height: 35px; height: 33px;">
            <a href="#cancel{{$loop->index}}" class="lc">Cancellation</a>
          </li>
        
        </ul>
      </div>
      <div id="rate{{$loop->index}}">
      	@if(!empty($r_val['rate_comments']))

      	@foreach($r_val['rate_comments'] as $raKey =>$raVal)
      		{!! str_replace("\r\n",'<br/>', $raVal ) !!}
      	@endforeach
      	@endif
      			      	{{-- @if(!empty($r_val['rate_comments']['pax_comments']))
			      	    {{$r_val['rate_comments']['pax_comments'] }}
			      	@endif --}}
	</div>
	<div id="cancel{{$loop->index}}">		      	
@if(!empty($r_val['cancellation_policy_code']))
@php
	$cp = Hotel::get_policy_by_code($other['search_id'], $r_val['rate_key'], $r_val['cancellation_policy_code'],123);
	//dump($cp);
@endphp
@endif

	<table id="cancel_detail">
		@if(!empty($r_val['non_refundable'])&&($r_val['non_refundable']==true))
		<tr><h6 class=""><span class="orange-text"> &#2547;</span>  This is Non-refundable</h6></tr>
		@else

		{{-- <tr><h6 class=""><span class="orange-text"> &#2547;</span>  Cancellations are only allowed before 					{{ \Carbon\Carbon::parse($hotel_req['checkin'])->format('d M ,Y') }}</h6></tr> --}}
		{{-- <tr><h6 class=""><span class="orange-text"> &#2547;</span>  All time mentioned above is in destination time.</h6></tr> --}}
		{{-- <tr><h6 class=""><span class="orange-text"> &#2547;</span>  Cancellation not allowed.</h6></tr> --}}
		@if(!empty($r_val['cancellation_policy']["details"][0]["from"]))
		<tr> <h6><span class="orange-text"> &#2547;</span> Cancellation charges starts from
			{{ \Carbon\Carbon::parse($r_val['cancellation_policy']["details"][0]["from"])->format('d M ,Y H:i:s') }}  </h6>
		</tr>
		@elseif(!empty($cp['details'][0]['from']))
		<tr> <h6><span class="orange-text"> &#2547;</span> Cancellation charges starts from
			{{ \Carbon\Carbon::parse($cp['details'][0]['from'])->format('d M ,Y H:i:s') }}
		  </h6></tr>		 
		 @endif
		 @if(!empty($r_val['cancellation_policy']['under_cancellation']) && ($r_val['cancellation_policy']["under_cancellation"] == true))
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
			<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges for no show fee will be  {{ $cp['no_show_fee']['currency'] }} {{ $cp['no_show_fee']['flat_fee'] }} </h6></tr>

		@elseif(!empty($r_val['cancellation_policy']['no_show_fee']['flat_fee']) &&(!empty($r_val['cancellation_policy']['no_show_fee']['currency'])))

		   <tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges for no show fee will be  {{$r_val['cancellation_policy']['no_show_fee']['currency']}}  {{ $r_val['cancellation_policy']['no_show_fee']['flat_fee']}} .</h6></tr>			                
		 @elseif(!empty($r_val['cancellation_policy']['details'][0]['flat_fee']) &&(!empty($r_val['cancellation_policy']['details'][0]['currency'])))

		   <tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$r_val['cancellation_policy']['details'][0]['currency']}}  {{ $r_val['cancellation_policy']['details'][0]['flat_fee']}} .</h6></tr>

		   @elseif(!empty($cp['details'][0]['flat_fee']) &&(!empty($cp['details'][0]['currency'])))

		   <tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$cp['details'][0]['currency']}}  {{ $cp['details'][0]['flat_fee']}} .</h6></tr>				                  
	   @endif

		@if(!empty($cp['cancel_by_date']))
		<tr> <h6><span class="orange-text"> &#2547;</span> Free cancellation till 			
			{{ \Carbon\Carbon::parse($cp['cancel_by_date'])->format('d M ,Y H:i:s') }}
			</h6></tr>	

		@elseif(!empty($r_val['cancellation_policy']['cancel_by_date']))
		<tr><h6> <span class="orange-text"> &#2547;</span> Free cancellation till 						              
			{{ \Carbon\Carbon::parse($r_val['cancellation_policy']['cancel_by_date'])->format('d M ,Y H:i:s') }}
		</h6></tr>		 
		 @endif
	
	   @if(!empty($r_val['cancellation_policy']['no_show_fee']['percent']))
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges for no show fee will be  {{$r_val['cancellation_policy']['no_show_fee']['percent']}} %</h6></tr>			                
		@elseif(!empty($cp['no_show_fee']['percent']))
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges for no show fee will be  {{$cp['no_show_fee']['percent']}} %</h6></tr>	
		@elseif(!empty($r_val['cancellation_policy']['details'][0]['percent']))
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$r_val['cancellation_policy']['details'][0]['percent']}} %</h6></tr>
		@elseif(!empty($cp['details'][0]['percent']))
		<tr><h6><span class="orange-text"> &#2547;</span> Cancellation charges will be  {{$cp['details'][0]['percent']}} %</h6></tr>				                
		@endif
		@endif
     </table>
			      	
    </div></div>
    
  </div></div>
			    @endforeach

			    </ul>
	 			</div>
	 			
	 		

	 			</div>
	</div>
</section>
@endif
<script type="text/javascript">
	
	$(document).on('click','.changeimg',function(e){


		var url = $(this).attr('src');

		$(".main-img").attr('src',url);
		console.log(url);

	});
</script>
@endsection	