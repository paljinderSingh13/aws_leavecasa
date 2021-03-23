@extends('frontend.layout.materialize')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'v2.9/css/nifty.min.css') }}">
@php
use Illuminate\Support\Str;
//dd($results);
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
@endif
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
                 <h3 class="panel-title">Multiway</h3>
               </div>
                <div class="panel-body">

            <div class="table-responsive">
            <table class="table table-vcenter flight-search" id="multiWay">
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

                    @foreach($value['Segments'] as $skey => $sval)
                    <tr>
                        <td><img class="img-responsive" src="{{ asset('images/'.Str::lower($sval[0]['Airline']['AirlineName']).'.jpg') }}" alt="thumbs" style="height:50px; width:50px"></td>

                        <td>
                            <span><b>{{ $sval[0]['Airline']['AirlineName'] }}</b></span>.
                            <span style="font-size: 10px;" class="help-block">{{ $sval[0]['Airline']['AirlineCode'] }} - {{ $sval[0]['Airline']['FlightNumber'] }}</span>
                        </td>
                        <td>
                            @php
                                $departure = explode('T',$sval[0]['Origin']['DepTime']);
                                $date = \Carbon\Carbon::parse($departure[0]);
                                $time = \Carbon\Carbon::parse($departure[1]);
                            @endphp
                            <span><b>{{ $time->format('g:i A') }}</b></span>
                            <span style="font-size: 10px;" class="help-block">{{ $sval[0]['Origin']['Airport']['CityName'] }}</span>
                        </td>
                        <td>
                            @php
                                $arival = explode('T',$sval[0]['Destination']['ArrTime']);
                                $date = \Carbon\Carbon::parse($arival[0]);
                                $time = \Carbon\Carbon::parse($arival[1]);
                            @endphp
                            <span><b>{{ $time->format('g:i A') }}</b></span>
                            <span style="font-size: 10px;" class="help-block">{{ $sval[0]['Destination']['Airport']['CityName'] }}</span>
                        </td>
                         @if($skey ==0)
                        <td>
                          @php
                          if($markupModel['amount_by'] == 'percent'){
                          $amount = $value['Fare']['PublishedFare'];
                          $percent = ($amount*$markupModel['plus_percent'])/100;
                          $amount = round($amount+$percent);
                          }elseif($markupModel['amount_by'] == 'rupee'){
                          $amount = round($value['Fare']['PublishedFare'] + $markupModel['plus_amount']);
                          }else{
                          $amount = round($value['Fare']['PublishedFare']);
                          }
                          @endphp
                            <span style="color: red; font-size: 18px">₹</span>
                            <span style="color: red; font-size: 18px">{{ $amount }}</span>
                        </td>
                        <td class="min-width">
                           {!! Form::open(['route'=>'flight.details','id'=>$value['ResultIndex']]) !!}
                          <input type="hidden" value="multi_way" name="trip_type" />
                          <input type="hidden" value="{{$value['ResultIndex']}}" name="ResultIndex" />
                          <input type="hidden" value="{{ json_encode($value) }}" name="flight_details">
                          <button class="btn btn-primary btn-rounded" onclick="document.getElementById('{{ $value['ResultIndex'] }}').submit()">Book</button>
                          
                          {!! Form::close() !!}
                        </td>
                        @else
                        <td></td>
                        <td></td>
                         @endif
                    </tr>
                     @endforeach
                 
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
@endsection
    
