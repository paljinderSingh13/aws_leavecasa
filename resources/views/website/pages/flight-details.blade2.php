@extends('website.layout.website')
@section('content')
    <section id="content">
        <div class="container flight-detail-page">
            <div class="row">
                <div id="main" class="col-md-9">
                    
                    
                    @if($request_data['trip_type'] == 'round')
                        @php
                            $flightOne = json_decode(session()->get('flight_one'),true);
                            $flightTwo = json_decode(session()->get('flight_two'),true);
                        @endphp
                        <div id="flight-features" class="tab-container">
                            <ul class="tabs">
                                <li class="active"><a href="#flight-details" data-toggle="tab">Flight Details</a></li>
                                {{-- <li><a href="#inflight-features" data-toggle="tab">Inflight Features</a></li>
                                <li><a href="#flgiht-seat-selection" data-toggle="tab">Seat Selection</a></li>
                                <li><a href="#flight-baggage" data-toggle="tab">Baggage</a></li>
                                <li><a href="#flight-fare-rules" data-toggle="tab">Fare Rules</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="flight-details">

                                    <div class="intro table-wrapper full-width hidden-table-sm box">
                                        <div class="col-md-4 table-cell travelo-box">
                                            <dl class="term-description">
                                                <dt>Airline:</dt>
                                                <dd>{{ $flightOne['Segments'][0][0]['Airline']['AirlineName'] }}</dd>
                                                <dt>Flight Type:</dt>
                                                <dd>{{ $flightOne['Segments'][0][0]['Airline']['FareClass'] }}</dd>
                                                <dt>Fare type:</dt>
                                                <dd>{{ $flightOne['IsRefundable'] == true ? 'Refundable':'Non-Refundable' }}</dd>
                                                {{-- <dt>Cancellation:</dt>
                                                <dd>$78 / person</dd> --}}
                                                {{-- <dt>Flight Change:</dt>
                                                <dd>$53 / person</dd> --}}
                                                <dt>Baggage:</dt>
                                                <dd>{{ $flightOne['Segments'][0][0]['CabinBaggage'] }}</dd>
                                                <dt>Inflight Features:</dt>
                                                <dd>Available</dd>
                                                <dt>Base fare:</dt>
                                                <dd>&#8377;{{ $flightOne['Fare']['BaseFare'] }}</dd>
                                                <dt>Taxes &amp; Fees:</dt>
                                                <dd>&#8377;{{ $flightOne['Fare']['Tax'] }}</dd>
                                                <dt>total price:</dt>
                                                <dd>&#8377;{{ $flightOne['Fare']['PublishedFare'] }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-8 table-cell">
                                            <div class="detailed-features booking-details">
                                                <div class="travelo-box">
                                                    <a href="#" class="button btn-mini yellow pull-right">1 STOP</a>
                                                    <h4 class="box-title">{{ $flightOne['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightOne['Segments'][0][count($flightOne['Segments'][0])-1]['Destination']['Airport']['CityName'] }}<small>Oneway flight</small></h4>
                                                </div>
                                                <div class="table-wrapper flights">
                                                    @foreach($flightOne['Segments'][0] as $key => $flightDetails)
                                                        <div class="table-row first-flight">
                                                            <div class="table-cell logo">
                                                                <label>{{ $flightDetails['Airline']['AirlineCode'] }}-{{ $flightDetails['Airline']['FlightNumber'] }} {{ $flightDetails['Airline']['FareClass'] }}</label>
                                                            </div>
                                                            <div class="table-cell timing-detail">
                                                                <div class="timing">
                                                                    <div class="check-in">
                                                                        <label>Take off</label>
                                                                        @php
                                                                            $departDateTime = explode('T',$flightDetails['Origin']['DepTime']);
                                                                            $parsedDateTime = \Carbon\Carbon::parse($departDateTime[0].' '.$departDateTime[1]);
                                                                            $arrivalDateTime = explode('T',$flightDetails['Destination']['ArrTime']);
                                                                            $parsedArrivalTime = \Carbon\Carbon::parse($arrivalDateTime[0].' '.$arrivalDateTime[1]);

                                                                        @endphp
                                                                        <span>{{ $parsedDateTime->format('d') }} {{ $parsedDateTime->format('M') }} {{ $parsedDateTime->format('Y') }} , {{ $parsedDateTime->format('h:i a') }} </span>
                                                                    </div>
                                                                    <div class="duration text-center">
                                                                        <i class="soap-icon-clock"></i>
                                                                        <span>{{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </span>
                                                                    </div>
                                                                    <div class="check-out">
                                                                        <label>landing</label>
                                                                        <span>{{ $parsedArrivalTime->format('d') }} {{ $parsedArrivalTime->format('M') }} {{ $parsedArrivalTime->format('Y') }} , {{ $parsedArrivalTime->format('h:i a') }} </span>
                                                                    </div>
                                                                </div>
                                                                @if(count($flightOne['Segments'][0])>1)
                                                                <label class="layover">Layover : {{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- <div class="table-row second-flight">
                                                        <div class="table-cell logo">
                                                            <img src="http://placehold.it/140x30" alt="">
                                                            <label>AI-635 Economy</label>
                                                        </div>
                                                        <div class="table-cell timing-detail">
                                                            <div class="timing">
                                                                <div class="check-in">
                                                                    <label>Take off</label>
                                                                    <span>13 Nov 2013, 7:50 am</span>
                                                                </div>
                                                                <div class="duration text-center">
                                                                    <i class="soap-icon-clock"></i>
                                                                    <span>8h 20m</span>
                                                                </div>
                                                                <div class="check-out">
                                                                    <label>landing</label>
                                                                    <span>13 Nov 2013, 9:20 Am</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="intro table-wrapper full-width hidden-table-sm box">
                                        <div class="col-md-4 table-cell travelo-box">
                                            <dl class="term-description">
                                                <dt>Airline:</dt>
                                                <dd>{{ $flightTwo['Segments'][0][0]['Airline']['AirlineName'] }}</dd>
                                                <dt>Flight Type:</dt>
                                                <dd>{{ $flightTwo['Segments'][0][0]['Airline']['FareClass'] }}</dd>
                                                <dt>Fare type:</dt>
                                                <dd>{{ $flightTwo['IsRefundable'] == true ? 'Refundable':'Non-Refundable' }}</dd>
                                                {{-- <dt>Cancellation:</dt>
                                                <dd>$78 / person</dd> --}}
                                                {{-- <dt>Flight Change:</dt>
                                                <dd>$53 / person</dd> --}}
                                                <dt>Baggage:</dt>
                                                <dd>{{ $flightTwo['Segments'][0][0]['CabinBaggage'] }}</dd>
                                                <dt>Inflight Features:</dt>
                                                <dd>Available</dd>
                                                <dt>Base fare:</dt>
                                                <dd>&#8377;{{ $flightTwo['Fare']['BaseFare'] }}</dd>
                                                <dt>Taxes &amp; Fees:</dt>
                                                <dd>&#8377;{{ $flightTwo['Fare']['Tax'] }}</dd>
                                                <dt>total price:</dt>
                                                <dd>&#8377;{{ $flightTwo['Fare']['PublishedFare'] }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-8 table-cell">
                                            <div class="detailed-features booking-details">
                                                <div class="travelo-box">
                                                    <a href="#" class="button btn-mini yellow pull-right">1 STOP</a>
                                                    <h4 class="box-title">{{ $flightTwo['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightTwo['Segments'][0][count($flightTwo['Segments'][0])-1]['Destination']['Airport']['CityName'] }}<small>Oneway flight</small></h4>
                                                </div>
                                                <div class="table-wrapper flights">
                                                    @foreach($flightTwo['Segments'][0] as $key => $flightDetails)
                                                        <div class="table-row first-flight">
                                                            <div class="table-cell logo">
                                                                <label>{{ $flightDetails['Airline']['AirlineCode'] }}-{{ $flightDetails['Airline']['FlightNumber'] }} {{ $flightDetails['Airline']['FareClass'] }}</label>
                                                            </div>
                                                            <div class="table-cell timing-detail">
                                                                <div class="timing">
                                                                    <div class="check-in">
                                                                        <label>Take off</label>
                                                                        @php
                                                                            $departDateTime = explode('T',$flightDetails['Origin']['DepTime']);
                                                                            $parsedDateTime = \Carbon\Carbon::parse($departDateTime[0].' '.$departDateTime[1]);
                                                                            $arrivalDateTime = explode('T',$flightDetails['Destination']['ArrTime']);
                                                                            $parsedArrivalTime = \Carbon\Carbon::parse($arrivalDateTime[0].' '.$arrivalDateTime[1]);

                                                                        @endphp
                                                                        <span>{{ $parsedDateTime->format('d') }} {{ $parsedDateTime->format('M') }} {{ $parsedDateTime->format('Y') }} , {{ $parsedDateTime->format('h:i a') }} </span>
                                                                    </div>
                                                                    <div class="duration text-center">
                                                                        <i class="soap-icon-clock"></i>
                                                                        <span>{{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </span>
                                                                    </div>
                                                                    <div class="check-out">
                                                                        <label>landing</label>
                                                                        <span>{{ $parsedArrivalTime->format('d') }} {{ $parsedArrivalTime->format('M') }} {{ $parsedArrivalTime->format('Y') }} , {{ $parsedArrivalTime->format('h:i a') }} </span>
                                                                    </div>
                                                                </div>
                                                                @if(count($flightTwo['Segments'][0])>1)
                                                                <label class="layover">Layover : {{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- <div class="table-row second-flight">
                                                        <div class="table-cell logo">
                                                            <img src="http://placehold.it/140x30" alt="">
                                                            <label>AI-635 Economy</label>
                                                        </div>
                                                        <div class="table-cell timing-detail">
                                                            <div class="timing">
                                                                <div class="check-in">
                                                                    <label>Take off</label>
                                                                    <span>13 Nov 2013, 7:50 am</span>
                                                                </div>
                                                                <div class="duration text-center">
                                                                    <i class="soap-icon-clock"></i>
                                                                    <span>8h 20m</span>
                                                                </div>
                                                                <div class="check-out">
                                                                    <label>landing</label>
                                                                    <span>13 Nov 2013, 9:20 Am</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>Secure Ride</h2>
                                            <div class="row">
                                                <div class="col-md-10" style="border: 1px solid #CCC; margin-left: 5%; box-shadow: 1px 1px 1px 1px #CCC;">
                                                    <img src="{{ asset('images/insurance.jpg') }}" class="pull-right" width="30%;" />
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="{{ asset('images/modules_eligibility.png') }}" width="100%" style="margin-top: 12%;">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <h4 style="margin-top: 2%;">Travel Assistance & Insurance</h4>
                                                            <h5>
                                                                Secure your trip @ ₹ 249/- per traveller 
                                                                <label class="pull-right"><input type="checkbox" style="margin-top: 2%;" /> Yes, I want secure ride!</label>
                                                            </h5>
                                                            <p style="font-size: 12px; margin-bottom: -2%;"><a href="javascript:void(0)">View All Benifits</a> *Insurance is only valid for Indian Citizens below 70 years of age. <a href="javascript:void(0)">Terms & Conditions</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- {{ dd($request_data) }} --}}
                                        </div>
                                    </div>
                                    {!! Form::open(['route'=>'book.customer.flight.now']) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h2>Passengers Details</h2>
                                                    <input type="text" name="ResultIndex" value="{{ $request_data['ResultIndex'] }}">

                                                <div class="row">
                                                    <div class="col-md-12" style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                                                        @php
                                                            $adults = $request_data['adult'];
                                                            $child = $request_data['child'];
                                                            $total = $adults + $child;
                                                        @endphp
                                                        @for($i = 0; $i < $total; $i++)
                                                            <div class="pass">
                                                                <h3 style="margin-left: 1%; margin-top: 1%;">Passenger {{ $i + 1 }}</h3>
                                                                <div class="row">
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::select('title[]',['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
                                                                    </div>
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::text('firstname[]',null,['class'=>'form-control','placeholder'=>'First name']) !!}
                                                                    </div>
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::text('lastname[]',null,['class'=>'form-control','placeholder'=>'Last name']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <div class="col-md-12" style="margin-top: 2%;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Email:</label>
                                                                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Contact</label>
                                                                    {!! Form::text('contact',null,['class'=>'form-control','placeholder'=>'Enter contact']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary pull-right">Procced To Payment</button>
                                                    </div>
                                                </div>
                                                {{-- {{ dd($request_data) }} --}}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane fade" id="inflight-features">
                                    <h2>Features Style 01</h2>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <ul class="amenities clearfix style1 box">
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-wifi"></i>WI_FI</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-entertainment"></i>entertainment</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-television"></i>television</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-aircon"></i>air conditioning</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-juice"></i>drink</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-joystick"></i>games</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-coffee"></i>coffee</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-winebar"></i>wines</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-shopping"></i>shopping</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-food"></i>food</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-comfort"></i>comfort</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-magazine"></i>magazines</div>
                                        </li>
                                    </ul>
                                    <h2>Features Style 02</h2>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <ul class="amenities clearfix style2">
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-wifi circle"></i>WI_FI</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-entertainment circle"></i>entertainment</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-television circle"></i>television</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-aircon circle"></i>air conditioning</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-juice circle"></i>drink</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-joystick circle"></i>games</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-coffee circle"></i>coffee</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-winebar circle"></i>wines</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-shopping circle"></i>shopping</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-food circle"></i>food</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-comfort circle"></i>comfort</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-magazine circle"></i>magazines</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="flgiht-seat-selection">
                                    <h2>Select your Seats</h2>
                                    <p>Would you like a window seat or treat yourself to more comfort? Select your seats online in advance with our easy-to-use seat map. You can choose and change your seat until 48 hours before departure, when booking on Travelo.com. Also you can choose and change your seats at a self-service machine at the airport.</p>
                                    <hr>
                                    <div class="image-box style12">
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="flight-baggage">
                                    <div class="travelo-box border-box box clearfix">
                                        <form>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">From</h5>
                                                    <input type="text" class="input-text full-width" placeholder="city, airport or country name">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">To</h5>
                                                    <input type="text" class="input-text full-width" placeholder="city, airport or country name">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Top Tier Status</h5>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="">super elite 100K</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Bag weight</h5>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="">20kgs (44lbs)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Class of service</h5>
                                                    <input type="text" class="input-text full-width" placeholder="economy class">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">&nbsp;</h5>
                                                    <button class="full-width icon-check uppercase">View baggage allowance</button>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">Infant/child (0 to 11 years) occupying a seat (with own ticket)
                                                    </label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <h2>Baggage</h2>
                                    <p>In this section you'll find information on baggage allowances, special equipment and sports items as well as restricted items. We've also included some tips to make your trip more enjoyable.</p>
                                    <div class="baggage column-5">
                                        <div class="icon-box style9">
                                            <i class="soap-icon-carryon"></i>
                                            <h5 class="box-title">Carry-on<br>Allowance</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-baggage"></i>
                                            <h5 class="box-title">Baggage<br>Allowance</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-delayed-baggage"></i>
                                            <h5 class="box-title">Delayed<br>Baggage</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-damaged-baggage"></i>
                                            <h5 class="box-title">Damaged<br>Baggage</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-baggage-status"></i>
                                            <h5 class="box-title">Baggage<br>Status</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-phone"></i>
                                            <h5 class="box-title">Baggage<br>Services</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-status"></i>
                                            <h5 class="box-title">Baggage<br>Tips</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-restricted"></i>
                                            <h5 class="box-title">Restricted<br>Items</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-liability"></i>
                                            <h5 class="box-title">Liability<br>Limitations</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-lost-found"></i>
                                            <h5 class="box-title">Lost and<br>Found</h5>
                                        </div>
                                    </div>

                                    <hr>
                                    <h2>Basic Information</h2>
                                    <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcorper vulputate nisi, et fringilla ante convallis quis. Nullam vel tellus non elit suscipit volutpat. Integer id felis et nibh rutrum dignissim ut non risus. In tincidunt urna quis sem luctus, sed accumsan magna pellentesque. Donec et iaculis tellus. Vestibulum ut iaculis justo, auctor sodales lectus. Donec et tellus tempus, dignissim maurornare, consequat lacus. Integer dui neque, scelerisque nec sollicitudin sit amet, sodales a erat. Duis vitae condimentum ligula. Integer eu mi nisl. Donec massa dui, commodo id arcu quis, venenatis scelerisque velit.</p>
                                </div>
                                <div class="tab-pane fade" id="flight-fare-rules">
                                    <h2>Fare Rules for your Flight</h2>
                                    <div class="topics">
                                        <ul class="check-square clearfix">
                                            <li class="col-sm-6 col-md-4"><a href="#">Rules and Policies</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Flight Changes</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">refunds</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Airline Penalties</a></li>
                                            <li class="col-sm-6 col-md-4 active"><a href="#">Flight Cancellation</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Airline terms of use</a></li>
                                        </ul>
                                    </div>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <div class="toggle-container">
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question1" data-toggle="collapse">Flight cancellation charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question1">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question2" data-toggle="collapse">WAmendment in higher class charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question2">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="" href="#question3" data-toggle="collapse">Amendment in same class charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse in" id="question3">
                                                <div class="panel-content">
                                                    <p>Sed a justo enim. Vivamus volutpat ipsum ultrices augue porta lacinia. Proin in elementum enim. <span class="skin-color">Duis suscipit justo</span> non purus consequat molestie. Etiam pharetra ipsum sagittis sollicitudin ultricies. Praesent luctus, diam ut tempus aliquam, diam ante euismod risus, euismod viverra quam quam eget turpis. Nam <span class="skin-color">tristique congue</span> arcu, id bibendum diam. Ut hendrerit, leo a pellentesque porttitor, purus arcu tristique erat, in faucibus elit leo in turpis vitae luctus enim, a mollis nulla.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question4" data-toggle="collapse">Rebooking/cancellation charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question4">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question5" data-toggle="collapse">Canellation through the customer support</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question5">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question6" data-toggle="collapse">Do we accept cancellations through email?</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question6">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question7" data-toggle="collapse">What is the minimum day limit of cancellation?</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question7">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($request_data['trip_type'] == 'one_way')
                        @php
                            $flightData = json_decode(session()->get('selected_flight'),true);
                        @endphp
                        <div id="flight-features" class="tab-container">
                            <ul class="tabs">
                                <li class="active"><a href="#flight-details" data-toggle="tab">Flight Details</a></li>
                                {{-- <li><a href="#inflight-features" data-toggle="tab">Inflight Features</a></li>
                                <li><a href="#flgiht-seat-selection" data-toggle="tab">Seat Selection</a></li>
                                <li><a href="#flight-baggage" data-toggle="tab">Baggage</a></li>
                                <li><a href="#flight-fare-rules" data-toggle="tab">Fare Rules</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="flight-details">
                                    <div class="intro table-wrapper full-width hidden-table-sm box">
                                        <div class="col-md-4 table-cell travelo-box">
                                            <dl class="term-description">
                                                <dt>Airline:</dt>
                                                <dd>{{ $flightData['Segments'][0][0]['Airline']['AirlineName'] }}</dd>
                                                <dt>Flight Type:</dt>
                                                <dd>{{ $flightData['Segments'][0][0]['Airline']['FareClass'] }}</dd>
                                                <dt>Fare type:</dt>
                                                <dd>{{ $flightData['IsRefundable'] == true ? 'Refundable':'Non-Refundable' }}</dd>
                                                {{-- <dt>Cancellation:</dt>
                                                <dd>$78 / person</dd> --}}
                                                {{-- <dt>Flight Change:</dt>
                                                <dd>$53 / person</dd> --}}
                                                <dt>Baggage:</dt>
                                                <dd>{{ $flightData['Segments'][0][0]['CabinBaggage'] }}</dd>
                                                <dt>Inflight Features:</dt>
                                                <dd>Available</dd>
                                                <dt>Base fare:</dt>
                                                <dd>&#8377;{{ $flightData['Fare']['BaseFare'] }}</dd>
                                                <dt>Taxes &amp; Fees:</dt>
                                                <dd>&#8377;{{ $flightData['Fare']['Tax'] }}</dd>
                                                <dt>total price:</dt>
                                                <dd>&#8377;{{ $flightData['Fare']['PublishedFare'] }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-8 table-cell">
                                            <div class="detailed-features booking-details">
                                                <div class="travelo-box">
                                                    <a href="#" class="button btn-mini yellow pull-right">1 STOP</a>
                                                    <h4 class="box-title">{{ $flightData['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightData['Segments'][0][count($flightData['Segments'][0])-1]['Destination']['Airport']['CityName'] }}<small>Oneway flight</small></h4>
                                                </div>
                                                <div class="table-wrapper flights">
                                                    @foreach($flightData['Segments'][0] as $key => $flightDetails)
                                                        <div class="table-row first-flight">
                                                            <div class="table-cell logo">
                                                                <label>{{ $flightDetails['Airline']['AirlineCode'] }}-{{ $flightDetails['Airline']['FlightNumber'] }} {{ $flightDetails['Airline']['FareClass'] }}</label>
                                                            </div>
                                                            <div class="table-cell timing-detail">
                                                                <div class="timing">
                                                                    <div class="check-in">
                                                                        <label>Take off</label>
                                                                        @php
                                                                            $departDateTime = explode('T',$flightDetails['Origin']['DepTime']);
                                                                            $parsedDateTime = \Carbon\Carbon::parse($departDateTime[0].' '.$departDateTime[1]);
                                                                            $arrivalDateTime = explode('T',$flightDetails['Destination']['ArrTime']);
                                                                            $parsedArrivalTime = \Carbon\Carbon::parse($arrivalDateTime[0].' '.$arrivalDateTime[1]);

                                                                        @endphp
                                                                        <span>{{ $parsedDateTime->format('d') }} {{ $parsedDateTime->format('M') }} {{ $parsedDateTime->format('Y') }} , {{ $parsedDateTime->format('h:i a') }} </span>
                                                                    </div>
                                                                    <div class="duration text-center">
                                                                        <i class="soap-icon-clock"></i>
                                                                        <span>{{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </span>
                                                                    </div>
                                                                    <div class="check-out">
                                                                        <label>landing</label>
                                                                        <span>{{ $parsedArrivalTime->format('d') }} {{ $parsedArrivalTime->format('M') }} {{ $parsedArrivalTime->format('Y') }} , {{ $parsedArrivalTime->format('h:i a') }} </span>
                                                                    </div>
                                                                </div>
                                                                @if(count($flightData['Segments'][0])>1)
                                                                <label class="layover">Layover : {{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- <div class="table-row second-flight">
                                                        <div class="table-cell logo">
                                                            <img src="http://placehold.it/140x30" alt="">
                                                            <label>AI-635 Economy</label>
                                                        </div>
                                                        <div class="table-cell timing-detail">
                                                            <div class="timing">
                                                                <div class="check-in">
                                                                    <label>Take off</label>
                                                                    <span>13 Nov 2013, 7:50 am</span>
                                                                </div>
                                                                <div class="duration text-center">
                                                                    <i class="soap-icon-clock"></i>
                                                                    <span>8h 20m</span>
                                                                </div>
                                                                <div class="check-out">
                                                                    <label>landing</label>
                                                                    <span>13 Nov 2013, 9:20 Am</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>Secure Ride</h2>
                                            <div class="row">
                                                <div class="col-md-10" style="border: 1px solid #CCC; margin-left: 5%; box-shadow: 1px 1px 1px 1px #CCC;">
                                                    <img src="{{ asset('images/insurance.jpg') }}" class="pull-right" width="30%;" />
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="{{ asset('images/modules_eligibility.png') }}" width="100%" style="margin-top: 12%;">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <h4 style="margin-top: 2%;">Travel Assistance & Insurance</h4>
                                                            <h5>
                                                                Secure your trip @ ₹ 249/- per traveller 
                                                                <label class="pull-right"><input type="checkbox" style="margin-top: 2%;" /> Yes, I want secure ride!</label>
                                                            </h5>
                                                            <p style="font-size: 12px; margin-bottom: -2%;"><a href="javascript:void(0)">View All Benifits</a> *Insurance is only valid for Indian Citizens below 70 years of age. <a href="javascript:void(0)">Terms & Conditions</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- {{ dd($request_data) }} --}}
                                        </div>
                                    </div>
                                    {!! Form::open(['route'=>'book.customer.flight.now']) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h2>Passengers Details</h2>
                                                    <input type="text" name="ResultIndex" value="{{ $request_data['ResultIndex'] }}">

                                                <div class="row">
                                                    <div class="col-md-12" style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                                                        @php
                                                            $adults = $request_data['adult'];
                                                            $child = $request_data['child'];
                                                            $total = $adults + $child;
                                                        @endphp
                                                        @for($i = 0; $i < $total; $i++)
                                                            <div class="pass">
                                                                <h3 style="margin-left: 1%; margin-top: 1%;">Passenger {{ $i + 1 }}</h3>
                                                                <div class="row">
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::select('title[]',['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
                                                                    </div>
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::text('firstname[]',null,['class'=>'form-control','placeholder'=>'First name']) !!}
                                                                    </div>
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::text('lastname[]',null,['class'=>'form-control','placeholder'=>'Last name']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <div class="col-md-12" style="margin-top: 2%;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Email:</label>
                                                                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Contact</label>
                                                                    {!! Form::text('contact',null,['class'=>'form-control','placeholder'=>'Enter contact']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary pull-right">Procced To Payment</button>
                                                    </div>
                                                </div>
                                                {{-- {{ dd($request_data) }} --}}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane fade" id="inflight-features">
                                    <h2>Features Style 01</h2>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <ul class="amenities clearfix style1 box">
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-wifi"></i>WI_FI</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-entertainment"></i>entertainment</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-television"></i>television</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-aircon"></i>air conditioning</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-juice"></i>drink</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-joystick"></i>games</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-coffee"></i>coffee</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-winebar"></i>wines</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-shopping"></i>shopping</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-food"></i>food</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-comfort"></i>comfort</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-magazine"></i>magazines</div>
                                        </li>
                                    </ul>
                                    <h2>Features Style 02</h2>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <ul class="amenities clearfix style2">
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-wifi circle"></i>WI_FI</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-entertainment circle"></i>entertainment</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-television circle"></i>television</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-aircon circle"></i>air conditioning</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-juice circle"></i>drink</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-joystick circle"></i>games</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-coffee circle"></i>coffee</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-winebar circle"></i>wines</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-shopping circle"></i>shopping</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-food circle"></i>food</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-comfort circle"></i>comfort</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-magazine circle"></i>magazines</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="flgiht-seat-selection">
                                    <h2>Select your Seats</h2>
                                    <p>Would you like a window seat or treat yourself to more comfort? Select your seats online in advance with our easy-to-use seat map. You can choose and change your seat until 48 hours before departure, when booking on Travelo.com. Also you can choose and change your seats at a self-service machine at the airport.</p>
                                    <hr>
                                    <div class="image-box style12">
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="flight-baggage">
                                    <div class="travelo-box border-box box clearfix">
                                        <form>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">From</h5>
                                                    <input type="text" class="input-text full-width" placeholder="city, airport or country name">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">To</h5>
                                                    <input type="text" class="input-text full-width" placeholder="city, airport or country name">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Top Tier Status</h5>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="">super elite 100K</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Bag weight</h5>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="">20kgs (44lbs)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Class of service</h5>
                                                    <input type="text" class="input-text full-width" placeholder="economy class">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">&nbsp;</h5>
                                                    <button class="full-width icon-check uppercase">View baggage allowance</button>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">Infant/child (0 to 11 years) occupying a seat (with own ticket)
                                                    </label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <h2>Baggage</h2>
                                    <p>In this section you'll find information on baggage allowances, special equipment and sports items as well as restricted items. We've also included some tips to make your trip more enjoyable.</p>
                                    <div class="baggage column-5">
                                        <div class="icon-box style9">
                                            <i class="soap-icon-carryon"></i>
                                            <h5 class="box-title">Carry-on<br>Allowance</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-baggage"></i>
                                            <h5 class="box-title">Baggage<br>Allowance</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-delayed-baggage"></i>
                                            <h5 class="box-title">Delayed<br>Baggage</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-damaged-baggage"></i>
                                            <h5 class="box-title">Damaged<br>Baggage</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-baggage-status"></i>
                                            <h5 class="box-title">Baggage<br>Status</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-phone"></i>
                                            <h5 class="box-title">Baggage<br>Services</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-status"></i>
                                            <h5 class="box-title">Baggage<br>Tips</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-restricted"></i>
                                            <h5 class="box-title">Restricted<br>Items</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-liability"></i>
                                            <h5 class="box-title">Liability<br>Limitations</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-lost-found"></i>
                                            <h5 class="box-title">Lost and<br>Found</h5>
                                        </div>
                                    </div>

                                    <hr>
                                    <h2>Basic Information</h2>
                                    <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcorper vulputate nisi, et fringilla ante convallis quis. Nullam vel tellus non elit suscipit volutpat. Integer id felis et nibh rutrum dignissim ut non risus. In tincidunt urna quis sem luctus, sed accumsan magna pellentesque. Donec et iaculis tellus. Vestibulum ut iaculis justo, auctor sodales lectus. Donec et tellus tempus, dignissim maurornare, consequat lacus. Integer dui neque, scelerisque nec sollicitudin sit amet, sodales a erat. Duis vitae condimentum ligula. Integer eu mi nisl. Donec massa dui, commodo id arcu quis, venenatis scelerisque velit.</p>
                                </div>
                                <div class="tab-pane fade" id="flight-fare-rules">
                                    <h2>Fare Rules for your Flight</h2>
                                    <div class="topics">
                                        <ul class="check-square clearfix">
                                            <li class="col-sm-6 col-md-4"><a href="#">Rules and Policies</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Flight Changes</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">refunds</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Airline Penalties</a></li>
                                            <li class="col-sm-6 col-md-4 active"><a href="#">Flight Cancellation</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Airline terms of use</a></li>
                                        </ul>
                                    </div>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <div class="toggle-container">
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question1" data-toggle="collapse">Flight cancellation charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question1">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question2" data-toggle="collapse">WAmendment in higher class charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question2">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="" href="#question3" data-toggle="collapse">Amendment in same class charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse in" id="question3">
                                                <div class="panel-content">
                                                    <p>Sed a justo enim. Vivamus volutpat ipsum ultrices augue porta lacinia. Proin in elementum enim. <span class="skin-color">Duis suscipit justo</span> non purus consequat molestie. Etiam pharetra ipsum sagittis sollicitudin ultricies. Praesent luctus, diam ut tempus aliquam, diam ante euismod risus, euismod viverra quam quam eget turpis. Nam <span class="skin-color">tristique congue</span> arcu, id bibendum diam. Ut hendrerit, leo a pellentesque porttitor, purus arcu tristique erat, in faucibus elit leo in turpis vitae luctus enim, a mollis nulla.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question4" data-toggle="collapse">Rebooking/cancellation charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question4">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question5" data-toggle="collapse">Canellation through the customer support</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question5">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question6" data-toggle="collapse">Do we accept cancellations through email?</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question6">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question7" data-toggle="collapse">What is the minimum day limit of cancellation?</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question7">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $flightData = json_decode(session()->get('selected_flights'),true);
                        @endphp
                        <div id="flight-features" class="tab-container">
                            <ul class="tabs">
                                <li class="active"><a href="#flight-details" data-toggle="tab">Flight Details</a></li>
                                {{-- <li><a href="#inflight-features" data-toggle="tab">Inflight Features</a></li>
                                <li><a href="#flgiht-seat-selection" data-toggle="tab">Seat Selection</a></li>
                                <li><a href="#flight-baggage" data-toggle="tab">Baggage</a></li>
                                <li><a href="#flight-fare-rules" data-toggle="tab">Fare Rules</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="flight-details">
                                    @foreach($flightData['Segments'] as $key => $segment)
                                        <div class="intro table-wrapper full-width hidden-table-sm box">
                                            <div class="col-md-4 table-cell travelo-box">
                                                <dl class="term-description">
                                                    <dt>Airline:</dt>
                                                    <dd>{{ $segment[0]['Airline']['AirlineName'] }}</dd>
                                                    <dt>Flight Type:</dt>
                                                    <dd>{{ $segment[0]['Airline']['FareClass'] }}</dd>
                                                    <dt>Fare type:</dt>
                                                    <dd>{{ $flightData['IsRefundable'] == true ? 'Refundable':'Non-Refundable' }}</dd>
                                                    {{-- <dt>Cancellation:</dt>
                                                    <dd>$78 / person</dd> --}}
                                                    {{-- <dt>Flight Change:</dt>
                                                    <dd>$53 / person</dd> --}}
                                                    <dt>Baggage:</dt>
                                                    <dd>{{ $segment[0]['CabinBaggage'] }}</dd>
                                                    <dt>Inflight Features:</dt>
                                                    <dd>Available</dd>
                                                    <dt>Base fare:</dt>
                                                    <dd>&#8377;{{ $flightData['Fare']['BaseFare'] }}</dd>
                                                    <dt>Taxes &amp; Fees:</dt>
                                                    <dd>&#8377;{{ $flightData['Fare']['Tax'] }}</dd>
                                                    <dt>total price:</dt>
                                                    <dd>&#8377;{{ $flightData['Fare']['PublishedFare'] }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-8 table-cell">
                                                <div class="detailed-features booking-details">
                                                    <div class="travelo-box">
                                                        <a href="#" class="button btn-mini yellow pull-right">1 STOP</a>
                                                        <h4 class="box-title">{{ $segment[0]['Origin']['Airport']['CityName'] }} to {{ $segment[count($segment)-1]['Destination']['Airport']['CityName'] }}<small>Oneway flight</small></h4>
                                                    </div>
                                                    <div class="table-wrapper flights">
                                                        @foreach($segment as $key => $flightDetails)
                                                            {{-- {{ dd($flightDetails) }} --}}
                                                            <div class="table-row first-flight">
                                                                <div class="table-cell logo">
                                                                    <label>{{ $flightDetails['Airline']['AirlineCode'] }}-{{ $flightDetails['Airline']['FlightNumber'] }} {{ $flightDetails['Airline']['FareClass'] }}</label>
                                                                </div>
                                                                <div class="table-cell timing-detail">
                                                                    <div class="timing">
                                                                        <div class="check-in">
                                                                            <label>Take off</label>
                                                                            @php
                                                                                $departDateTime = explode('T',$flightDetails['Origin']['DepTime']);
                                                                                $parsedDateTime = \Carbon\Carbon::parse($departDateTime[0].' '.$departDateTime[1]);
                                                                                $arrivalDateTime = explode('T',$flightDetails['Destination']['ArrTime']);
                                                                                $parsedArrivalTime = \Carbon\Carbon::parse($arrivalDateTime[0].' '.$arrivalDateTime[1]);
                                                                            @endphp
                                                                            <span>{{ $parsedDateTime->format('d') }} {{ $parsedDateTime->format('M') }} {{ $parsedDateTime->format('Y') }} , {{ $parsedDateTime->format('h:i a') }} </span>
                                                                        </div>
                                                                        <div class="duration text-center">
                                                                            <i class="soap-icon-clock"></i>
                                                                            <span>{{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </span>
                                                                        </div>
                                                                        <div class="check-out">
                                                                            <label>landing</label>
                                                                            <span>{{ $parsedArrivalTime->format('d') }} {{ $parsedArrivalTime->format('M') }} {{ $parsedArrivalTime->format('Y') }} , {{ $parsedArrivalTime->format('h:i a') }} </span>
                                                                        </div>
                                                                    </div>
                                                                    @if(count($segment)>1)
                                                                    <label class="layover">Layover : {{ $parsedArrivalTime->diff($parsedDateTime)->format('%h') }}h {{ $parsedArrivalTime->diff($parsedDateTime)->format('%m') }}m </label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        {{-- <div class="table-row second-flight">
                                                            <div class="table-cell logo">
                                                                <img src="http://placehold.it/140x30" alt="">
                                                                <label>AI-635 Economy</label>
                                                            </div>
                                                            <div class="table-cell timing-detail">
                                                                <div class="timing">
                                                                    <div class="check-in">
                                                                        <label>Take off</label>
                                                                        <span>13 Nov 2013, 7:50 am</span>
                                                                    </div>
                                                                    <div class="duration text-center">
                                                                        <i class="soap-icon-clock"></i>
                                                                        <span>8h 20m</span>
                                                                    </div>
                                                                    <div class="check-out">
                                                                        <label>landing</label>
                                                                        <span>13 Nov 2013, 9:20 Am</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>Secure Ride</h2>
                                            <div class="row">
                                                <div class="col-md-10" style="border: 1px solid #CCC; margin-left: 5%; box-shadow: 1px 1px 1px 1px #CCC;">
                                                    <img src="{{ asset('images/insurance.jpg') }}" class="pull-right" width="30%;" />
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="{{ asset('images/modules_eligibility.png') }}" width="100%" style="margin-top: 12%;">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <h4 style="margin-top: 2%;">Travel Assistance & Insurance</h4>
                                                            <h5>
                                                                Secure your trip @ ₹ 249/- per traveller 
                                                                <label class="pull-right"><input type="checkbox" style="margin-top: 2%;" /> Yes, I want secure ride!</label>
                                                            </h5>
                                                            <p style="font-size: 12px; margin-bottom: -2%;"><a href="javascript:void(0)">View All Benifits</a> *Insurance is only valid for Indian Citizens below 70 years of age. <a href="javascript:void(0)">Terms & Conditions</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- {{ dd($request_data) }} --}}
                                        </div>
                                    </div>
                                    {!! Form::open(['route'=>'book.customer.flight.now']) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h2>Passengers Details</h2>
                                                <input type="text" name="ResultIndex" value="{{ $request_data['ResultIndex'] }}">

                                                <div class="row">
                                                    <input type="text" name="ResultIndex" value="{{ $request_data['ResultIndex'] }}">
                                                    <div class="col-md-12" style="border: 1px solid #CCC; box-shadow: 1px 1px 1px 1px #CCC;">
                                                        @php
                                                            $adults = $request_data['adult'];
                                                            $child = $request_data['child'];
                                                            $total = $adults + $child;
                                                        @endphp
                                                        @for($i = 0; $i < $total; $i++)
                                                            <div class="pass">
                                                                <h3 style="margin-left: 1%; margin-top: 1%;">Passenger {{ $i + 1 }}</h3>
                                                                <div class="row">
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::select('title[]',['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'],null,['class'=>'form-control customer_details','id'=>'adult_count']) !!}
                                                                    </div>
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::text('firstname[]',null,['class'=>'form-control','placeholder'=>'First name']) !!}
                                                                    </div>
                                                                    <div class="col-md-4" style="padding-left: 2%;">
                                                                        {!! Form::text('lastname[]',null,['class'=>'form-control','placeholder'=>'Last name']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <div class="col-md-12" style="margin-top: 2%;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Email:</label>
                                                                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Contact</label>
                                                                    {!! Form::text('contact',null,['class'=>'form-control','placeholder'=>'Enter contact']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary pull-right">Procced To Payment</button>
                                                    </div>
                                                </div>
                                                {{-- {{ dd($request_data) }} --}}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane fade" id="inflight-features">
                                    <h2>Features Style 01</h2>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <ul class="amenities clearfix style1 box">
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-wifi"></i>WI_FI</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-entertainment"></i>entertainment</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-television"></i>television</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-aircon"></i>air conditioning</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-juice"></i>drink</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-joystick"></i>games</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-coffee"></i>coffee</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-winebar"></i>wines</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-shopping"></i>shopping</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-food"></i>food</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-comfort"></i>comfort</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style1"><i class="soap-icon-magazine"></i>magazines</div>
                                        </li>
                                    </ul>
                                    <h2>Features Style 02</h2>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <ul class="amenities clearfix style2">
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-wifi circle"></i>WI_FI</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-entertainment circle"></i>entertainment</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-television circle"></i>television</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-aircon circle"></i>air conditioning</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-juice circle"></i>drink</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-joystick circle"></i>games</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-coffee circle"></i>coffee</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-winebar circle"></i>wines</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-shopping circle"></i>shopping</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-food circle"></i>food</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-comfort circle"></i>comfort</div>
                                        </li>
                                        <li class="col-md-4 col-sm-6">
                                            <div class="icon-box style2"><i class="soap-icon-magazine circle"></i>magazines</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="flgiht-seat-selection">
                                    <h2>Select your Seats</h2>
                                    <p>Would you like a window seat or treat yourself to more comfort? Select your seats online in advance with our easy-to-use seat map. You can choose and change your seat until 48 hours before departure, when booking on Travelo.com. Also you can choose and change your seats at a self-service machine at the airport.</p>
                                    <hr>
                                    <div class="image-box style12">
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                        <hr>
                                        <article class="box">
                                            <figure>
                                                <img src="http://placehold.it/120x100" alt="" class="middle-item" />
                                            </figure>
                                            <div class="details">
                                                <h4 class="box-title">Standard advance seat selection</h4>
                                                <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcor vulputate nisi, et fringilla ante convallis quis. </p>
                                            </div>
                                            <div class="action">
                                                <span class="price"><small>starting at</small>$18</span>
                                                <a href="flight-booking.html" class="button btn-small">SELECT NOW</a>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="flight-baggage">
                                    <div class="travelo-box border-box box clearfix">
                                        <form>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">From</h5>
                                                    <input type="text" class="input-text full-width" placeholder="city, airport or country name">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">To</h5>
                                                    <input type="text" class="input-text full-width" placeholder="city, airport or country name">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Top Tier Status</h5>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="">super elite 100K</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Bag weight</h5>
                                                    <div class="selector full-width">
                                                        <select>
                                                            <option value="">20kgs (44lbs)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">Class of service</h5>
                                                    <input type="text" class="input-text full-width" placeholder="economy class">
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <div class="form-group">
                                                    <h5 class="title">&nbsp;</h5>
                                                    <button class="full-width icon-check uppercase">View baggage allowance</button>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">Infant/child (0 to 11 years) occupying a seat (with own ticket)
                                                    </label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <h2>Baggage</h2>
                                    <p>In this section you'll find information on baggage allowances, special equipment and sports items as well as restricted items. We've also included some tips to make your trip more enjoyable.</p>
                                    <div class="baggage column-5">
                                        <div class="icon-box style9">
                                            <i class="soap-icon-carryon"></i>
                                            <h5 class="box-title">Carry-on<br>Allowance</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-baggage"></i>
                                            <h5 class="box-title">Baggage<br>Allowance</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-delayed-baggage"></i>
                                            <h5 class="box-title">Delayed<br>Baggage</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-damaged-baggage"></i>
                                            <h5 class="box-title">Damaged<br>Baggage</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-baggage-status"></i>
                                            <h5 class="box-title">Baggage<br>Status</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-phone"></i>
                                            <h5 class="box-title">Baggage<br>Services</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-status"></i>
                                            <h5 class="box-title">Baggage<br>Tips</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-restricted"></i>
                                            <h5 class="box-title">Restricted<br>Items</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-liability"></i>
                                            <h5 class="box-title">Liability<br>Limitations</h5>
                                        </div>
                                        <div class="icon-box style9">
                                            <i class="soap-icon-lost-found"></i>
                                            <h5 class="box-title">Lost and<br>Found</h5>
                                        </div>
                                    </div>

                                    <hr>
                                    <h2>Basic Information</h2>
                                    <p>Sed aliquam nunc eget velit imperdiet, in rutrum mauris malesuada. Quisque ullamcorper vulputate nisi, et fringilla ante convallis quis. Nullam vel tellus non elit suscipit volutpat. Integer id felis et nibh rutrum dignissim ut non risus. In tincidunt urna quis sem luctus, sed accumsan magna pellentesque. Donec et iaculis tellus. Vestibulum ut iaculis justo, auctor sodales lectus. Donec et tellus tempus, dignissim maurornare, consequat lacus. Integer dui neque, scelerisque nec sollicitudin sit amet, sodales a erat. Duis vitae condimentum ligula. Integer eu mi nisl. Donec massa dui, commodo id arcu quis, venenatis scelerisque velit.</p>
                                </div>
                                <div class="tab-pane fade" id="flight-fare-rules">
                                    <h2>Fare Rules for your Flight</h2>
                                    <div class="topics">
                                        <ul class="check-square clearfix">
                                            <li class="col-sm-6 col-md-4"><a href="#">Rules and Policies</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Flight Changes</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">refunds</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Airline Penalties</a></li>
                                            <li class="col-sm-6 col-md-4 active"><a href="#">Flight Cancellation</a></li>
                                            <li class="col-sm-6 col-md-4"><a href="#">Airline terms of use</a></li>
                                        </ul>
                                    </div>
                                    <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                                    <div class="toggle-container">
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question1" data-toggle="collapse">Flight cancellation charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question1">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question2" data-toggle="collapse">WAmendment in higher class charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question2">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="" href="#question3" data-toggle="collapse">Amendment in same class charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse in" id="question3">
                                                <div class="panel-content">
                                                    <p>Sed a justo enim. Vivamus volutpat ipsum ultrices augue porta lacinia. Proin in elementum enim. <span class="skin-color">Duis suscipit justo</span> non purus consequat molestie. Etiam pharetra ipsum sagittis sollicitudin ultricies. Praesent luctus, diam ut tempus aliquam, diam ante euismod risus, euismod viverra quam quam eget turpis. Nam <span class="skin-color">tristique congue</span> arcu, id bibendum diam. Ut hendrerit, leo a pellentesque porttitor, purus arcu tristique erat, in faucibus elit leo in turpis vitae luctus enim, a mollis nulla.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question4" data-toggle="collapse">Rebooking/cancellation charges</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question4">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question5" data-toggle="collapse">Canellation through the customer support</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question5">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question6" data-toggle="collapse">Do we accept cancellations through email?</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question6">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel style1 arrow-right">
                                            <h4 class="panel-title">
                                                <a class="collapsed" href="#question7" data-toggle="collapse">What is the minimum day limit of cancellation?</a>
                                            </h4>
                                            <div class="panel-collapse collapse" id="question7">
                                                <div class="panel-content">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="sidebar col-md-3">
                    <article class="detailed-logo">
                        @if($request_data['trip_type'] == 'round')
                            <div class="details">
                                <h2 class="box-title">{{ $flightOne['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightOne['Segments'][0][count($flightOne['Segments'][0])-1]['Destination']['Airport']['CityName'] }}<small>Oneway flight</small>
                                    <small><b>{{ $request_data['adult'] }}</b> Adults and <b>{{ $request_data['child'] }}</b> Kids</small>
                                </h2>
                                <h2 class="box-title">{{ $flightTwo['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightTwo['Segments'][0][count($flightTwo['Segments'][0])-1]['Destination']['Airport']['CityName'] }}<small>Oneway flight</small>
                                    <small><b>{{ $request_data['adult'] }}</b> Adults and <b>{{ $request_data['child'] }}</b> Kids</small>
                                </h2>
                                <span class="price clearfix">
                                    <small class="pull-left">Total Amount</small>
                                    <span class="pull-right">&#8377;{{ $flightOne['Fare']['PublishedFare'] + $flightTwo['Fare']['PublishedFare'] }}</span>
                                </span>

                                {{-- <div class="duration">
                                    <i class="soap-icon-clock"></i>
                                    <dl>
                                        <dt class="skin-color">Total Time:</dt>
                                        <dd>13 Hour, 40 minutes</dd>
                                    </dl>
                                </div> --}}
                                <a href="javascript:void(0)" class="button green full-width uppercase btn-medium">book flight now</a>
                            </div>
                        @else
                            <div class="details">
                                <h2 class="box-title">{{ $flightData['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $flightData['Segments'][0][count($flightData['Segments'][0])-1]['Destination']['Airport']['CityName'] }}<small>Oneway flight</small>
                                    <small><b>2</b> Adults and <b>3</b> Kids</small>
                                </h2>
                                <span class="price clearfix">
                                    <small class="pull-left">Total Amount</small>
                                    <span class="pull-right">&#8377;{{ $flightData['Fare']['PublishedFare'] }}</span>
                                </span>

                                {{-- <div class="duration">
                                    <i class="soap-icon-clock"></i>
                                    <dl>
                                        <dt class="skin-color">Total Time:</dt>
                                        <dd>13 Hour, 40 minutes</dd>
                                    </dl>
                                </div> --}}
                                <a href="javascript:void(0)" class="button green full-width uppercase btn-medium">book flight now</a>
                            </div>
                        @endif
                    </article>
                    <div class="travelo-box contact-box">
                        <h4>Need Leavecasa Help?</h4>
                        <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                        <address class="contact-details">
                            <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                            <br>
                            <a class="contact-email" href="#">help@leavecasa.com</a>
                        </address>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection