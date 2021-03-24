@extends('frontend.layout.materialize')
@section('content')

@php

// dd(Auth::guard('customer')->check());

// dd($request_data);
//dump($fare_rule);

//dump(Session::get('search_request'));
$session_value=Session::get('search_request');
@endphp
<section id="content">
<div class="row mdb p1 sticky"> 


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    
@endif
@php
 
   
    @endphp
<div class="col offset-l1 l5 s12">
    <p class="f28w100 white-text mt0 mb0">Review Your booking </p>
</div>
<div class="col l5 p0 hide-on-med-and-down">
    <ul class="stepper horizontal">
        <li class="step active blue-text">
            <div class="step-title waves-effect">Flight Select</div>
        </li>
        <li class="step active blue-text">
            <div class="step-title waves-effect">Review</div>
        </li>
        <li class="step">
            <div class="step-title waves-effect">Make Payment</div>
        </li>
    </ul>
</div> 
</div>
<div class="container flight-detail-page ">
<div class="row">

  
@if(!Auth::guard('customer')->check())

@if($errors->any())
    <div class="col l8 m9 s12"> {{-- @php dump($errors); @endphp --}}
    <h4 class="red-text">{{$errors->first()}}</h4>

    </div>
@endif

<script type="text/javascript">
    
    function openSignup(){
        regist = document.getElementById('reg');
        login = document.getElementById('login-form');
        login.style.display  = "none";
        regist.style.display = "block";
    }

     function openLogin(){
        regist = document.getElementById('reg');
        login = document.getElementById('login-form');
        login.style.display  = "block";
        regist.style.display = "none";
    }
</script>

<div class="col s6 card offset-s3"> 


<div id="login-form"> 
      <h4 class="center"> Login</h4>
    <form method="post" action="{{ route('login.customer') }}">
            {{csrf_field()}}
        <input type="hidden" name="redirect" value="{{ route('flight.details') }}">
        <input type="text" name="email">
        <input type="password" name="password">
           <button class="btn li-red" type="submit" name="action"> Login
    <i class="material-icons right">send</i>
  </button>
    </form>
    <a onclick="openSignup()" id="signup"> Sign up</a>
</div>

<div id="reg" style="display: none">
    <h4 class="center"> Sign Up</h4>

    <form method="post" action="{{ route('cust.reg') }}">
        {{ csrf_field() }}

  <div class="row">
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">person</i>
          <input class="black-text" id="name"  name="name" type="text"  >
          <label for="name">Name</label>
        </div>
      </div>

    <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">email</i>
          <input class="black-text" name="email"  type="text"  >
          <label class="black-text" for="email">email</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
          <input class="black-text" name="password"  type="password" class="validate">
          <label class="black-text" for="password">Password</label>
        </div>
      </div>


       <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">phone</i>
          <input class="black-text" id="phone"  name="mobile" type="text" class="validate">
          <label class="black-text" for="phone"> Phone</label>
        </div>
      </div>

       <button class="btn li-red" type="submit" name="action">Sign Up
    <i class="material-icons right">send</i>
  </button>


        <a onclick="openLogin()" id=""> login</a>
    </div>
  </div>
</form>
{{-- 
 <input type="text" name="email">
<input type="password" name="password"> --}}


</div>
</div>