{{--   @elseif(($tripType == 'multi_city'))
   <div class="sort-by-section row hide-on-med-and-down">
      <div class="col l2">
         <h6 class="center-align">Sort By:</h6>
      </div>
      <div class="col l2">
         <h6 class="center-align">Departure</h6>
      </div>
      <div class="col l2">
         <h6 class="center-align">Duration</h6>
      </div>
      <div class="col l2">
         <h6 class="">Arrival</h6>
      </div>
      <div class="col l2">
         <h6 class="">Price</h6>
      </div>
      <div class="col l2">
         <h6 class="">Book</h6>
      </div>
   </div>
   @if($results['Response']['Error']['ErrorCode'] == 0)
   @foreach($results['Response']['Results'][0] as $key => $record)
   @php
   $airline = $record['Segments'][0][0]['Airline'];
   $segment = $record['Segments'][0][0];
   $markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);
   if($markupModel != null){
   if($markupModel['visibility_status'] == false){
   continue;
   }
   }
   @endphp
   <div class="single_flight_details card border-radius-8 z-depth-4" data-airline="{{ $record['AirlineCode'] }}">
      @foreach($record['Segments'] as $skey => $sval)
      <div class="row card-content">
         @php
         $departTime = $sval[0]['Origin']['DepTime'];
         $departTime = explode('T',$departTime);
         $date = \Carbon\Carbon::parse($departTime[0]);
         $time = \Carbon\Carbon::parse($departTime[1]);
         @endphp
         <h6>Trip : On {{  $date->format('d-m-Y') }} </h6>
         <div class="col l2 p-0">
            <div class="row valign-wrapper">
               <div class="col l5">   

                  <img alt="" src="{{ asset('images/'.Str::lower($sval[0]['Airline']['AirlineName']).'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
               </div>
               <div class="col l7 p-0">
                  <h6 class="p-0 black-text">{{ $sval[0]['Airline']['AirlineName'] }}</h6>
                  <span>{{ $sval[0]['Airline']['AirlineCode'] }} - {{ $sval[0]['Airline']['FlightNumber'] }}</span>
               </div>
            </div>
         </div>
         <div class="col l2 ">
            @php
            $departTime = $sval[0]['Origin']['DepTime'];
            $departTime = explode('T',$departTime);
            $date = \Carbon\Carbon::parse($departTime[0]);
            $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <h6 class="black-text"> {{ $time->format('g:i A') }}</h6>
            <small>{{ $sval[0]['Origin']['Airport']['CityName'] }}</small>
         </div>
         <div class="col l2">
            @php
            $duration = $sval[0]['Duration'];
            @endphp
            <u>
              <h6 class="black-text"> {{ floor($duration / 60) }} hr, {{ ($duration -   floor($duration / 60) * 60) }} mins</h6>
            </u>
         </div>
         <div class="col l2">
            @php
            $departTime = $sval[0]['Destination']['ArrTime'];
            $departTime = explode('T',$departTime);
            $date = \Carbon\Carbon::parse($departTime[0]);
            $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <h6 class="black-text">{{ $time->format('g:i A') }}</h6>
            <small>{{ $sval[0]['Destination']['Airport']['CityName'] }}</small>
         </div>
         @if($skey ==0)
         <div class="col l2">
            @php
            if($markupModel['amount_by'] == 'percent'){
            $amount = $record['Fare']['PublishedFare'];
            $percent = ($amount*$markupModel['plus_percent'])/100;
            $amount = round($amount+$percent);
            }elseif($markupModel['amount_by'] == 'rupee'){
            $amount = round($record['Fare']['PublishedFare'] + $markupModel['plus_amount']);
            }else{
            $amount = round($record['Fare']['PublishedFare']);
            }
            @endphp
            <h5 class="black-text">₹{{ $amount }}</h5>
         </div>
         <div class="col l2 action">
            {!! Form::open(['route'=>'flight.details','id'=>$record['ResultIndex']]) !!}
            <input type="hidden" value="multi_way" name="trip_type" />
            <input type="hidden" value="{{$record['ResultIndex']}}" name="ResultIndex" />
            <input type="hidden" value="{{ json_encode($record) }}" name="flight_details">
            <a href="javascript:void(0)" class="button btn border-round gradient-45deg-light-blue-cyan gradient-shadow mt10" onclick="document.getElementById('{{ $record['ResultIndex'] }}').submit()">Book</a>
            {!! Form::close() !!}
         </div>
         @endif
      </div>
      @endforeach
      <div class="row">
         <a href="javascript:void(0)" class="button btn pills mdb white-text show_flight_details ml1">Flight Details</a>
      </div>
      <div class="row fl_details" style="display: none;">
         <div class="col m12 mr-2">
            <div class="details_box animate fadeLeft z-depth-4">
               <div class="nav-content">
                  <ul class="tabs tabs-default">
                     <li class="active tab"><a href="#flight_info{{$loop->index}}">Flight Information</a>
                     </li>
                     <li class="tab"><a href="#fare_det{{$loop->index}}">Fare Details</a>
                     </li>
                     <li class="tab"><a href="#bag_info{{$loop->index}}">Baggage Information</a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane fade in active" id="flight_info{{$loop->index}}">
                        <h6>
                           {{ $segment['Origin']['Airport']['CityName']}}
                           <i class="material-icons" style="vertical-align: top">arrow_forward</i>
                           {{ $segment['Destination']['Airport']['CityName'] }}
                           @php
                           $journeyDate = explode('T',$segment['Origin']['DepTime']);
                           $carbonParsed = \Carbon\Carbon::parse($journeyDate[0]);
                           echo $carbonParsed->format('l').' '.$carbonParsed->format('M').' '.$carbonParsed->format('d').' '.$carbonParsed->format('Y');
                           @endphp
                        </h6>
                        <div class="row">
                           <div class="col m3 l3">
                              <h6 style="margin-bottom: -1%;">{{ $segment['Airline']['AirlineName'] }}</h6>
                              <small>({{ $segment['Airline']['AirlineCode'] }} - {{ $segment['Airline']['FlightNumber'] }})</small>
                              <br>
                              <small>(Aircraft: {{ $segment['Craft'] }})</small>
                           </div>
                           <div class="col m9 l9">
                              <div class="row">
                                 <div class="col m4 l4">
                                   
                                       @php
                                         $time = \Carbon\Carbon::parse($journeyDate[0]);
                                         echo $time->format('l M d Y')
                                       @endphp
                                       
                                    <h5>
                                       {{ $segment['Origin']['Airport']['AirportCode'] }}
                                       @php
                                       $time = \Carbon\Carbon::parse($journeyDate[1]);
                                       echo $time->format('g:i A')
                                       @endphp
                                    </h5>
                                    <small>{{ $segment['Origin']['Airport']['AirportName'] }}</small>
                                 </div>
                                 <div class="col m4 l4">
                                    @php $duration = $record['Segments'][0][0]['Duration']; @endphp
                                    <h5> {{ floor($duration / 60) }} hr, {{ ($duration -   floor($duration / 60) * 60) }} mins</h5>
                                    Flight Duration
                                 </div>
                                 <div class="col m4 l4">                                  
                                       @php
                                         $journeyDate = explode('T',$segment['Destination']['ArrTime']);
                                         $time = \Carbon\Carbon::parse($journeyDate[0]);
                                         echo $time->format('l M d Y')
                                       @endphp
                                       <h5>
                                       {{ $segment['Destination']['Airport']['AirportCode'] }}
                                       @php
                                       $time = \Carbon\Carbon::parse($journeyDate[1]);
                                       echo $time->format('g:i A')
                                       @endphp
                                    </h5>
                                    <small>{{ $segment['Destination']['Airport']['AirportName'] }}</small>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="fare_det{{$loop->index}}">
                        <table class="table table-striped">
                           <tbody>
                              <tr>
                                 <td>Base Fare</td>
                                 <td>₹{{ $record['Fare']['BaseFare'] }}</td>
                              </tr>
                              <tr>
                                 <td>Taxes and Fees</td>
                                 <td>₹{{ $record['Fare']['Tax'] }}</td>
                              </tr>
                              <tr>
                                 <td><b>Total Fare</b>
                                 </td>
                                 <td>₹{{ $record['Fare']['BaseFare']+$record['Fare']['Tax'] }}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="tab-pane fade" id="bag_info{{$loop->index}}">
                        <table class="table table-striped">
                           <tbody>
                              <tr>
                                 <td>Baggage Type</td>
                                 <td>Check-In</td>
                                 <td>Cabin</td>
                              </tr>
                              <tr>
                                 <td>Adult</td>
                                 <td>{{ $segment['Baggage'] }}</td>
                                 <td>{{ $segment['CabinBaggage'] }}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach
   @endif
   @endif
</div>
</div>
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
</div>
</div>
@if(($tripType == 'round')&&(!empty($results['Response']['Results'][1])))
<div class="row card sticky3 "  style="display:none" id="stickB">
   <div class="col l4 card-content ml4" id="LeftDiv">
   </div>
   <div class="col l4 card-content"  id="RightDiv">
   </div>
   <div class="col l2 card-content mt3">

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
</section>
<style type="text/css">
   .details_box{
   background-color: #f2f2f2;
   padding: 2%;
   }

</style> --}}
{{-- @endsection --}}

@section('script')
<script type="text/javascript">
$(document).ready(function(){
  $("#multiWay").DataTable({
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