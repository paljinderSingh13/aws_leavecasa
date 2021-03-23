@extends('frontend.layout.materialize')
@section('content')
  	@php
  	$end = $first = 1;
	//dd($hotel_req );
  	//dump($hotel_req);
	$children = array_column($hotel_req['rooms'], 'children_ages');
  		$other = $hotel;
  		$hotel = $hotel['hotel'];
  		//dump($hotel);
  		if(!empty($hotel['category'])){
			$dull = 5 - $hotel['category'];
		}
	@endphp
	
<div class="row mdb" >	
	 		<div class="col  offset-l1 l7 s12 ">
	 			<p class="f28w100  white-text mt0 mb0">{{ $hotel['name'] }}  </p>
	 			<p class="mt0 ">
					<span class="fs15 white-text text-darken-4">
						<i class="fas fa-map-marker"></i>
					{{ $hotel['address']  }}
						</span>
				</p>
	 		</div>
	 		@if(!empty($hotel['category']))
	 		<div class="col l4">
	 			<p>
					@for($i=1; $i <= $hotel['category']; $i++)
						<i class="fas fa-star orange-text"></i>
					@endfor

					@if( is_numeric( $hotel['category'] ) && floor( $hotel['category'] ) != $hotel['category'])
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
					

				</p></div>
			@endif
				
			</div>
		{{-- </div> --}}	
<div class="row" >
	<div class="container mt0">
	 			
	 			<div class="row card">
	 			<nav class="white box-shadow-none nav-extended" role="navigation">
					<div class="nav-content container">
					<ul class="taps tabs-default">
					<li class="tap"><a class="li-text-red active" href="#description-tab">Description</a></li>
					<li class="tap"><a class="li-text-red" href="#facility-tab">Facilities</a></li>
					<li class="tap"><a class="li-text-red" href="#room-tab">Rooms</a></li>
					</ul>
					</div>
				</nav>
	 			<div class="col l7 s12 carousel carousel-slider">
	 				@foreach($hotel_imgs['regular'] as $im_key => $im_val)


	 			{{-- @if($loop->index > 4)
	 				@break
	 			@endif --}}
	 			<div class="carousel-item">
	 			<img src="{{ $im_val['url'] }}" height="500px" >
	 			</div>
	 			@endforeach
	 			</div>
	 			<!--map-->
	 			
	 		    </div>
	 				
	 		    {{-- <h4 class="mt0 collection-item">Hotel Description</h4> --}}
	 		    <div class="row card scrollspy z-depth-4 border-radius-8" id="description-tab">
	 		    <div class="card-content mb-0">
	 		    <h4 class="mt0 black-text">{{ $hotel['name'] }}
	 		    @if(!empty($hotel['category']))
	 			<span class="fs15">
					@for($i=1; $i <= $hotel['category']; $i++)
						<i class="fas fa-star orange-text"></i>
					@endfor

					@if( is_numeric( $hotel['category'] ) && floor( $hotel['category'] ) != $hotel['category'])
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
		</h4>
	 		    <h6 class="mt0"><i class="fas fa-map-marker red-text"></i> {{ $hotel['address'] }}</h6></div>
	 		    	<div class="col l12 s12 ">
	 			<p class="fs17 fw150 brown-text text-darken-2">{{ $hotel['description'] }} </p> 
	 		   </div>
	 			</div>
	 				<h4 class="mt0 collection-item">Location</h4>
	 			<div class="row card scrollspy z-depth-4 border-radius-8" id="description-tab">
	 		    	<div class="col l12 s12 map">
	 			<iframe src="https://maps.google.com/maps?q={{ $hotel['geolocation']['latitude'] }},{{ $hotel['geolocation']['longitude'] }}&hl=en&z=14&amp;output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
	 		   </div>
	 			</div>
	 		     <h4 class="mt0 collection-item">Available Rooms</h4>			
	 			<div class="row card scrollspy z-depth-4 border-radius-8" id="room-tab">
	 			<div class="col l12 s12 ">
	 				<ul class="collection">
	 				<li class="collection-item center">Price's</li>
	 			@foreach($hotel['rates'] as $r_key => $r_val )
	 			
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

	 			<h4> Seprate Rooms price Adult 

	 			{{$r_val['rooms'][0]['no_of_adults']}}  Children {{$r_val['rooms'][0]['no_of_children']}}

	 		</h4>