@else

    <div id="main" class="col l8 m9 s12 ">
        <div class="row"><h5 class="mdb-text ml2">Flight Details</h5></div>
        @if($request_data['trip_type'] == 'round')
        @php
        $flightOne = json_decode(session()->get('flight_one'),true);
        //dump($flightOne);
        $flightTwo = json_decode(session()->get('flight_two'),true);
        //dump($flightTwo);
        @endphp

        <div class="row card border-radius-8 z-depth-4">
            <div class="col l4 mc1 mdb ">
                <table id="pag" class="card-content white-text ">
                    <tr>
                        <td>Airline:</td>
                        <td>{{ $flightOne['Segments'][0][0]['Airline']['AirlineName'] }}</td>
                    </tr>
                    <tr>
                        <td>Flight Type:</td>
                        <td>{{ $flightOne['Segments'][0][0]['Airline']['FareClass'] }}</td>
                    </tr>
                    <tr>
                        <td>Fare type:</td>
                        <td>{{ $flightOne['IsRefundable'] == true ? 'Refundable':'Non-Refundable' }}</td>
                    </tr>
                    <tr>
                        <td>Baggage:</td>
                        <td>{{ $flightOne['Segments'][0][0]['CabinBaggage'] }}</td>
                    </tr>
                    <tr>
                        <td>Inflight Features:</td>
                        <td>Available</td>
                    </tr>
                    <tr>
                        <td>Base fare:</td>
                        <td>&#8377;{{ $flightOne['Fare']['BaseFare'] }}</td>
                    </tr>
                    <tr>
                        <td>Taxes &amp; Fees:</td>
                        <td>&#8377;{{ $flightOne['Fare']['Tax'] }}</td>
                    </tr>
                    <tr>
                        <td>Total price:</td>
                        <td>&#8377;{{ $flightOne['Fare']['PublishedFare'] }}</td>
                    </tr>
                </table>                
            </div>
            <div class="col l7 m12">
                <div class="row">
                  {{--   <a href="#" class="btn pills mdb valign right mt1">1 STOP</a> --}}
                    <h5 class="valign left">{{ $flightOne['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightOne['Segments'][0][count($flightOne['Segments'][0])-1]['Destination']['Airport']['CityName'] }}</h5></div>
                    <div class="row">
                        <span class="uc blue-text">Oneway flight</span></div>
                        <div class="row mt3">
                            @foreach($flightOne['Segments'][0] as $key => $flightDetails)
                            <div class="col l3">
                                <span class="fs14">{{ $flightDetails['Airline']['AirlineCode'] }}-{{ $flightDetails['Airline']['FlightNumber'] }} {{ $flightDetails['Airline']['FareClass'] }}</span>
                            </div>
                            <div class="col l3 check-in">
                                <div class="row">
                                    <label class="blue-text">Take off</label></div>
                                    <div class="row">
                                        @php
                                        $departDateTime = explode('T',$flightDetails['Origin']['DepTime']);
                                        $parsedDateTime = \Carbon\Carbon::parse($departDateTime[0].' '.$departDateTime[1]);
                                        $arrivalDateTime = explode('T',$flightDetails['Destination']['ArrTime']);
                                        $parsedArrivalTime = \Carbon\Carbon::parse($arrivalDateTime[0].' '.$arrivalDateTime[1]);
                                       $durate=$flightDetails['Duration'];
                                        @endphp
                                        <span class="fs15"> {{ $parsedDateTime->format('h:i a') }} </span>  </div>
                                    </div>
                                    <div class="col l3 valign center">
                                        <div class="row">
                                        <i class="material-icons tiny">access_time</i></div>

                                        <span class="fs15">{{ floor($durate / 60) }}h, {{ ($durate -   floor($durate / 60) * 60) }}m</span>
                                    </div>
                                    <div class="col l3 check-out">
                                        <div class="row">
                                            <label class="blue-text">landing</label></div>
                                            <div class="row">
                                                 {{ $parsedArrivalTime->format('h:i a') }} </span></div>
                                            </div>
                                            @if(count($flightOne['Segments'][0])>1)
                                            <label class="layover">Layover : {{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </label>
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="row mt5 ">
                                            <span class="badage  gradient-45deg-light-blue-cyan gradient-shadow p1">Date : {{ $parsedDateTime->format('d') }} {{ $parsedDateTime->format('M') }} {{ $parsedDateTime->format('Y') }} </span>
                                        </div>
                                    </div>

        </div>
        <div class="row card border-radius-8 z-depth-4">
            <div class="col l4 p1 mc1 mdb ">
                <table id="pag" class="card-content white-text">
                    <tr>
                        <td>Airline:</td>
                        <td>{{ $flightTwo['Segments'][0][0]['Airline']['AirlineName'] }}</td>
                    </tr>
                    <tr>
                        <td>Flight Type:</td>
                        <td>{{ $flightTwo['Segments'][0][0]['Airline']['FareClass'] }}</td>
                    </tr>
                    <tr>
                        <td>Fare type:</td>
                        <td>{{ $flightTwo['IsRefundable'] == true ? 'Refundable':'Non-Refundable' }}</td>
                    </tr>
                    <tr>
                        <td>Baggage:</td>
                        <td>{{ $flightTwo['Segments'][0][0]['CabinBaggage'] }}</td>
                    </tr>
                    <tr>
                        <td>Inflight Features:</td>
                        <td>Available</td>
                    </tr>
                    <tr>
                        <td>Base fare:</td>
                        <td>&#8377;{{ $flightTwo['Fare']['BaseFare'] }}</td>
                    </tr>
                    <tr>
                        <td>Taxes &amp; Fees:</td>
                        <td>&#8377;{{ $flightTwo['Fare']['Tax'] }}</td>
                    </tr>
                    <tr>
                        <td>Total price:</td>
                        <td>&#8377;{{ $flightTwo['Fare']['PublishedFare'] }}</td>
                    </tr>
                </table>                
            </div>
            <div class="col l7 m12">
                <div class="row">
                    {{-- <a href="#" class="btn pills mdb valign right mt1">1 STOP</a> --}}
                    <h5 class="valign left">{{ $flightTwo['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightTwo['Segments'][0][count($flightTwo['Segments'][0])-1]['Destination']['Airport']['CityName'] }}</h5></div>
                    <div class="row">
                        <span class="uc blue-text">Oneway flight</span></div>
                        <div class="row mt3">
                            @foreach($flightTwo['Segments'][0] as $key => $flightDetails)
                            <div class="col l3">
                                <span class="fs14">{{ $flightDetails['Airline']['AirlineCode'] }}-{{ $flightDetails['Airline']['FlightNumber'] }} {{ $flightDetails['Airline']['FareClass'] }}</span>
                            </div>
                            <div class="col l3 check-in">
                                <div class="row">
                                    <label class="blue-text">Take off</label></div>
                                    <div class="row">
                                        @php
                                        $departDateTime = explode('T',$flightDetails['Origin']['DepTime']);
                                        $parsedDateTime = \Carbon\Carbon::parse($departDateTime[0].' '.$departDateTime[1]);
                                        $arrivalDateTime = explode('T',$flightDetails['Destination']['ArrTime']);
                                        $parsedArrivalTime = \Carbon\Carbon::parse($arrivalDateTime[0].' '.$arrivalDateTime[1]);
                                        $durate=$flightDetails['Duration'];
                                        @endphp

                                        <span class="fs15"> {{ $parsedDateTime->format('h:i a') }} </span>  </div>
                                    </div>
                                    <div class="col l3 valign center">
                                        <div class="row">
                                        <i class="material-icons tiny">access_time</i></div>
                                      <span class="fs15">{{ floor($durate / 60) }}h, {{ ($durate -   floor($durate / 60) * 60) }}m</span> 
                                    </div>
                                    <div class="col l3 check-out">
                                        <div class="row">
                                            <label class="blue-text">landing</label></div>
                                            <div class="row">
                                                 {{ $parsedArrivalTime->format('h:i a') }} </span></div>
                                            </div>
                                            @if(count($flightTwo['Segments'][0])>1)
                                            @endif
                                            @endforeach
                                        </div>                                            <label class="layover">Layover : {{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </label>

                                        <div class="row mt5">
                                            <span class="badage  gradient-45deg-light-blue-cyan gradient-shadow p1">Date : {{ $parsedDateTime->format('d') }} {{ $parsedDateTime->format('M') }} {{ $parsedDateTime->format('Y') }} </span>
                                        </div>
                                    </div>
        </div>
      
        {!! Form::open(['route'=>'book.customer.flight.now']) !!}
<div class="row card border-radius-8 z-depth-4">
     <div class="col 12 card-content">
        <h5>Passengers Details</h5>
        <div class="row lform">
            <div class="col l12" style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                
  @foreach($request_data['ResultIndex'] as $rkey => $rvalue)

    @php

       // dump($rvalue);
    @endphp
  <input type="hidden" name="resultIndex[]" value="{{ $rvalue }}">                               
  @endforeach
                @php
                $adults = $request_data['adult'];
                $child = $request_data['child'];
                $infant = $request_data['infants'];
                $total = $adults + $child + $infant;
                @endphp
                @for($i = 0; $i < $adults; $i++)
                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Adult {{ $i + 1 }}</h6>
                    <div class="row lform">
                        
                        <input type="hidden" name="PaxType[]" value="1">
                        @if($i=='0')
                        <input type="hidden" name="IsLeadPax[]" value="true">
                        @else
                        <input type="hidden" name="IsLeadPax[]" value="false">
                        @endif
                          <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'first','required']) !!}
                            <label for="first">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'last','required']) !!}
                            <label for="last">Last name:</label></div>
                        </div>
                    
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dob','required']) !!}
                            <label for="dob ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">{!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>


                   @if(!Session::has('domestic')) 
                    <div class="col l3 lform" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNum']) !!}
                            <label for="pasNum">Passport Number:</label></div>
                        </div>

                         <div class="col l3 lform" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'ed']) !!}
                            <label for="ed ">Passport Expire:</label></div>
                        </div>

                    {{-- @elseif($lcc && in_array($airline , ['bhutan', 'spicejet', 'indigo']) && $destination !='Nepal' ) --}}
                        
                    @endif
                        </div>
                </div>
                @endfor
                <div class="row"  style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                @for($i = 0; $i < $child; $i++)
                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Children {{ $i + 1 }}</h6>
                    <input type="hidden" name="PaxType[]" value="2">
                    <input type="hidden" name="IsLeadPax[]" value="false">
                    <div class="row lform">
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Ms'=>'Ms','CHD'=>'CHD'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'firstc','required']) !!}
                            <label for="firstc">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'lastc','required']) !!}
                            <label for="lastc">Last name:</label></div>
                        </div>               
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dobc','required']) !!}
                            <label for="dobc ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>
                        @if(!Session::has('domestic')) 
                    <div class="col l3 lform" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNumc']) !!}
                            <label for="pasNumc">Passport Number:</label></div>
                        </div>

                         <div class="col l3 lform" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'edc']) !!}
                            <label for="edc ">Passport Expire:</label></div>
                        </div>
                    @endif
                   </div>
                </div>
                @endfor
            </div>
            <div class="row"  style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                @for($i = 0; $i < $infant; $i++)

                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Infant {{ $i + 1 }}</h6>
                    <input type="hidden" name="PaxType[]" value="3">
                    <input type="hidden" name="IsLeadPax[]" value="false">
                    <div class="row lform">
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Ms'=>'Ms','CHD'=>'CHD'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'firsti','required']) !!}
                            <label for="firsti">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'lasti','required']) !!}
                            <label for="lasti">Last name:</label></div>
                        </div>               
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dobi','required']) !!}
                            <label for="dobi ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>
                       @if(!Session::has('domestic')) 
                    <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNum']) !!}
                            <label for="pasNum">Passport Number:</label></div>
                        </div>

                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'edi']) !!}
                            <label for="edi ">Passport Expire:</label></div>
                        </div>
                    @endif
                   </div>
                  </div>
                @endfor
            </div>
            </div>

            <div class="col l12" style="margin-top: 2%;">
                <div class="row lform">
                    <div class="col l6">
                        <div class="input-field">
                           {!! Form::email('email',null,['class'=>'form-control','id'=>'Remail','required']) !!}
                            <label for="Remail">Email:</label>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="input-field">
                           {!! Form::text('contact',null,['class'=>'form-control','id'=>'contact','pattern'=>'[1-9]{1}[0-9]{9}','maxLength'=>'10','required']) !!}
                            <label for="contact">Contact</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l6 lform">
                <div class="input-field">
                        {!! Form::text('AddressLine1',null,['class'=>'form-control','id'=>'address']) !!}
                        <label for="address">Address</label>
                        </div>
            </div>
            <div class="col l6">
                <button class="btn mdb valign right">Proceed To Payment</button>
            </div>
        </div>
       
    </div>
