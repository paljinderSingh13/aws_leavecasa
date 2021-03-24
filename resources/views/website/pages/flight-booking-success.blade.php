@extends('frontend.layout.materialize')
@section('content')    
    @php

        // $successResponse = session()->get('flight_success_data');

 
        // dump($successResponse);
            @endphp
    @foreach($ticket_data as $dkey => $successResponse)            
        @if(!empty($successResponse['Response']['Response']))

        
        
    <section id="content" class="gray-area">
        <div class="container">
            {{-- @foreach ($successResponse as $key => $successResponse)  --}}
             @if(!empty($successResponse['Response']['Error']['ErrorMessage']))
             @if($dkey<1)
                <div class="row">
                <div class="center-align white">
                 <img src="{{ asset('/images/not_found.gif') }}" class="bg-gif-404" alt="">
                <h2 class="error-code m-0">Sorry ! {{ $successResponse['Response']['Error']['ErrorMessage'] }}</h2>
                    <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back
                    TO Home</a>
                </div> 
                </div>
                @endif
              
            @elseif(!empty(@$successResponse['Response']['Response']['Message']) || @$successResponse['Response']['Response']['Message']=='Auto ticket not allowed by supplier')
                <div class="row">
                <div class="center-align white">
                 <img src="{{ asset('/images/not_found.gif') }}" class="bg-gif-404" alt="">
                <h2 class="error-code m-0">Sorry ! {{ @$successResponse['Response']['Response']['Message'] }}</h2>
                    <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back
                    TO Home</a>
                </div> 
                </div>
             @else
             @php
            $key=0;
            @endphp
             
            
             @if($key<1)
            <div class="row ">
                <div id="main" class="col l8 m12 card border-radius-8 z-depth-4">  
                    <div class="booking-information travelo-box card-content"> 
                    <h6>Booking Confirmation</h6>
                     <div class="booking-confirmation clearfix"> 
                        <i class="soap-icon-recommend icon circle"></i> 
                        <div class="message"> 
                            <h5 class="main-message">Thank You. Your Booking Order is Confirmed Now.</h5> 
                        </div> {{--    --}}
                    </div>
                </div> 
                <div class="row card-content">
                   @foreach($successResponse['Response']['Response']['FlightItinerary']['Segments'] as $skey => $sval)
                   @php
         $departTime = $sval['Origin']['DepTime'];
         $departTime = explode('T',$departTime);
         $date = \Carbon\Carbon::parse($departTime[0]);
         $time = \Carbon\Carbon::parse($departTime[1]);
         @endphp
         <h6>Trip : On {{  $date->format('d-m-Y') }} </h6>
         <div class="col l3 offset l1  p-0">
            <div class="row valign-wrapper">
               <div class="col l5">        
                  <img alt="" src="{{ asset('images/'.$sval['Airline']['AirlineName'].'.jpg') }}" class="responsive-img" style="height:50px; width:50px">
               </div>
               <div class="col l7 p-0">
                  <h6 class="p-0 black-text">{{ $sval['Airline']['AirlineName'] }}</h6>
                  <span>{{ $sval['Airline']['AirlineCode'] }} - {{ $sval['Airline']['FlightNumber'] }}</span>
               </div>
            </div>
         </div>
         <div class="col l2 ">
            @php
            $departTime = $sval['Origin']['DepTime'];
            $departTime = explode('T',$departTime);
            $date = \Carbon\Carbon::parse($departTime[0]);
            $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <h6 class="black-text"> {{ $time->format('g:i A') }}</h6>
            <small>{{ $sval['Origin']['Airport']['CityName'] }}</small>
         </div>
         <div class="col l2">
            @php
            $duration = $sval['Duration'];
            @endphp           
            <u>
               <h6 class="black-text"> {{ floor($duration / 60) }} hr, {{ ($duration -   floor($duration / 60) * 60) }} mins</h6>
            </u>
         </div>
         <div class="col l2">
            @php
            $departTime = $sval['Destination']['ArrTime'];
            $departTime = explode('T',$departTime);
            $date = \Carbon\Carbon::parse($departTime[0]);
            $time = \Carbon\Carbon::parse($departTime[1]);
            @endphp
            <h6 class="black-text">{{ $time->format('g:i A') }}</h6>
            <small>{{ $sval['Destination']['Airport']['CityName'] }}</small>
         </div>
                   @endforeach 
                </div>
                     <div class="row  card-content">
                        <h5>Traveler Information 
                        <u> Booking Id : {{ $successResponse['Response']['Response']['BookingId'] }} Fare: {{ $successResponse['Response']['Response']['BookingId']['InvoiceAmount'] }}  </u>

                   </h5>
                       <table class="card-content">
                        <thead>
                            <tr>
                                <th>Ticket No</th>
                                <th>Name</th>                                
                                <th>Gender</th>
                             </tr>   
                        </thead> 
                        <tbody> 
            @endif                
                                                 
                                @if(!empty($successResponse['Response']['Response']))
                                <p> {{ @$successResponse['Response']['Response']['Message']  }}</p>

                                    @if(!empty($successResponse['Response']['Response']['FlightItinerary']['Passenger']))                             
                                        @foreach($successResponse['Response']['Response']['FlightItinerary']['Passenger'] as $ikey => $passenger)
                                            <tr>
                                                <td>{{ @$passenger['Ticket']['TicketId'] }}</td>
                                                <td class="uc">{{ @$passenger['FirstName'] }}  {{ @$passenger['LastName'] }}</td>
                                                <td>{{ $passenger['PaxType']== 1 ? "Adult" : ($passenger['PaxType'] == 2 ? "Child" :"infant") }}</td>
                                            </tr>
                                        @endforeach
                                @endif
                                @endif

                        
                            </tbody>
                           
                        </table>
                        </div>
                       
                </div>
                {{-- </div> --}}
        @if($dkey<1)
                <div class="sidebar col l3 m3 s12 ml-1  card border-radius-8 z-depth-4">
                    <div class="row">
                    <div class="card-content">
                    <h5 class="black-text">Need Leavecasa Help?</h5>
                    <p>We offer so much more than just affordable packages and destination information.</p>                     
                    <address>
                        <span><i class="fas fa-phone mdb-text"></i> +91 8800023882</span>
                        <br />
                        <a href="#" class="mdb-text">info@leavecasa.com</a>
                    </address> 
                </div>
            </div>
                </div>
        @endif
            </div>

            
             <div class="row card border-radius-8 z-depth-4">
                <div class="card-content">
                            <h5>Fare Rules</h5>
                            <p class="card-content">{!! str_replace("\r\n",'<br/>', @$successResponse['Response']['Response']['FlightItinerary']['FareRules'][0]['FareRuleDetail']) !!}</p>
                            <br />
                      </div>  
                    </div>
                      
            @endif
       {{--  @endforeach --}}
        </div>
    </section>
    @else
    @if($dkey<1)
       <div class="row">
      <div class="center-align white">
      <img src="{{ asset('/images/not_found.gif') }}" class="bg-gif-404" alt="">
      <h4 class="error-code m-0">Sorry ! {{ $successResponse['Response']['Error']['ErrorMessage'] }}</h4>
      <a class="btn waves-effect waves-light mdb gradient-shadow mb-4" href="{{ route('index')}}">Back
        TO Home</a>
    </div> 
</div>
@endif 
    @endif
    @endforeach
@endsection