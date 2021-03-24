@extends('frontend.layout.materialize')
@section('content')
<section id="content ">
	<div class="row mdb p1 sticky"> 
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
	        </ul>@if($results['Response']['Error']['ErrorCode'] == 0)
            {!! Form::open(['route'=>'flight.details','id'=>'Rflight']) !!}
                <input type="hidden" value="round" name="trip_type" />
                <div class="row">
                  <div class="col l6 s6"><h6 class="ml3">Departure Flight</h6></div>
                  <div class="col l6 s6"><h6 class="ml3">Return Flight</h6></div>


                </div>
                <div class="row">
                 <div class="flight-list listing-style3 flight col l6  s6 p-1">

    @php

    $lowest_price_one = 10000000000000;
    $lowest_price_one_index ='';
    @endphp
  @foreach($results['Response']['Results'][0] as $key => $record)

    @php

    // dump($record);

   
    // @dump($record['ResultIndex']);
    // for($i=0;$i<=count($record);$i++)
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
         <img alt="" src="{{ asset('images/'.$mval['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px"></div>
         
        
      <div class="take-off col l3">
        <div class="row">
            @php
                $departTime = $mval['StopPointDepartureTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $mval['Origin']['Airport']['CityName']}}</span></div>

      </div>
      <div class="landing col l3">
        <div class="row">
            @php
                $departTime = $mval['StopPointArrivalTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $mval['Destination']['Airport']['CityName'] }}</span></div>
     </div>
     <div class="col l3"><span class="price">₹{{ $amount }}</span></div>
           
        </div>

    </div>


@endforeach




</div>
@else
<div class="card border-radius-8 z-depth-4" id="LeftCloneD{{ $key }}">
<div class="details  card-content" >
            
               <div class="action row">
                <label class="radio radio-inline">                   

                    <input type="radio" class="with-gap blue-text " id="{{ $key }}"  name="depart" value="{{ json_encode($record) }}" required="required" onclick="LeftCloneD(this.id)"><span class="black-text"> 

                     
                        {{ $segment['Airline']['AirlineName'] }} | 
                    {{ $segment['Airline']['AirlineCode'] }} - {{ $segment['Airline']['FlightNumber'] }}</span>
                </label>
            </div>

        <div class="row">
            <div class="col l3 p-0 ">
         <img alt="" src="{{ asset('images/'.$record['Segments'][0][0]['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px"></div>
         
        
      <div class="take-off col l3">
        <div class="row">
            @php
                $departTime = $record['Segments'][0][0]['StopPointDepartureTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $segment['Origin']['Airport']['CityName']}}</span></div>

      </div>
      <div class="landing col l3">
        <div class="row">
            @php
                $departTime = $record['Segments'][0][0]['StopPointArrivalTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
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


   {{-- lowest price {{  $lowest_price_one}} 
    lowest index  --}}
    @php

    echo "<script> $('#ob".$lowest_price_one_index."').attr('checked', true); 

     </script>";
    // dump( $results['Response']['Results'][0][$lowest_price_one_index]);

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
         <img alt="" src="{{ asset('images/'.$mval['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px"></div>
         
        
      <div class="take-off col l3">
        <div class="row">
            @php
                $departTime = $mval['StopPointDepartureTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $mval['Origin']['Airport']['CityName']}}</span></div>

      </div>
      <div class="landing col l3">
        <div class="row">
            @php
                $departTime = $mval['StopPointArrivalTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $mval['Destination']['Airport']['CityName'] }}</span></div>
     </div>
     <div class="col l3"><span class="price">₹{{ $amount }}</span></div>
           
        </div>

    </div>


@endforeach
</div>

@else
<div class="card border-radius-8 z-depth-4" id="RightCloneD{{ $key }}">
<div class="details card-content">
              <div class="action row">
                <label class="radio radio-inline">
                    <input type="radio" id="{{ $key }}" name="return" value="{{ json_encode($record) }}" required="required" class="with-gap "  onclick="RightCloneD(this.id)"><span class=black-text> {{ $segment['Airline']['AirlineName'] }} | 
                    {{ $segment['Airline']['AirlineCode'] }} - {{ $segment['Airline']['FlightNumber'] }}</span>
                </label>
            </div>
            
            {{-- <a class="button btn-mini stop">1 STOP</a> --}}
        <div class="row">
            <div class="col l3">
            <img alt="" src="{{ asset('images/'.$record['Segments'][0][0]['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
             
        </div>
            <div class="take-off col l3">
                <div class="row">
                   @php
                    $departTime = $record['Segments'][0][0]['StopPointDepartureTime'];
                    $departTime = explode('T',$departTime);
                    $date = \Carbon\Carbon::parse($departTime[0]);
                    $time = \Carbon\Carbon::parse($departTime[1]);
                    @endphp
                    <span class="skin-color">{{ $time->format('g:i A') }}</span></div>
                    <div class="row"><span>{{ $segment['Origin']['Airport']['CityName']}}</span></div>
            </div>
            <div class="landing col l3">
                <div class="row">
                    @php
                    $departTime = $record['Segments'][0][0]['StopPointArrivalTime'];
                    $departTime = explode('T',$departTime);
                    $date = \Carbon\Carbon::parse($departTime[0]);
                    $time = \Carbon\Carbon::parse($departTime[1]);
                    @endphp
                    <span class="skin-color"> {{ $time->format('g:i A') }}</span></div>
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

    // echo "<script> $('#ib".$lowest_price_one_index."').attr('checked', true);  </script>";
    // dump( $results['Response']['Results'][0][$lowest_price_one_index]);

    @endphp
            </div>
         
            {!! Form::close() !!}
        @endif
	    </div> 
	</div>

</section>

@if($results['Response']['Error']['ErrorCode'] == 0)
            {!! Form::open(['route'=>'flight.details','id'=>'Rflight']) !!}
                <input type="hidden" value="round" name="trip_type" />
                <div class="row">
                  <div class="col l6 s6"><h6 class="ml3">Departure Flight</h6></div>
                  <div class="col l6 s6"><h6 class="ml3">Return Flight</h6></div>


                </div>
                <div class="row">
                 <div class="flight-list listing-style3 flight col l6  s6 p-1">

    @php

    $lowest_price_one = 10000000000000;
    $lowest_price_one_index ='';
    @endphp
  @foreach($results['Response']['Results'][0] as $key => $record)

    @php

    // dump($record);

   
    // @dump($record['ResultIndex']);
    // for($i=0;$i<=count($record);$i++)
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
         <img alt="" src="{{ asset('images/'.$mval['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px"></div>
         
        
      <div class="take-off col l3">
        <div class="row">
            @php
                $departTime = $mval['StopPointDepartureTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $mval['Origin']['Airport']['CityName']}}</span></div>

      </div>
      <div class="landing col l3">
        <div class="row">
            @php
                $departTime = $mval['StopPointArrivalTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $mval['Destination']['Airport']['CityName'] }}</span></div>
     </div>
     <div class="col l3"><span class="price">₹{{ $amount }}</span></div>
           
        </div>

    </div>


@endforeach




</div>
@else
<div class="card border-radius-8 z-depth-4" id="LeftCloneD{{ $key }}">
<div class="details  card-content" >
            
               <div class="action row">
                <label class="radio radio-inline">                   

                    <input type="radio" class="with-gap blue-text " id="{{ $key }}"  name="depart" value="{{ json_encode($record) }}" required="required" onclick="LeftCloneD(this.id)"><span class="black-text"> 

                     
                        {{ $segment['Airline']['AirlineName'] }} | 
                    {{ $segment['Airline']['AirlineCode'] }} - {{ $segment['Airline']['FlightNumber'] }}</span>
                </label>
            </div>

        <div class="row">
            <div class="col l3 p-0 ">
         <img alt="" src="{{ asset('images/'.$record['Segments'][0][0]['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px"></div>
         
        
      <div class="take-off col l3">
        <div class="row">
            @php
                $departTime = $record['Segments'][0][0]['StopPointDepartureTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $segment['Origin']['Airport']['CityName']}}</span></div>

      </div>
      <div class="landing col l3">
        <div class="row">
            @php
                $departTime = $record['Segments'][0][0]['StopPointArrivalTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
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


   {{-- lowest price {{  $lowest_price_one}} 
    lowest index  --}}
    @php

    echo "<script> $('#ob".$lowest_price_one_index."').attr('checked', true); 

     </script>";
    // dump( $results['Response']['Results'][0][$lowest_price_one_index]);

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
         <img alt="" src="{{ asset('images/'.$mval['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px"></div>
         
        
      <div class="take-off col l3">
        <div class="row">
            @php
                $departTime = $mval['StopPointDepartureTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $mval['Origin']['Airport']['CityName']}}</span></div>

      </div>
      <div class="landing col l3">
        <div class="row">
            @php
                $departTime = $mval['StopPointArrivalTime'];
                $departTime = explode('T',$departTime);
                $date = \Carbon\Carbon::parse($departTime[0]);
                $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <span class="skin-color"><span>{{ $time->format('g:i A') }}</span></div>
            <div class="row"><span>{{ $mval['Destination']['Airport']['CityName'] }}</span></div>
     </div>
     <div class="col l3"><span class="price">₹{{ $amount }}</span></div>
           
        </div>

    </div>


@endforeach
</div>

@else
<div class="card border-radius-8 z-depth-4" id="RightCloneD{{ $key }}">
<div class="details card-content">
              <div class="action row">
                <label class="radio radio-inline">
                    <input type="radio" id="{{ $key }}" name="return" value="{{ json_encode($record) }}" required="required" class="with-gap "  onclick="RightCloneD(this.id)"><span class=black-text> {{ $segment['Airline']['AirlineName'] }} | 
                    {{ $segment['Airline']['AirlineCode'] }} - {{ $segment['Airline']['FlightNumber'] }}</span>
                </label>
            </div>
            
            {{-- <a class="button btn-mini stop">1 STOP</a> --}}
        <div class="row">
            <div class="col l3">
            <img alt="" src="{{ asset('images/'.$record['Segments'][0][0]['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
             
        </div>
            <div class="take-off col l3">
                <div class="row">
                   @php
                    $departTime = $record['Segments'][0][0]['StopPointDepartureTime'];
                    $departTime = explode('T',$departTime);
                    $date = \Carbon\Carbon::parse($departTime[0]);
                    $time = \Carbon\Carbon::parse($departTime[1]);
                    @endphp
                    <span class="skin-color">{{ $time->format('g:i A') }}</span></div>
                    <div class="row"><span>{{ $segment['Origin']['Airport']['CityName']}}</span></div>
            </div>
            <div class="landing col l3">
                <div class="row">
                    @php
                    $departTime = $record['Segments'][0][0]['StopPointArrivalTime'];
                    $departTime = explode('T',$departTime);
                    $date = \Carbon\Carbon::parse($departTime[0]);
                    $time = \Carbon\Carbon::parse($departTime[1]);
                    @endphp
                    <span class="skin-color"> {{ $time->format('g:i A') }}</span></div>
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

    // echo "<script> $('#ib".$lowest_price_one_index."').attr('checked', true);  </script>";
    // dump( $results['Response']['Results'][0][$lowest_price_one_index]);

    @endphp
            </div>
         
            {!! Form::close() !!}
        @endif


<?php

dd('domestic round', $results);

?>