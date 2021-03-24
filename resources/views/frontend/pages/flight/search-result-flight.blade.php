@extends('frontend.layout.materialize')
@section('content')
@php
use Illuminate\Support\Str;
@endphp
    <section id="content">
    <div class="row mdb p1 ">
        <div class="col offset-l1 l5 s12">
            <p class="f28w100 white-text mt0 mb0">Flight Search Results</p>
        </div>
        <div class="col l5 p0 hide-on-med-and-down">
            <ul class="stepper horizontal">
                <li class="step active blue-text">
                    <div class="step-title waves-effect">Selection</div>
                </li>
                <li class="step grey-text">
                    <div class="step-title waves-effect">Review</div>
                </li>
                <li class="step grey-text">
                    <div class="step-title waves-effect">Payment</div>
                </li>
            </ul>
        </div>
    </div>  
{{--     @php
    dd($results);
    @endphp     --}}
<div class="container">
<div id="main">
@if($errorStatus == false)                    
<div class="row">
<div class="col offset-s1 s10 m2 l2 pr-0 ">
   <div class="card  animate fadeLeft border-radius-8 z-depth-4">
      <div class="card-content">
         <span class="card-title icon_prefix" ><i class="material-icons mr-2 search-icon orange-text" style="vertical-align: top;">search</i><b>{{ count($results['Response']['Results'][0]) }}</b> results.</span>
         <span class="card-title mt-10">Advance Search</span>
         <hr class="p-0 mb-10">
         {{-- <div class="loader"></div> --}}
         <form method="post" action="{{ route('advance.search.results') }}">
            <input type="hidden" value="{{ $tripType }}" name="trip_type" />
            {{ csrf_field() }}
            @foreach($airlines as $key => $airline)
            <p class="display-grid">
               <label>
               <input type="checkbox" value="{{  $airline->IATA }}" name="PreferredAirlines[]">
               <span>{{ $airline->Airline }} </span></label>
            </p>
            @endforeach
            <span class="card-title mt-10">Departure Time</span>
            <hr class="p-0 mb-10">
            <p class="display-grid">
               <label>
               <input type="checkbox" value="true" name="DirectFlight"><span>Direct </span>
               </label>
               <label>
               <input type="checkbox" value="true" name="OneStopFlight"><span>One Stop </span>
               </label>
            </p>
            <span class="card-title mt-10">Seat Class</span>
            <hr class="p-0 mb-10">
            <p class="display-grid">
               <label> <input type="radio" class="with-gap" name="preferClass" value="1"> <span>All  </span></label>
               <label><input type="radio" class="with-gap" name="preferClass" value="2"><span> Economy</span></label>
               <label><input type="radio" class="with-gap" name="preferClass" value="3"><span> Premium Economy</span></label>
               <label><input type="radio" class="with-gap" name="preferClass" value="4"><span> Business</span></label>
               <label><input type="radio" class="with-gap" name="preferClass" value="5"><span> Premium Business</span></label>
               <label><input type="radio" class="with-gap" name="preferClass" value="6"><span> First</span></label>
            </p>
            <span class="card-title mt-10">Departure Time</span>
            <hr class="p-0 mb-10">
            <p class="display-grid">
               <label><input type="radio" class="with-gap" name="preferDepartureTime" value="mor"><span> Morning</span></label>
               <label><input type="radio" class="with-gap" name="preferDepartureTime" value="aft"><span> After-noon</span></label>
               <label><input type="radio" class="with-gap" name="preferDepartureTime" value="eve"><span> Evening</span></label>
            </p>
            <button class="btn mdb waves-effect waves-light mt3" type="submit">search again
            </button>
         </form>
      </div>
   </div>
