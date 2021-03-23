@extends('frontend.layout.materialize')
@section('content')
	  
  		@php

  		dump(Session::get('hotel'));
  		$hotel = $hotel['hotels'][0];
  		//
			$dull = 5 - $hotel['category'];
		@endphp
<div class="row" style="background:antiquewhite;">
	<div class="container">
	 	<div class="row">
	 		<div class="col l7 s12 p3">
	 			<h4 class="fw100 orange-text">{{ $hotel['name'] }}  </h4>

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
					

				</p>
				<p>
					<span class="fs12 blue-text text-darken-4">
						<i class="fas fa-map-marker"></i>
					{{ $hotel['address']  }}
						</span>

				</p>
	 		 <h5>Description </h5>
	 			<p class="fs13 fw100 brown-text text-darken-2">{{ $hotel['description'] }} </p>

	 			<div class="row ">
	 			<div class="col l12 carousel carousel-slider">
	 				@foreach($hotel_imgs['regular'] as $im_key => $im_val)
	 			{{-- @if($loop->index > 4)
	 				@break
	 			@endif --}}
	 			<div class="carousel-item">
	 			<img src="{{ $im_val['url'] }}" height="300px" >
	 			</div>
	 			@endforeach
	 			</div>
	 		    </div>

	 			<!-- <p class=" fw100 brown-text text-darken-4 fs11"> --> <h5>Facilities</h5> <!-- </p> -->
	 			<p class="fs13 fw100 brown-text text-darken-2">{{ $hotel['facilities'] }} </p>
	 		</div>
	 			<div class="col l5 s12 mv8 ">
	 				<ul class="collection">
	 				<li class="collection-item center">Price's</li>
	 			@foreach($hotel['rates'] as $r_key => $r_val )

	 			<form method="post" action="{{ route('hotel.book') }}">

	 				{{ csrf_field() }}
			      <li class="collection-item">

			      	<input type="hidden"  value="{{ $hotel['hotel_code'] }}" name="hotel_code">
			      	<input type="hidden"  value="{{ $hotel['city_code'] }}" name="city_code">
			      	<input type="hidden"  value="{{ $r_val['group_code'] }}" name="group_code">
			      	<input type="text"  value="{{ $r_val['rate_key'] }}" name="rate_key">
			      	@if(!empty($r_val['rooms'][0]['room_reference']))
			      		<input type="text"  value="{{ $r_val['rooms'][0]['room_reference'] }}" name="room_reference">

			      	@endif

			      @if(!empty($r_val['room_code']))
			      	<input type="text"  value="{{ $r_val['room_code'] }}" name="room_code">
			      @endif

			      <span >	

			      	{{ $r_val['rooms'][0]['room_type'] }}  

			      	@if(!empty($r_val['boarding_details']))
			      		<span class="orange-text">{{ implode(', ', $r_val['boarding_details']) }}</span>
			      	@endif
			    </span>
			    <span class="right">

			    	 <i class="fas fa-rupee-sign"></i> {{ $r_val['group_code'] }}  {{$r_val['price']  }}
			    	 <input type="submit" name="">
			    </span>
			      </li>
			      {{-- <li class="collection-item">Alvin</li>
			      <li class="collection-item">Alvin</li>
			      <li class="collection-item">Alvin</li> --}}
			 </form>
			    @endforeach

			    </ul>
	 			</div>

	 			
	 		</div>
	 		<!-- <div class="col l5 h600 scroll-y">
	 			@foreach($hotel_imgs['regular'] as $im_key => $im_val)
	 			{{-- @if($loop->index > 4)
	 				@break
	 			@endif --}}
	 			<div class="col l12 mc2 ">
	 			<img src="{{ $im_val['url'] }}">
	 			</div>
	 			@endforeach
	 		</div> -->
	 		


	 		


	 	</div>
	</div>
</div>

@endsection