</div>
{!! Form::close() !!}
        @elseif($request_data['trip_type'] == 'one_way')
        @php
        $flightData = json_decode(session()->get('selected_flight'),true);
        @endphp

        <div class="row card border-radius-8 z-depth-4">
            <div class="col l4 p1 ">
                <table id="pag" class="card-content white-text mdb border-radius-8">
                    <tr>
                        <td>Airline:</td>
                        <td>{{ $flightData['Segments'][0][0]['Airline']['AirlineName'] }}</td>
                    </tr>
                    <tr>
                        <td>Flight Type:</td>
                        <td>{{ $flightData['Segments'][0][0]['Airline']['FareClass'] }}</td>
                    </tr>
                    <tr>
                        <td>Fare type:</td>
                        <td>{{ $flightData['IsRefundable'] == true ? 'Refundable':'Non-Refundable' }}</td>
                    </tr>
                    <tr>
                        <td>Baggage:</td>
                        <td>{{ $flightData['Segments'][0][0]['CabinBaggage'] }}</td>
                    </tr>
                    <tr>
                        <td>Inflight Features:</td>
                        <td>Available</td>
                    </tr>
                    <tr>
                        <td>Base fare:</td>
                        <td>&#8377;{{ $flightData['Fare']['BaseFare'] }}</td>
                    </tr>
                    <tr>
                        <td>Taxes &amp; Fees:</td>
                        <td>&#8377;{{ $flightData['Fare']['Tax'] }}</td>
                    </tr>
                    <tr>
                        <td>Total price:</td>
                        <td>&#8377;{{ $flightData['Fare']['PublishedFare'] }}</td>
                    </tr>
                </table>                
            </div>
            <div class="col l8 m12">
                <div class="row">
{{--                    <a href="#" class="btn pills mdb valign right mt1">1 STOP</a> --}}
                    <h5 class="valign left">{{ $flightData['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightData['Segments'][0][count($flightData['Segments'][0])-1]['Destination']['Airport']['CityName'] }}</h5></div>
                    <div class="row">
                        <span class="uc blue-text">Oneway flight</span></div>
                        <div class="row mt3">
                            @foreach($flightData['Segments'][0] as $key => $flightDetails)
                            <div class="col l3">
                                <span class="fs14">{{ $flightDetails['Airline']['AirlineCode'] }}-{{ $flightDetails['Airline']['FlightNumber'] }} {{ $flightDetails['Airline']['FareClass'] }}</span>
                            </div>
                            <div class="col l3 check-in">
                                <div class="row">
                                    <label class="blue-text">Take off</label></div>
                                    <div class="row">
                                        @php
                                        $departDateTime = explode('T',$flightDetails['Origin']['DepTime']);
                                        $parsedDateTime = \Carbon\Carbon::parse($departDateTime[0].' '.$departDateTime[1]);
                                        $arrivalDateTime = explode('T',$flightDetails['Destination']['ArrTime']);
                                        $parsedArrivalTime = \Carbon\Carbon::parse($arrivalDateTime[0].' '.$arrivalDateTime[1]);
                                        @endphp
                                        <span class="fs15"> {{ $parsedDateTime->format('h:i a') }} </span>  </div>
                                    </div>
                                    <div class="col l3 valign center">
                                        <div class="row">
                                        <i class="material-icons tiny">access_time</i></div>
                                        <span class="fs15">{{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </span>
                                    </div>
                                    <div class="col l3 check-out">
                                        <div class="row">
                                            <label class="blue-text">landing</label></div>
                                            <div class="row">
                                                 {{ $parsedArrivalTime->format('h:i a') }} </span></div>
                                            </div>
                                            @if(count($flightData['Segments'][0])>1)
                                            <label class="layover">Layover : {{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </label>
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="row mt5 ">
                                            <span class="badage  gradient-45deg-light-blue-cyan gradient-shadow p1">Date : {{ $parsedDateTime->format('d') }} {{ $parsedDateTime->format('M') }} {{ $parsedDateTime->format('Y') }} </span>
                                        </div>
                                    </div>
                                </div>
                              
                                {!! Form::open(['route'=>'book.customer.flight.now']) !!}
<div class="row card border-radius-8 z-depth-4">
     <div class="col 12 card-content">
        <h5>Passengers Details</h5>
        <div class="row lform">
            <div class="col l12" style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">


                <input type="hidden" name="ResultIndex" value="{{ @$request_data['ResultIndex'] }}">

                @php
                $adults = $request_data['adult'];
                $child = $request_data['child'];
                $infant = $request_data['infants'];
                $total = $adults + $child + $infant;
                @endphp
                @for($i = 0; $i < $adults; $i++)
                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Adult {{ $i + 1 }}</h6>
                    <div class="row lform">
                        <input type="hidden" name="PaxType[]" value="1">
                        @if($i=='0')
                        <input type="hidden" name="IsLeadPax[]" value="true">
                        @else
                        <input type="hidden" name="IsLeadPax[]" value="false">
                        @endif
                          <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'first','required']) !!}
                            <label for="first">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'last','required']) !!}
                            <label for="last">Last name:</label></div>
                        </div>
                    
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dob','required']) !!}
                            <label for="dob ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">{!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>


                   @if(!Session::has('domestic')) 
                    <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNum']) !!}
                            <label for="pasNum">Passport Number:</label></div>
                        </div>

                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'ed']) !!}
                            <label for="ed ">Passport Expire:</label></div>
                        </div>

                    {{-- @elseif($lcc && in_array($airline , ['bhutan', 'spicejet', 'indigo']) && $destination !='Nepal' ) --}}
                        
                    @endif
                        </div>
                </div>
                @endfor
                <div class="row"  style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                @for($i = 0; $i < $child; $i++)
                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Children {{ $i + 1 }}</h6>
                    <input type="hidden" name="PaxType[]" value="2">
                    <input type="hidden" name="IsLeadPax[]" value="false">
                    <div class="row lform">
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Ms'=>'Ms','CHD'=>'CHD'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'firstc','required']) !!}
                            <label for="firstc">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'lastc','required']) !!}
                            <label for="lastc">Last name:</label></div>
                        </div>               
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dobc','required']) !!}
                            <label for="dobc ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>
                        @if(!Session::has('domestic')) 
                    <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNumc']) !!}
                            <label for="pasNumc">Passport Number:</label></div>
                        </div>

                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'edc']) !!}
                            <label for="edc ">Passport Expire:</label></div>
                        </div>
                    @endif
                   </div>
                </div>
                @endfor
            </div>
            <div class="row"  style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                @for($i = 0; $i < $infant; $i++)

                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Infant {{ $i + 1 }}</h6>
                    <input type="hidden" name="PaxType[]" value="3">
                    <input type="hidden" name="IsLeadPax[]" value="false">
                    <div class="row lform">
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Ms'=>'Ms','CHD'=>'CHD'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'firsti','required']) !!}
                            <label for="firsti">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'lasti','required']) !!}
                            <label for="lasti">Last name:</label></div>
                        </div>               
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dobi','required']) !!}
                            <label for="dobi ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>
                       @if(!Session::has('domestic')) 
                    <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNumi']) !!}
                            <label for="pasNumi">Passport Number:</label></div>
                        </div>

                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'edi']) !!}
                            <label for="edi ">Passport Expire:</label></div>
                        </div>
                    @endif
                   </div>
                  </div>
                @endfor
            </div>
            </div>

            <div class="col l12" style="margin-top: 2%;">
                <div class="row lform">
                    <div class="col l6">
                        <div class="input-field">
                           {!! Form::email('email',null,['class'=>'form-control','id'=>'Oemail','required']) !!}
                            <label for="Oemail">Email:</label>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="input-field">
                           {!! Form::text('contact',null,['class'=>'form-control','id'=>'contact','pattern'=>'[1-9]{1}[0-9]{9}','maxLength'=>'10','required']) !!}
                            <label for="contact">Contact</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l4 lform">
                <div class="input-field">
                        {!! Form::text('AddressLine1',null,['class'=>'form-control','id'=>'address']) !!}
                        <label for="address">Address</label>
                        </div>
            </div>
            <div class="col l4">
                @php

                $wallet_balance = (int)App\Helpers\PaymentProcess::wallet_balance();

             

                @endphp

                @if($wallet_balance > $flightData['Fare']['PublishedFare'])

                <input type="hidden" name="wallet_balance" value="{{ $wallet_balance }}">

                <input type="submit" name="use_wallet" class="btn mdb " value="Use wallet balance">

                @endif
            </div>
               <div class="col l4">

                <button class="btn mdb ">Proceed To Payment</button>
            </div>
        </div>
       
    </div>
