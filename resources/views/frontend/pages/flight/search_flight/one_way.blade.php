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
<section class="section" id="content">
  <div class="row">
    <div class="container">
      <div class="row">


        <div class="col-sm-4 col-md-3">
         @include('frontend.pages.flight.search_flight.flight_filter')
         </div>

          <div class="col-md-9">
          	<div class="flight-list listing-style3 flight bg-white" >
              <div class="panel">
                <div class="panel-heading">
                      <h3 class="panel-title"> {{ $sess['from'] }} to {{ $sess['to'] }} , {{ date('d-M', strtotime($sess['depart'])) }}</h3>
                </div>
                <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-striped table-vcenter flight-search" id="oneWay">
                <thead>
                <tr>
                    <th class="no-sort">Sorted By :</th>                  
                    <th>Airlines</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Price</th>
                    <th class="text-center">Actions</th>
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
                     continue;
                     }
                     }
                    @endphp
                    <tr>
                    {{-- {!! Form::open(['route'=>'flight.details','id'=>$value['ResultIndex']]) !!} --}}
                        <td><img class="img-responsive" src="{{ asset('images/'.Str::lower($airline['AirlineName']).'.jpg') }}" alt="thumbs" style="height:50px; width:50px"></td>

                        <td>
                            <span><b>{{ $airline['AirlineName'] }}</b></span>.
                            <span style="font-size: 10px;" class="help-block">{{ $airline['AirlineCode'] }}-{{ $airline['FlightNumber'] }}</span>
                        </td>
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
                        <td class="min-width">
                          {!! Form::open(['route'=>'flight.details','id'=>'book_flight'.$loop->index]) !!}
                           <input type="hidden" value="one_way" name="trip_type" />
                           <input type="hidden" value="{{ json_encode($value) }}" name="flight_details">
                           <button class="btn btn-primary btn-rounded" onclick="document.getElementById('book_flight{{ $loop->index }}').submit()">Book</button>
                           {!! Form::close() !!}
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
</section>
@else
<div class="row">
  <div class="center-align white">
      <img src="{{ asset('/images/not_found.gif') }}" class="bg-gif-404" alt="">
      <h2 class="error-code m-0">Sorry ! {{ $errorMessage }}</h2>
      <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back
        TO Home</a>
    </div> 
</div>
 
@endif
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
  $("#oneWay").DataTable({
    "bLengthChange": false,
    "searching": false,
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
