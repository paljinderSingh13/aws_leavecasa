<div class="container">
<div class="row">	
	<div class="col l12">

		@php
			// dump($results);
		@endphp
		@if(!empty($results['no_of_hotels']))
			<h5 class="fw100 fs14"> no of results {{ $results['no_of_hotels'] }}</h5>
		@endif

		@foreach( $results['hotels'] as $h_key => $h_val )
			@php
				$dull = 5 - $h_val['category'];
			@endphp

			@if($loop->iteration%4==0)
				<div class="row">
				
			@endif

		<div class="col s12 l3 m3">
			<div class="card"> 
				<div class="card-image waves-effect waves-block waves-light">
					<img class="h150" class="activator" src="{{ $h_val['images']['url'] }}">
				</div>
				<div class="card-content  h200">
					<span class="card-title activator grey-text text-darken-4 fs-l16">{{ $h_val['name'] }} <i class="material-icons right">more_vert</i></span>
					<p>
						@for($i=1; $i <= $h_val['category']; $i++)
							<i class="fa fa-star orange-text"></i>
						@endfor

						@if( is_numeric( $h_val['category'] ) && floor( $h_val['category'] ) != $h_val['category'])
							<i class="fa fa-star-half-alt orange-text"></i>
							 @php
							 	$dull--;
							 @endphp
						@endif


						@if($dull > 0)
							@for($j=0; $j<$dull; $j++)
								<i class="fa fa-star "></i>
							@endfor
						@endif
						<span class="right blue-text "> <i class="fas fa-rupee-sign"></i>

							@php

							// dump($h_val['rates']);

							@endphp
						{{ $h_val['rates'][0]['price'] }}</span>

					</p>
					<p class="h65">
						<span class="fs12 blue-text text-darken-4 ">
							<i class="fa fa-map-marker"></i>
						{{ $h_val['address']  }}
							</span>
					</p>
			</div>
			<div class="card-reveal">
				<span class="card-title grey-text text-darken-4">{{ $h_val['name'] }}<i class="material-icons right">close</i></span>
				<p class="fs13 blue-text fw100 text-darken-4"> {{ $h_val['facilities'] }}</p>
			</div>

			<div class="card-action">
	          <a href="{{ route('hotel.detail',['code'=>$h_val['hotel_code']]) }}">More Info</a>
	          {{-- <a href="#">This is a link</a> --}}
	        </div></div>
		</div>

		@if($loop->iteration%4==0)
				</div>
				
			@endif
			{{-- <div class="col l3"> 
				<img class="col l12" src="{{ $h_val['images']['url'] }}">
				<p> {{ $h_val['name'] }} </p>
			</div>
 --}}
		@endforeach

</div>

</div></div>