</div>
{!! Form::close() !!}
@elseif($request_data['trip_type'] == 'multi_city')
{!! Form::open(['route'=>'book.customer.flight.now']) !!}
<div class="row card border-radius-8 z-depth-4">
     <div class="col 12 card-content">
        <h5>Passengers Details</h5>
        <div class="row lform">
            <div class="col l12" style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                <input type="hidden" name="ResultIndex" value="{{ $request_data['ResultIndex'] }}">
                <!-- <input type="text" name="IsLeadPax" value="{{ $request_data['ResultIndex'] }}"> -->

                @php
                $adults = $request_data['adult'];
                $child = $request_data['child'];
                $infant = $request_data['infants'];
                $total = $adults + $child + $infant;
                @endphp
                @for($i = 0; $i < $adults; $i++)
                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Adult {{ $i + 1 }}</h6>
                    <div class="row lform">
                        <input type="hidden" name="PaxType[]" value="1">
                        @if($i=='0')
                        <input type="hidden" name="IsLeadPax[]" value="true">
                        @else
                        <input type="hidden" name="IsLeadPax[]" value="false">
                        @endif
                          <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'first','required']) !!}
                            <label for="first">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'last','required']) !!}
                            <label for="last">Last name:</label></div>
                        </div>
                    
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dob','required']) !!}
                            <label for="dob ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">{!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>


                   @if(!Session::has('domestic')) 
                    <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNum']) !!}
                            <label for="pasNum">Passport Number:</label></div>
                        </div>

                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'ed']) !!}
                            <label for="ed ">Passport Expire:</label></div>
                        </div>

                    {{-- @elseif($lcc && in_array($airline , ['bhutan', 'spicejet', 'indigo']) && $destination !='Nepal' ) --}}
                        
                    @endif
                        </div>
                </div>
                @endfor
                <div class="row"  style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                @for($i = 0; $i < $child; $i++)
                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Children {{ $i + 1 }}</h6>
                    <input type="hidden" name="PaxType[]" value="2">
                    <input type="hidden" name="IsLeadPax[]" value="false">
                    <div class="row lform">
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Ms'=>'Ms','CHD'=>'CHD'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'firstc','required']) !!}
                            <label for="firstc">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'lastc','required']) !!}
                            <label for="lastc">Last name:</label></div>
                        </div>               
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dobc','required']) !!}
                            <label for="dobc ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>
                        @if(!Session::has('domestic')) 
                    <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNumc']) !!}
                            <label for="pasNumc">Passport Number:</label></div>
                        </div>

                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'edc']) !!}
                            <label for="edc ">Passport Expire:</label></div>
                        </div>
                    @endif
                   </div>
                </div>
                @endfor
            </div>
            <div class="row"  style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                @for($i = 0; $i < $infant; $i++)

                <div class="pass">
                    <h6 style="margin-left: 1%; margin-top: 1%;">Infant {{ $i + 1 }}</h6>
                    <input type="hidden" name="PaxType[]" value="3">
                    <input type="hidden" name="IsLeadPax[]" value="false">
                    <div class="row lform">
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('title[]',['Mr'=>'Mr','Ms'=>'Ms','CHD'=>'CHD'],null,['class'=>'form-control customer_details','id'=>'adult_count','required']) !!}
                        </div>
                        </div>
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('firstname[]',null,['class'=>'form-control','id'=>'firsti','required']) !!}
                            <label for="firsti">First name:</label></div>
                        </div>
                       
                        <div class="col l4" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('lastname[]',null,['class'=>'form-control','id'=>'lasti','required']) !!}
                            <label for="lasti">Last name:</label></div>
                        </div>               
                        
                    </div>
                    <div class="row lform">
                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::date('date_of_birth[]',null,['class'=>'form-control','id'=>'dobi','required']) !!}
                            <label for="dobi ">DOB :</label></div>
                        </div>
                        <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'],null,['class'=>'form-control customer_details','id'=>'gender']) !!}
                        </div>
                        </div>
                       @if(!Session::has('domestic')) 
                    <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                             {!! Form::text('PassportNo[]',null,['class'=>'form-control','id'=>'pasNumi']) !!}
                            <label for="pasNumi">Passport Number:</label></div>
                        </div>

                         <div class="col l3" style="padding-left: 2%;">
                            <div class="input-field">
                            {!! Form::text('PassportExpiry[]',null,['class'=>'form-control ','id'=>'edi']) !!}
                            <label for="edi ">Passport Expire:</label></div>
                        </div>
                    @endif
                   </div>
                  </div>
                @endfor
            </div>
            </div>

            <div class="col l12" style="margin-top: 2%;">
                <div class="row lform">
                    <div class="col l6">
                        <div class="input-field">
                           {!! Form::email('email',null,['class'=>'form-control','id'=>'Memail','required']) !!}
                            <label for="Memail">Email:</label>
                        </div>
                    </div>
                    <div class="col l6">
                        <div class="input-field">
                           {!! Form::text('contact',null,['class'=>'form-control','id'=>'contact','pattern'=>'[1-9]{1}[0-9]{9}','maxLength'=>'10','required']) !!}
                            <label for="contact">Contact</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l6 lform">
                <div class="input-field">
                        {!! Form::text('AddressLine1',null,['class'=>'form-control','id'=>'address']) !!}
                        <label for="address">Address</label>
                        </div>
            </div>
            <div class="col l6">
                <button class="btn mdb valign right">Proceed To Payment</button>
            </div>
        </div>
       
    </div>