</div>
<div class="col s12 m10 l10">
   @if(($tripType == 'round'))
    @if(($tripType == 'round') &&(empty($results['Response']['Results'][1])))
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
               Session::put('markup', $amount);
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
                                    @php $duration = $record['Segments'][0][0]['Duration']; 
                                    @endphp
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
   @elseif($results['Response']['Error']['ErrorCode'] == 0)
   {!! Form::open(['route'=>'flight.details','id'=>'Rflight']) !!}
   @php 
   $sesion=Session::get('request_search');
   
   @endphp
   <input type="hidden" value="round" name="trip_type" />
   <div class="row">
      <div class="col l6 s6">
         <h6 class="ml3">Departure Flight : {{ $sesion['depart'] }}</h6>
      </div>
      <div class="col l6 s6">
         <h6 class="ml3">Return Flight : {{ $sesion['returning'] }}</h6>
      </div>
   </div>
   <div class="row">
      <div class="flight-list listing-style3 flight col l6  s6 p-1">
         @php
         $lowest_price_one = 10000000000000;
         $lowest_price_one_index ='';
         @endphp
         @foreach($results['Response']['Results'][0] as $key => $record)
         @php
         $airline = $record['Segments'][0][0]['Airline'];
         $segment = $record['Segments'][0][0];
         $markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);
         if($markupModel != null)
         {
         if($markupModel['visibility_status'] == false)
         {
         continue;
         }
         }
         @endphp
         @php
         if($markupModel['amount_by'] == 'percent')
         {
         $amount = $record['Fare']['PublishedFare'];
         $percent = ($amount*$markupModel['plus_percent'])/100;
         $amount = round($amount+$percent);
         }elseif($markupModel['amount_by'] == 'rupee')
         {
         $amount = round($record['Fare']['PublishedFare'] + $markupModel['plus_amount']);
         }else{
         $amount = round($record['Fare']['PublishedFare']);
         }
         if($lowest_price_one > $amount ){
         $lowest_price_one = $amount;
         $lowest_price_one_index = $key;
         }
         // endfor
         @endphp
         @if(count($record['Segments'][0]) > 1)
         <div class="card border-radius-8 z-depth-4" >
            @foreach($record['Segments'][0] as $mkey => $mval)
            <div class="details  card-content">
               @if($mkey ==0)
               <div class="action row">
                  <label class="radio radio-inline">
                  <input type="radio" class="with-gap blue-text"  name="depart" value="{{ json_encode($record) }}" required="required"><span class="black-text"> {{ $mval['Airline']['AirlineName'] }} | 
                  {{ $mval['Airline']['AirlineCode'] }} - {{ $mval['Airline']['FlightNumber'] }}</span>
                  </label>
               </div>
               @else
               <span class="black-text"> {{ $mval['Airline']['AirlineName'] }} | 
               {{ $mval['Airline']['AirlineCode'] }} - {{ $mval['Airline']['FlightNumber'] }}</span>
               @endif
               <div class="row">
                  <div class="col l3 p-0 ">
                     <img alt="" src="{{ asset('images/'.Str::lower($mval['Airline']['AirlineName']).'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
                  </div>
                  <div class="take-off col l3">
                     <div class="row">
                        @php
                        $departTime = $mval['Origin']['DepTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                        @endphp
                        <span class="skin-color"><span>{{ $time->format('g:i A') }}</span>
                     </div>
                     <div class="row"><span>{{ $mval['Origin']['Airport']['CityName']}}</span></div>
                  </div>
                  <div class="landing col l3">
                     <div class="row">
                        @php
                        $departTime = $mval['Destination']['ArrTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                        @endphp
                        <span class="skin-color"><span>{{ $time->format('g:i A') }}</span>
                     </div>
                     <div class="row"><span>{{ $mval['Destination']['Airport']['CityName'] }}</span></div>
                  </div>
                  <div class="col l3"><span class="price">₹{{ $amount }}</span></div>
               </div>
            </div>
            @endforeach
         </div>
         @else
         <div class="card border-radius-8 z-depth-4" id="LeftCloneDL{{ $key }}">
            <div class="details  card-content" >
               <div class="action row">
                  <label class="radio radio-inline">                   
                  <input type="radio" class="with-gap blue-text " id="L{{ $key }}"  name="depart" value="{{ json_encode($record) }}" required="required" onclick="LeftCloneD(this.id)"><span class="black-text"> 
                  {{ $segment['Airline']['AirlineName'] }} | 
                  {{ $segment['Airline']['AirlineCode'] }} - {{ $segment['Airline']['FlightNumber'] }}</span>
                  </label>
               </div>
               <div class="row">
                  <div class="col l3 p-0 ">
                     <img alt="" src="{{ asset('images/'.Str::lower($record['Segments'][0][0]['Airline']['AirlineName']).'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
                  </div>
                  <div class="take-off col l3">
                     <div class="row">
                        @php
                        $departTime = $record['Segments'][0][0]['Origin']['DepTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                        @endphp
                        <span class="skin-color"><span>{{ $time->format('g:i A') }}</span>
                     </div>
                     <div class="row"><span>{{ $segment['Origin']['Airport']['CityName']}}</span></div>
                  </div>
                  <div class="landing col l3">
                     <div class="row">
                        @php
                        $departTime = $record['Segments'][0][0]['Destination']['ArrTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                        @endphp
                        <span class="skin-color"><span>{{ $time->format('g:i A') }}</span>
                     </div>
                     <div class="row"><span>{{ $segment['Destination']['Airport']['CityName'] }}</span></div>
                  </div>
                  <div class="col l3"><span class="price">₹{{ $amount }}</span></div>
               </div>
            </div>
         </div>
         @endif
         @endforeach
      </div>
      <div class="flight-list listing-style3 flight col l6 s6" >
         <div>
            @php
            echo "<script> $('#ob".$lowest_price_one_index."').attr('checked', true); </script>";
            @endphp
         </div>
         @if(!empty($results['Response']['Results'][1]))
         @foreach($results['Response']['Results'][1] as $key => $record)
         @php
         // @dump($record['ResultIndex']);
         $airline = $record['Segments'][0][0]['Airline'];
         $segment = $record['Segments'][0][0];
         $markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);
         if($markupModel != null)
         {
         if($markupModel['visibility_status'] == false)
         {
         continue;
         }
         }
         @endphp
         @php
         if($markupModel['amount_by'] == 'percent')
         {
            $amount = $record['Fare']['PublishedFare'];
            $percent = ($amount*$markupModel['plus_percent'])/100;
            $amount = round($amount+$percent);
         }elseif($markupModel['amount_by'] == 'rupee')
         {
         $amount = round($record['Fare']['PublishedFare'] + $markupModel['plus_amount']);
         }else{
            $amount = round($record['Fare']['PublishedFare']);
         }
         @endphp
         @if(count($record['Segments'][0]) > 1)
         <div class="card border-radius-8 z-depth-4">
            @foreach($record['Segments'][0] as $mkey => $mval)
            <div class="details  card-content">
               @if($mkey ==0)
               <div class="action row">
                  <label class="radio radio-inline">
                  <input type="radio" class="with-gap blue-text"  name="return" value="{{ json_encode($record) }}" required="required"><span class="black-text"> {{ $mval['Airline']['AirlineName'] }} | 
                  {{ $mval['Airline']['AirlineCode'] }} - {{ $mval['Airline']['FlightNumber'] }}</span>
                  </label>
               </div>
               @else
               <span class="black-text"> {{ $mval['Airline']['AirlineName'] }} | 
               {{ $mval['Airline']['AirlineCode'] }} - {{ $mval['Airline']['FlightNumber'] }}</span>
               @endif
               <div class="row">
                  <div class="col l3 p-0 ">
                     <img alt="" src="{{ asset('images/'.Str::lower($mval['Airline']['AirlineName']).'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
                  </div>
                  <div class="take-off col l3">
                     <div class="row">
                        @php
                        $departTime = $mval['Origin']['DepTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                        @endphp
                        <span class="skin-color"><span>{{ $time->format('g:i A') }}</span>
                     </div>
                     <div class="row"><span>{{ $mval['Origin']['Airport']['CityName']}}</span></div>
                  </div>
                  <div class="landing col l3">
                     <div class="row">
                        @php
                        $departTime = $mval['Destination']['ArrTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                        @endphp
                        <span class="skin-color"><span>{{ $time->format('g:i A') }}</span>
                     </div>
                     <div class="row"><span>{{ $mval['Destination']['Airport']['CityName'] }}</span></div>
                  </div>
                  <div class="col l3"><span class="price">₹{{ $amount }}</span></div>
               </div>
            </div>
            @endforeach
         </div>
         @else
         <div class="card border-radius-8 z-depth-4" id="RightCloneDR{{ $key }}">
            <div class="details card-content">
               <div class="action row">
                  <label class="radio radio-inline">
                  <input type="radio" id="R{{ $key }}" name="return" value="{{ json_encode($record) }}" required="required" class="with-gap "  onclick="RightCloneD(this.id)"><span class=black-text> {{ $segment['Airline']['AirlineName'] }} | 
                  {{ $segment['Airline']['AirlineCode'] }} - {{ $segment['Airline']['FlightNumber'] }}</span>
                  </label>
               </div>
               <div class="row">
                  <div class="col l3">
                     <img alt="" src="{{ asset('images/'.Str::lower($record['Segments'][0][0]['Airline']['AirlineName']).'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
                  </div>
                  <div class="take-off col l3">
                     <div class="row">
                        @php
                        $departTime = $record['Segments'][0][0]['Origin']['DepTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                        @endphp
                        <span class="skin-color">{{ $time->format('g:i A') }}</span>
                     </div>
                     <div class="row"><span>{{ $segment['Origin']['Airport']['CityName']}}</span></div>
                  </div>
                  <div class="landing col l3">
                     <div class="row">
                        @php
                        $departTime = $record['Segments'][0][0]['Destination']['ArrTime'];
                        $departTime = explode('T',$departTime);
                        $date = \Carbon\Carbon::parse($departTime[0]);
                        $time = \Carbon\Carbon::parse($departTime[1]);
                        @endphp
                        <span class="skin-color"> {{ $time->format('g:i A') }}</span>
                     </div>
                     <div class="row"><span>{{ $segment['Destination']['Airport']['CityName'] }}</span></div>
                  </div>
                  <div class="col l3">
                     <span class="price">₹{{ $amount }}</span>
                  </div>
               </div>
            </div>
         </div>
         @endif
         @endforeach
         @endif
      </div>
      @php
      @endphp
   </div>
   {!! Form::close() !!}
   @endif
   @elseif($tripType == 'one_way')
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
   <div class="flight-list listing-style3 flight">
      @foreach($results['Response']['Results'][0] as $key => $record)
      
      @php
      $airline = $record['Segments'][0][0]['Airline'];
      $segment = $record['Segments'][0][0];
      $markupModel = App\Model\Administrator\ApiSettings\FlightsMarkup::markupAmountAndStatus($airline['AirlineName'], $airline['FlightNumber'], $airline['AirlineCode'], $segment['Origin']['Airport']['CityName'], $segment['Destination']['Airport']['CityName'], true);

      // dump($record['Fare']['PublishedFare'], 'markup', $markupModel);
      if($markupModel != null){
      if($markupModel['visibility_status'] == false){
      continue;
      }
      }
      @endphp
      @if(count($record['Segments'][0]) > 1)
      <div class="single_flight_details card border-radius-8 z-depth-4" data-airline="{{ $record['AirlineCode'] }}">
         @php
         //dump($loop);
         @endphp
         {!! Form::open(['route'=>'flight.details','id'=>$record['ResultIndex']]) !!}
         @foreach($record['Segments'][0] as $mkey => $mval)
         <div class="row card-content">
            <div class="col l2 p-0">
               <div class="row valign-wrapper">
                  <div class="col l5">        
                     <img alt="" src="{{ asset('images/'.Str::lower($mval['Airline']['AirlineName']).'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
                  </div>
                  <div class="col l7 p-0">
                     <h6 class="p-0 black-text">{{ $mval['Airline']['AirlineName'] }}</h6>
                     <span>{{ $mval['Airline']['AirlineCode'] }} - {{ $mval['Airline']['FlightNumber'] }}</span>
                  </div>
               </div>
            </div>
            <div class="col l2 ">
               @php
               $departTime = $mval['Origin']['DepTime'];
               $departTime = explode('T',$departTime);
               $date = \Carbon\Carbon::parse($departTime[0]);
               $time = \Carbon\Carbon::parse($departTime[1]);
               @endphp
               <h6 class="black-text">{{ $time->format('g:i A') }}</h6>
               <small>{{ $mval['Origin']['Airport']['CityName'] }}</small>
            </div>
            <div class="col l2">
               @php
               $duration = $mval['Duration'];
               @endphp
               <u>
                 <h6 class="black-text"> {{ floor($duration / 60) }} hr, {{ ($duration -   floor($duration / 60) * 60) }} mins</h6>
               </u>
            </div>
            <div class="col l2">
               @php
               $departTime = $mval['Destination']['ArrTime'];
               $departTime = explode('T',$departTime);
               $date = \Carbon\Carbon::parse($departTime[0]);
               $time = \Carbon\Carbon::parse($departTime[1]);
               @endphp
               <h6 class="black-text">{{ $time->format('g:i A') }}</h6>
               <small>{{ $mval['Destination']['Airport']['CityName'] }}</small>
            </div>
            <div class="col l2">
               @php
               if($markupModel['amount_by'] == 'percent'){
               $amount = $record['Fare']['PublishedFare'];
              // echo ' % '. $percent = ($amount*$markupModel['plus_percent'])/100;
              $percent = ($amount*$markupModel['plus_percent'])/100;
               $amount = round($amount+$percent);
               }elseif($markupModel['amount_by'] == 'rupee'){
                  // echo 'am'. $markupModel['plus_amount'];
               $amount = round($record['Fare']['PublishedFare'] + $markupModel['plus_amount']);
               }else{
                  // echo "nor";
                  $amount = round($record['Fare']['PublishedFare']);
               }
               @endphp
               <h5 class="black-text">₹{{ $amount }}</h5>
            </div>
            @if($mkey ==0)
            <div class="col l2 action">
               <input type="hidden" value="one_way" name="trip_type" />
               <input type="hidden" value="{{ json_encode($record) }}" name="flight_details">
               <a href="javascript:void(0)" class="button btn border-round gradient-45deg-light-blue-cyan gradient-shadow mt10" onclick="document.getElementById('{{ $record['ResultIndex'] }}').submit()">Book</a>
            </div>
            @endif
         </div>
         @endforeach
         {!! Form::close() !!}
      </div>
      @else
      <div class="single_flight_details card border-radius-8 z-depth-4" data-airline="{{ $record['AirlineCode'] }}">
         <div class="row card-content">
            <div class="col l2 p-0">
               <div class="row valign-wrapper">
                  <div class="col l5">        
                     <img alt="" src="{{ asset('images/'.Str::lower($record['Segments'][0][0]['Airline']['AirlineName']).'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
                  </div>
                  <div class="col l7 p-0">
                     <h6 class="p-0 black-text">{{ $record['Segments'][0][0]['Airline']['AirlineName'] }}</h6>
                     <span>{{ $segment['Airline']['AirlineCode'] }} - {{ $segment['Airline']['FlightNumber'] }}</span>
                  </div>
               </div>
            </div>
            <div class="col l2 ">
               @php
              
               $departTime = $record['Segments'][0][0]['Origin']['DepTime'];
               $departTime = explode('T',$departTime);
               
               $date = \Carbon\Carbon::parse($departTime[0]);
               $time = \Carbon\Carbon::parse($departTime[1]);
               @endphp
               <h6 class="black-text">{{ $time->format('g:i A') }}</h6>
               <small>{{ $record['Segments'][0][0]['Origin']['Airport']['CityName'] }}</small>
            </div>
            <div class="col l2">
               @php
               $duration = $record['Segments'][0][0]['Duration'];
               @endphp
               <u>
                  <h6 class="black-text"> {{ floor($duration / 60) }} hr, {{ ($duration -   floor($duration / 60) * 60) }} mins</h6>
               </u>
            </div>
            <div class="col l2">
               @php
               $departTime = $record['Segments'][0][0]['Destination']['ArrTime'];
               $departTime = explode('T',$departTime);
               $date = \Carbon\Carbon::parse($departTime[0]);
               $time = \Carbon\Carbon::parse($departTime[1]);
               @endphp
               <h6 class="black-text">{{ $time->format('g:i A') }}</h6>
               <small>{{ $record['Segments'][0][0]['Destination']['Airport']['CityName'] }}</small>
            </div>
            <div class="col l2">
               @php

               $percent = null;
               if($markupModel['amount_by'] == 'percent'){
               $amount = $record['Fare']['PublishedFare'];
               $percent = ($amount*$markupModel['plus_percent'])/100;
                // echo ' % '. $percent = ($amount*$markupModel['plus_percent'])/100;
               $amount = round($amount+$percent);
               }elseif($markupModel['amount_by'] == 'rupee'){
                    // echo 'am'. $markupModel['plus_amount'];
               $plusAmt=  $markupModel['plus_amount'];   
               $amount = round($record['Fare']['PublishedFare'] + $markupModel['plus_amount']);
               }else{
                // echo "nor";
               $amount = round($record['Fare']['PublishedFare']);
               }
               @endphp
               <h5 class="black-text">₹{{ $amount }}</h5>
            </div>
            <div class="col l2 action">
               {!! Form::open(['route'=>'flight.details','id'=>'book_flight'.$loop->index]) !!}
               <input type="hidden" value="one_way" name="trip_type" />
               <input type="hidden" value="{{ json_encode($record) }}" name="flight_details">
               <a href="javascript:void(0)" class="button btn border-round gradient-45deg-light-blue-cyan gradient-shadow mt10" onclick="document.getElementById('book_flight{{ $loop->index }}').submit()">Book</a>
               {!! Form::close() !!}
            </div>
         </div>
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
                                            echo $time->format('l M d Y');
                                          @endphp
                                       <h5>
                                          {{ $segment['Origin']['Airport']['AirportCode'] }}
                                          @php
                                          $time = \Carbon\Carbon::parse($journeyDate[1]);
                                          echo $time->format('g:i A');
                                          @endphp
                                       </h5>
                                       <small>{{ $segment['Origin']['Airport']['AirportName'] }}</small>
                                    </div>
                                    <div class="col m4 l4">
                                       @php $duration = $record['Segments'][0][0]['Duration']; 
                                       @endphp
                                       <h5> {{ floor($duration / 60) }} hr, {{ ($duration -   floor($duration / 60) * 60) }} mins</h5>
                                       Flight Duration
                                    </div>
                                    <div class="col m4 l4">
                                          @php
                                            $journeyDate = explode('T',$segment['Destination']['ArrTime']);
                                            $time = \Carbon\Carbon::parse($journeyDate[0]);
                                            echo $time->format('l M d Y');
                                          @endphp
                                       <h5>
                                          {{ $segment['Destination']['Airport']['AirportCode'] }}
                                          @php
                                          $time = \Carbon\Carbon::parse($journeyDate[1]);
                                          echo $time->format('g:i A');
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

                                  @if(!empty($percent))

                                  <tr>
                                    <td>Service Charge</td>
                                    <td>₹{{ round($percent) }}</td>
                                 </tr>

                                  <tr>
                                    <td><b>Total Fare</b>
                                    </td>
                                    <td>₹{{ $record['Fare']['BaseFare']+$record['Fare']['Tax'] + round($percent) }}</td>
                                 </tr>
                                 @elseif(!empty($plusAmt))

                                  <tr>
                                    <td>Service Charge</td>
                                    <td>₹{{ round($plusAmt) }}</td>
                                 </tr>

                                  <tr>
                                    <td><b>Total Fare</b>
                                    </td>
                                    <td>₹{{ $record['Fare']['BaseFare']+$record['Fare']['Tax'] + round($plusAmt) }}</td>
                                 </tr>



                                 @else

                                  <tr>
                                    <td><b>Total Fare</b>
                                    </td>
                                    <td>₹{{ $record['Fare']['BaseFare']+$record['Fare']['Tax'] }}</td>
                                 </tr>

                                  @endif
                                
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
      @endif
      @endforeach
   </div>
   @endif
   @elseif(($tripType == 'multi_city'))
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

</style>
@endsection