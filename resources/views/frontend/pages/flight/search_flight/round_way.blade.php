@extends('frontend.layout.materialize')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'v2.9/css/nifty.min.css') }}">
@php
use Illuminate\Support\Str;
$sess=Session::get('request_search');
@endphp
@if($errorStatus == false)                    
<div class="home1">
  <div class="home_slider_container1">
    <div class="owl-carousel owl-theme home_slider1">
      <div class="owl-item home_slider_item1">
        <div class="home_slider_background1" style="background-image:url(../images/bg.jpg)"></div>
        <div class="home_slider_content1 text-center">
          <div class="home_slider_content_inner1" data-animation-in="flipInX" data-animation-out="animate-out fadeOut">
            <h1>{{ count($results['Response']['Results'][0]) }}  Flight Found</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- <div class="row toggle-container">
	<div class="col-md-2">
		<div class="panel style1 arrow-right">
			<h4 class="panel-title">Flight Stops</h4>
			<div class="panel-body">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="customCheckD" name="DirectFlight" value="true">
					<label class="custom-control-label" for="customCheckD">Non Stop</label>
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="customCheckO" name="OneStopFlight" value="true">
					<label class="custom-control-label" for="customCheckO">1 Stop</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel style1 arrow-right">
			<h4 class="panel-title">Flight Type</h4>
			<div class="panel-content">
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="customCheck1" name="preferClass" value="1">
					<label class="custom-control-label" for="customCheck1">All</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="customCheck2" name="preferClass" value="2">
					<label class="custom-control-label" for="customCheck2">Economy</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="customCheck3" name="preferClass" value="3">
					<label class="custom-control-label" for="customCheck3">Premium Economy</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="customCheck4" name="preferClass" value="4">
					<label class="custom-control-label" for="customCheck4">Business</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="customCheck5" name="preferClass" value="5">
					<label class="custom-control-label " for="customCheck5">Premium Business</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="customCheck6" name="preferClass" value="6">
					<label class="custom-control-label" for="customCheck6">First</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel style1 arrow-right">
			<h4 class="panel-title">Airlines</h4>
			<div class="panel-content">
				@foreach($airlines as $key => $airline)
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="PreferredAirlines{{$loop->index}}" name="PreferredAirlines" value="{{  $airline->IATA }}">
					<label class="custom-control-label" for="PreferredAirlines{{$loop->index}}">{{ $airline->Airline }}</label>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel style1 arrow-right">
			<h4 class="panel-title">Flight Times</h4>
			<div class="panel-content">
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="mor" name="preferDepartureTime" value="mor">
					<label class="custom-control-label" for="mor">Morning</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="aft" name="preferDepartureTime" value="aft">
					<label class="custom-control-label" for="aft">After-noon</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="eve" name="preferDepartureTime" value="eve">
					<label class="custom-control-label" for="eve">Evening</label>
				</div>
			</div>
		</div>
	</div>
</div> --}}