</div>
{!! Form::close() !!}

@endif
</div>


<div class="sidebar col l3 m3 s12 ml-2">
    <div class="row"><h5 class="mdb-text ml2">Fare Summary</h5></div>
    <div class="row card border-radius-8 z-depth-4">

        @if($request_data['trip_type'] == 'round')
        <div class="card-content">
            <div class="row">
                <h5 class="mb1 mt5 p0">{{ $flightOne['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightOne['Segments'][0][count($flightOne['Segments'][0])-1]['Destination']['Airport']['CityName'] }}</h5>
                <span class="uc">Oneway flight</span></br>
                <small class="uc"><b>{{ $request_data['adult'] }}</b> Adults and <b>{{ $request_data['child'] }}</b> Kids</small>
            </div>
            <div class="row">
                <h5 class="mb1 mt5 p0">{{ $flightTwo['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightTwo['Segments'][0][count($flightTwo['Segments'][0])-1]['Destination']['Airport']['CityName'] }}</h5>
                <span class="uc">Oneway flight</span></br>
                <small class="uc"><b>{{ $request_data['adult'] }}</b> Adults and <b>{{ $request_data['child'] }}</b> Kids</small>
            </div>
            <div class="row mt5">
                <div class="col l6"><small class="left-align">Total Amount</small></div>
                <div class="col l6"><span class="right-align">&#8377;{{ $flightOne['Fare']['PublishedFare'] + $flightTwo['Fare']['PublishedFare'] }}<span></div> 
                </div>
                <a href="javascript:void(0)" class="button btn pills gradient-45deg-light-blue-cyan gradient-shadow mt2">book flight now</a>
            </div>
            @elseif($request_data['trip_type'] == 'one_way')
            <div class="card-content">
                <div class="row">
                    <h5 class="mb1 mt5 p0">{{ $flightData['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightData['Segments'][0][count($flightData['Segments'][0])-1]['Destination']['Airport']['CityName'] }}</h5>
                    <span class="uc">Oneway flight</span></br>
                    <small class="uc"><b>{{ $request_data['adult'] }}</b> Adults and <b>{{ $request_data['child'] }}</b> Kids</small>
                </div>
                <div class="row mt5">
                    <div class="col l6"><small class="left-align">Total Amount</small></div>
                    <div class="col l6"><span class="right-align">&#8377;{{ $flightData['Fare']['PublishedFare'] }}<span></div> 
                    </div>
                    <a href="javascript:void(0)" class="button btn pills gradient-45deg-light-blue-cyan gradient-shadow mt2">book flight now</a>

                </div>
                @else
                @endif
            </div>
            <div class="row card border-radius-8 z-depth-4">
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
    </div>
</div>

@endif

</section>

@endsection