@php		
	// dump($r_val);
	 				
	 			@endphp


	 			@endif
	 				
			      <li class="collection-item">
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

<label>
			    @if($r_val['no_of_rooms'] != count($hotel_req['rooms']))

			    	{{$loop->index}}

			    	 <input type="checkbox" name="rate_index[]" value="{{$loop->index}}"> 
			    @endif

			      <span class="black-text">	

			      	{{ $r_val['rooms'][0]['room_type'] }}  
			      	
			      	@if(!empty($r_val['rate_comments']['pax_comments']))
			      	    {{$r_val['rate_comments']['pax_comments'] }}
			      	@endif
			      	

			      	@if(!empty($r_val['supports_cancellation']))
			      		<p> Supports Cancellation: Yes </p>
			      	@endif


			      	@if(!empty($r_val['cancellation_policy']))
			            @if(!empty($r_val['cancellation_policy']['under_cancellation']))
			                <p>Under Cancellation:  Yes</p>
			                @else
			                <p>Cancellation Policy</p>
			            @endif
                        
                        @if(!empty($r_val['cancellation_policy']['no_show_fee']))
			                <p> {{$r_val['cancellation_policy']['no_show_fee']['amount_type']}}:
			                
			             @if(!empty($r_val['cancellation_policy']['no_show_fee']['flat_fee']))
			                
			               Flat Fee {{$r_val['cancellation_policy']['no_show_fee']['flat_fee']}} 
			                
			                @endif
			                
			                 @if(!empty($r_val['cancellation_policy']['no_show_fee']['currency']))
			                
			                {{$r_val['cancellation_policy']['no_show_fee']['currency']}} 
			                
			                @endif
			                
			            @if(!empty($r_val['cancellation_policy']["details"]))
			                <h3> Cancellation detail</h3>
		                 	<p> From       {{$r_val['cancellation_policy']["details"][0]["from"] }} </p>
		                 	<p> Flat Fee       {{$r_val['cancellation_policy']["details"][0]["flat_fee"] }} </p>
		                 	<p> Currency       {{$r_val['cancellation_policy']["details"][0]["currency"] }} </p>
		                @endif
			                
			                
			                @if(!empty($r_val['cancellation_policy']['cancel_by_date']))
			                
			               Last date for cancelation  {{$r_val['cancellation_policy']['cancel_by_date']}} 
			                
			                @endif

			                
			                
			                
			                
			                
			                @if(!empty($r_val['cancellation_policy']['no_show_fee']['percent']))
			                
			                {{$r_val['cancellation_policy']['no_show_fee']['percent']}} 
			                
			                @endif
			                
			                
			                </p>
			                
			            @endif  	
			      	    {{$r_val['rate_comments']['pax_comments'] }}
			      	@endif
			      	
			      	

			    </span>
			</label>
			      	@if(!empty($r_val['boarding_details']))
			      		<span class="orange-text">{{ implode(', ', $r_val['boarding_details']) }}</span>
			      	@endif
			    <span class="right">



			    	 <i class="fas fa-rupee-sign"></i>  {{$r_val['price']  }}
			    	 <!-- <input type="submit" value="Book"> -->
			    	&nbsp; 
			    @if($r_val['no_of_rooms'] != count($hotel_req['rooms'])  )
			    @else
			    	<button type="submit" class="btn li-red">Book</button>
			    @endif
			    </span>
			      </li>
			      {{-- <li class="collection-item">Alvin</li>
			      <li class="collection-item">Alvin</li>
			      <li class="collection-item">Alvin</li> --}}
			 

			 @if($r_val['no_of_rooms'] != count($hotel_req['rooms'])  )

	 				@if($loop->last)
	 					 
						<button type="submit" class="btn li-red">Book</button>
	 					 </form>
	 					
	 				@endif
	 			@else
	 				</form>
	 			@endif
			    @endforeach

			    </ul>
	 			</div>
	 			
	 		

	 			</div>


	 		</div>
	 				@php
	 			
	 			dump($hotel);
	 			
	 			@endphp


	 	</div>
	<!-- </div>
</div> -->

@endsection