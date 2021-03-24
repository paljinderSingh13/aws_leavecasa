@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Flight Search</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Booking Details</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <!-- Toolbar -->
            <!--===================================================-->
            @php
                if($request->has('journey_type') && $request->journey_type != 2){
                    $flightDetails = json_decode($request->flight_details,true);
                    $segments = $flightDetails['Segments'][0][0];
                }else{
                    $flight_details_1 = json_decode($request->flight_details_1, true);
                    $flight_details_2 = json_decode($request->flight_details_2, true);
                    $segment_1 = $flight_details_1['Segments'][0][0];
                    $segment_2 = $flight_details_2['Segments'][0][0];
                }
            @endphp
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Flight Details</h3>
                </div>
                <div class="panel-body">
            
                    <!-- Inline Form  -->
                    <!--===================================================-->
                    @if($request->journey_type == 1)
                        <div class="row">
                            <div class="col-md-3" style="border: 1px solid #CCC;">
                                <img src="{{ asset('images/'.$segments['Airline']['AirlineName']) }}.jpg" style="width: 100%;" />
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="height: 189px;">
                                    <tbody>
                                        <tr>
                                            <td width="120"><b>Source</b></td>
                                            <td width="300">{{ $segments['Origin']['Airport']['AirportName'] }}</td>

                                            <td width="120"><b>Destination</b></td>
                                            <td>{{ $segments['Destination']['Airport']['AirportName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Baggage</b></td>
                                            <td width="300">{{ $segments['Baggage'] }}</td>

                                            <td width="120"><b>Departure Time</b></td>
                                            <td>{{ $segments['Origin']['DepTime'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Arrival Time</b></td>
                                            <td width="300">{{ $segments['Destination']['ArrTime'] }}</td>

                                            <td width="120"><b>Airline</b></td>
                                            <td>{{ $segments['Airline']['AirlineName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Published Fare</b></td>
                                            <td width="300"><b>&#8377; {{ $flightDetails['Fare']['PublishedFare'] }}</b></td>

                                            <td width="120"><b>Duration</b></td>
                                            <td>{{ $segments['Duration'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Airline Code</b></td>
                                            <td width="300">{{ $segments['Airline']['AirlineCode'] }}</td>

                                            <td width="120"><b>Flight Number</b></td>
                                            <td>{{ $segments['Airline']['FlightNumber'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                        Want insurance <input id="demo-sw-clr1" type="checkbox" class="want_insurance pull-right">  
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-3" style="border: 1px solid #CCC;">
                                <img src="{{ asset('images/'.$segment_1['Airline']['AirlineName']) }}.jpg" style="width: 100%;" />
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="height: 189px;">
                                    <tbody>
                                        <tr>
                                            <td width="120"><b>Source</b></td>
                                            <td width="300">{{ $segment_1['Origin']['Airport']['AirportName'] }}</td>

                                            <td width="120"><b>Destination</b></td>
                                            <td>{{ $segment_1['Destination']['Airport']['AirportName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Baggage</b></td>
                                            <td width="300">{{ $segment_1['Baggage'] }}</td>

                                            <td width="120"><b>Departure Time</b></td>
                                            <td>{{ $segment_1['Origin']['DepTime'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Arrival Time</b></td>
                                            <td width="300">{{ $segment_1['Destination']['ArrTime'] }}</td>

                                            <td width="120"><b>Airline</b></td>
                                            <td>{{ $segment_1['Airline']['AirlineName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Published Fare</b></td>
                                            <td width="300"><b>&#8377; {{ $flight_details_1['Fare']['PublishedFare'] }}</b></td>

                                            <td width="120"><b>Duration</b></td>
                                            <td>{{ $segment_1['Duration'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Airline Code</b></td>
                                            <td width="300">{{ $segment_1['Airline']['AirlineCode'] }}</td>

                                            <td width="120"><b>Flight Number</b></td>
                                            <td>{{ $segment_1['Airline']['FlightNumber'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style="border: 1px solid #CCC;">
                                <img src="{{ asset('images/'.$segment_2['Airline']['AirlineName']) }}.jpg" style="width: 100%;" />
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="height: 189px;">
                                    <tbody>
                                        <tr>
                                            <td width="120"><b>Source</b></td>
                                            <td width="300">{{ $segment_2['Origin']['Airport']['AirportName'] }}</td>

                                            <td width="120"><b>Destination</b></td>
                                            <td>{{ $segment_2['Destination']['Airport']['AirportName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Baggage</b></td>
                                            <td width="300">{{ $segment_2['Baggage'] }}</td>

                                            <td width="120"><b>Departure Time</b></td>
                                            <td>{{ $segment_2['Origin']['DepTime'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Arrival Time</b></td>
                                            <td width="300">{{ $segment_2['Destination']['ArrTime'] }}</td>

                                            <td width="120"><b>Airline</b></td>
                                            <td>{{ $segment_2['Airline']['AirlineName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Published Fare</b></td>
                                            <td width="300"><b>&#8377; {{ $flight_details_2['Fare']['PublishedFare'] }}</b></td>

                                            <td width="120"><b>Duration</b></td>
                                            <td>{{ $segment_2['Duration'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Airline Code</b></td>
                                            <td width="300">{{ $segment_2['Airline']['AirlineCode'] }}</td>

                                            <td width="120"><b>Flight Number</b></td>
                                            <td>{{ $segment_2['Airline']['FlightNumber'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                        Want insurance <input id="demo-sw-clr1" type="checkbox" class="want_insurance pull-right">  
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $totalAmount = $flight_details_1['Fare']['PublishedFare'];
                            $totalAmount = $totalAmount+$flight_details_2['Fare']['PublishedFare'];
                        @endphp
                    @endif

                    <div class="row" style="margin-bottom: 2%;">
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right add_passenger">+ Add Passenger</button>
                            <button class="btn btn-default pull-left reload_list"><i class="fa fa-refresh"></i> Reload List</button>
                        </div>
                    </div>
                    {!! Form::open(['route'=>'book.flight.now']) !!}
                        @if($request->journey_type == 1)
                            {!! Form::hidden('trace_id',$request->traceid) !!}
                            {!! Form::hidden('single_amount',$request->total_amount) !!}
                            {!! Form::hidden('journey_type',$request->journey_type) !!}
                            {!! Form::hidden('flight_details',$request->flight_details) !!}
                        @else
                            {!! Form::hidden('trace_id',$request->traceid_2) !!}
                            {!! Form::hidden('single_amount',$totalAmount) !!}
                            {!! Form::hidden('journey_type',$request->journey_type) !!}
                            {!! Form::hidden('flight_details_1',$request->flight_details_1) !!}
                            {!! Form::hidden('flight_details_2',$request->flight_details_2) !!}
                        @endif
                        @php
                            $requestData = json_decode($request->search_request);                            
                            $passengersCount = $requestData->adult_count;
                            $passengersCount = $passengersCount + $requestData->child_count;
                            $passengersCount = $passengersCount + $requestData->infant;
                        @endphp
                        {!! Form::hidden('total_passengers',$passengersCount) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Contact</th>
                                                <th>City</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="customers_list">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <b>Total Amount: </b>
                                @if($request->journey_type == 2)
                                    <span class="total_amount">&#8377; {{ $totalAmount }}</span>
                                @else
                                    <span class="total_amount">&#8377; {{ $request->total_amount }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success pull-right">Book Now</button>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
            <hr class="new-section-xs bord-no">

            <div class="search-background"></div>
            <div class="row search-spinner">
                <div class="col-md-12 text-center">
                    <h4>Searching Your Flights..</h4>
                    <div class="sk-wandering-cubes">
                        <div class="sk-cube sk-cube1"></div>
                        <div class="sk-cube sk-cube2"></div>
                    </div>
                </div>
            </div>
            <div class="search-results">

            </div>
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection