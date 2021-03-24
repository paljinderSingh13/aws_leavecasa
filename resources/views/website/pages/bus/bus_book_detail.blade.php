@php

 use App\Helpers\BusApi;

@endphp

@extends('frontend.layout.materialize')

@section('content')



<section>

<div class="container">

@if($errorStatus==false)



 @php



      $searchB = session()->get('searchBus'); 

 //dump($detail['detail']['cancellationPolicy']);

     

  @endphp

<div class="row">

<div class="card">

	<h6 class="p1 mdb white-text mt0">Bus Detail</h6>

<div class="card-content p1">	

	

<div class="row">

	<div class="col l1" style="width:4%">

		<img src="{{ asset('/images/busIcon.png') }}" alt="">

	</div>

	<div class="col l11">

		<div class="row red-text">

<div class="col l3">

     <p class="f24w100 red-text mt0 mb0">{{ $detail['detail']['sourceCity'] }} <i class="fas fa-arrow-right prefix black-text"></i> {{ $detail['detail']['destinationCity'] }}</p>

  </div>

<div class="col l2">

	<p>Boarding Time</p>

</div>	

<div class="col l2">

	<p>Arrival Time</p>

</div>	

<div class="col l2">

	<p>Boarding Point</p>

</div>

<div class="col l2">

	<p>Dropping Point</p>

</div>

<div class="col l1">

	<p>PNR</p>

</div>	 

</div>

  <div class="row"> 

  <div class="col l3">

  	<span>{{ $searchB['journey_date'] }}</span>

  </div> 

  <div class="col l2">

	<p>{{  BusApi::cal_time($detail['detail']['pickupTime']) }}</p>

</div>	

<div class="col l2">

	<p>{{  BusApi::cal_time($detail['detail']['dropTime']) }}</p>

</div>	

<div class="col l2">

	<p>{{  $detail['detail']['pickupLocation'] }}</p>

</div>

<div class="col l2">

	<p>{{  $detail['detail']['dropLocation'] }}</p>

</div>

<div class="col l1">

	<p>{{ $detail['detail']['pnr'] }}</p>

</div>		

</div>



</div>

</div>

<div class="row mt1">

	<div class="col l12">

	<span class="red-text">Bus Type : </span>

	<span>{{ $detail['detail']['busType'] }}</span>

</div>

</div>

</div>

</div>

<div class="card">

	<h6 class="p1 mdb white-text mt0">Passenger Detail</h6>

<div class="card-content p1">

<div class="row">

	<div class="col l7">

<table>

	<thead>

		

		<tr>

			<td>Title</td>

			<td>Name</td>

			<td>Age</td>

			<td>Seat</td>

			<td>Fare</td>

		</tr>

	</thead>

	<tbody>

		 @if(!empty($detail['detail']['inventoryItems'][0]))

		@foreach($detail['detail']['inventoryItems'] as $key => $value)

		<tr>

			<td>{{ $value['passenger']['title'] }}</td>

			<td>{{ $value['passenger']['name'] }}</td>

			<td>{{ $value['passenger']['age'] }}</td>

			<td>{{ $value['seatName'] }}</td>

			<td>{{ $value['fare'] }}</td>

		</tr>

		@endforeach

		@else

		<tr>

			<td>{{ $detail['detail']['inventoryItems']['passenger']['title'] }}</td>

			<td>{{ $detail['detail']['inventoryItems']['passenger']['name'] }}</td>

			<td>{{ $detail['detail']['inventoryItems']['passenger']['age'] }}</td>

			<td>{{ $detail['detail']['inventoryItems']['seatName'] }}</td>

			<td>{{ $detail['detail']['inventoryItems']['fare'] }}</td>

		</tr>

		@endif

	</tbody>

</table>

</div>	

<div class="col l4 offset-l1">



</div>

</div>

 </div>	

</div>



<div class="card">

	<h6 class="p1 mdb white-text mt0"> Cancellation Policy</h6>

<div class="card-content p1">

<div class="row">

	<div class="col l12">

<table  id="cancelTable">

	<thead>		

		<tr>

			<th>Cancellation Time </th>

			<th>Charges </th>

		</tr>

	</thead>

	<tbody>

		@if(!empty($detail['detail']['cancellationPolicy']))
		@php

 		$str=$detail['detail']['cancellationPolicy'];

		$keys = explode(";", $str);

		@endphp

		@foreach($keys as $key1 => $value1) 

		@php

			$split = explode(":",$value1);

		@endphp	

		@if(!empty($split[0]))

			<tr><td>Between {{ $split[0] }} to {{ $split[1] }} hr before departure </td>

  		 	<td>{{ $split[2] }}%</td></tr>

  		@endif

  		@endforeach  
  	@endif

        @if($detail['detail']['partialCancellationAllowed'] =='true')    	

        <tr>       	

        	<td>* Partial cancellation is allowed for this ticket.</td>

        </tr>

        @endif

	</tbody>

	 

</table>

</div>	

</div>

 </div>	

</div>



</div>

@else

<div class="row">

  <div class="center-align white">

      <img src="{{ asset('/images/not_found.gif') }}" class="bg-gif-404" alt="">

      <h3 class="error-code m-0">{{ $errorMessage }}</h3>

      <a class="btn li-red Fbutn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back

        TO Home</a>

    </div> 

</div>

@endif

</div>

</section>

@endsection