<section class="section" id="content">
	<div class="row">
    <div class="container">
      <div class="row">
	 <div class="col-sm-4 col-md-3">
         @include('frontend.pages.flight.search_flight.flight_filter')
     </div>

	<div class="col-md-9">
		<div class="row">
			<div class="col-md-6">
				<div class="flight-list listing-style3 flight bg-white" >
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"> {{ $sess['from'] }} to {{ $sess['to'] }} , {{ date('d-M', strtotime($sess['depart'])) }}</h3>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-vcenter flight-search" id="leftTab">
									<thead>
										<tr>
											<th class="no-sort">Sort</th>
											<th>Depart</th>
											<th>Arrival</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										@foreach($results['Response']['Results'][0] as $key => $value)
										
										@php
										$airline = $value['Segments'][0][0]['Airline'];
										$segment = $value['Segments'][0][0];
										$markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);
									   if($markupModel != null){
									   if($markupModel['visibility_status'] == false){
									   continue; }
									   }
										@endphp
										<tr>
											<span class="help-block"><div class="custom-control custom-radio action ">
												<input type="radio" class="custom-control-input" id="lside{{ $key }}" name="depart" value="{{ json_encode($value) }}">
												<label class="custom-control-label" for="lside{{ $key }}"> {{ $airline['AirlineName'] }} |
												{{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</label>
											</div>
										</span>
											{{-- {!! Form::open(['route'=>'flight.details','id'=>$value['ResultIndex']]) !!} --}}
											<td class="min-width"><img class="img-responsive" src="{{ asset('images/'.Str::lower($airline['AirlineName']).'.jpg') }}" alt="thumbs" style="height:40px; width:40px"></td>
											
											<td>
												@php
												$departure = explode('T',$segment['Origin']['DepTime']);
												$date = \Carbon\Carbon::parse($departure[0]);
												$time = \Carbon\Carbon::parse($departure[1]);
												@endphp
												<span><b>{{ $time->format('g:i A') }}</b></span>
												<span style="font-size: 10px;" class="help-block">{{ $segment['Origin']['Airport']['CityName'] }}</span>
											</td>
											<td>
												@php
												$arival = explode('T',$segment['Destination']['ArrTime']);
												$date = \Carbon\Carbon::parse($arival[0]);
												$time = \Carbon\Carbon::parse($arival[1]);
												@endphp
												<span><b>{{ $time->format('g:i A') }}</b></span>
												<span style="font-size: 10px;" class="help-block">{{ $segment['Destination']['Airport']['CityName'] }}</span>
											</td>
											<td>
												 @php
						                          if($markupModel['amount_by'] == 'percent'){
						                             $amount = $value['Fare']['PublishedFare'];
						                             $percent = ($amount*$markupModel['plus_percent'])/100;
						                             $amount = round($amount+$percent);
						                          }elseif($markupModel['amount_by'] == 'rupee'){
						                             $amount = round($value['Fare']['PublishedFare'] + $markupModel['plus_amount']);
						                             Session::put('markup', $amount);
						                          }else{
						                             $amount = round($value['Fare']['PublishedFare']);
						                          }
						                          @endphp
												<span style="color: red; font-size: 18px">₹</span>
												<span style="color: red; font-size: 18px">{{ $amount }}</span>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="flight-list listing-style3 flight bg-white" >
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"> {{ $sess['from'] }} to {{ $sess['to'] }} , {{ date('d-M', strtotime($sess['depart'])) }}</h3>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-vcenter flight-search" id="RightTab">
									<thead>
										<tr>
											<th class="no-sort">Sort</th>
											<th>Depart</th>
											<th>Arrival</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										@foreach($results['Response']['Results'][1] as $key => $value)
										
										@php
										$airline = $value['Segments'][0][0]['Airline'];
										$segment = $value['Segments'][0][0];
										$markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);
									   if($markupModel != null){
									   if($markupModel['visibility_status'] == false){
									   continue; }
									   }
										@endphp
										<tr>
											<div class="custom-control custom-radio action help-block">
												<input type="radio" class="custom-control-input" id="rside{{ $key }}" name="depart" value="{{ json_encode($value) }}">
												<label class="custom-control-label" for="rside{{ $key }}"> {{ $airline['AirlineName'] }} |
												{{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</label>
											</div>

											{{-- {!! Form::open(['route'=>'flight.details','id'=>$value['ResultIndex']]) !!} --}}
											<td class="min-width"><img class="img-responsive" src="{{ asset('images/'.Str::lower($airline['AirlineName']).'.jpg') }}" alt="thumbs" style="height:40px; width:40px"></td>
											
											<td>
												@php
												$departure = explode('T',$segment['Origin']['DepTime']);
												$date = \Carbon\Carbon::parse($departure[0]);
												$time = \Carbon\Carbon::parse($departure[1]);
												@endphp
												<span><b>{{ $time->format('g:i A') }}</b></span>
												<span style="font-size: 10px;" class="help-block">{{ $segment['Origin']['Airport']['CityName'] }}</span>
											</td>
											<td>
												@php
												$arival = explode('T',$segment['Destination']['ArrTime']);
												$date = \Carbon\Carbon::parse($arival[0]);
												$time = \Carbon\Carbon::parse($arival[1]);
												@endphp
												<span><b>{{ $time->format('g:i A') }}</b></span>
												<span style="font-size: 10px;" class="help-block">{{ $segment['Destination']['Airport']['CityName'] }}</span>
											</td>
											<td>
												 @php
						                          if($markupModel['amount_by'] == 'percent'){
						                             $amount = $value['Fare']['PublishedFare'];
						                             $percent = ($amount*$markupModel['plus_percent'])/100;
						                             $amount = round($amount+$percent);
						                          }elseif($markupModel['amount_by'] == 'rupee'){
						                             $amount = round($value['Fare']['PublishedFare'] + $markupModel['plus_amount']);
						                             Session::put('markup', $amount);
						                          }else{
						                             $amount = round($value['Fare']['PublishedFare']);
						                          }
												@endphp
												<span style="color: red; font-size: 18px">₹</span>
												<span style="color: red; font-size: 18px">{{ $amount }}</span>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
      </div>
    </div>
     </div>
</section> 
@endif
@endsection
@if(!empty($results['Response']['Results'][1]))
<div class="row card sticky3 "  style="display:none" id="stickB">
   <div class="col-md-4 card-content ml4" id="LeftDiv">
   </div>
   <div class="col-md-4 card-content"  id="RightDiv">
   </div>
   <div class="col-md-2 card-content mt3">

       <p id="roundP" class="fs35"></p>       
      <a href="javascript:void(0)" class="button btn border-round gradient-45deg-light-blue-cyan gradient-shadow" onclick="document.getElementById('Rflight').submit()">Book</a>

   </div>
</div>
<style type="text/css">
   #footer{
   display:none;
   }
</style>
@endif
@section('script')
<script type="text/javascript">
$(document).ready(function(){
  $("#leftTab").DataTable({
    "bLengthChange": false,
    "searching": false,
    "order": [[ 3, "asc" ]],
        "responsive": true,
        "language": {
            "paginate": {
              "previous": '<i class="fa fa-angle-left"></i>',
              "next": '<i class="fa fa-angle-right"></i>'
            }
        },
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
    });


   $("#RightTab").DataTable({
    "bLengthChange": false,
    "searching": false,
    "order": [[ 3, "asc" ]],
        "responsive": true,
        "language": {
            "paginate": {
              "previous": '<i class="fa fa-angle-left"></i>',
              "next": '<i class="fa fa-angle-right"></i>'
            }
        },
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
    });
});

</script>
@endsection
