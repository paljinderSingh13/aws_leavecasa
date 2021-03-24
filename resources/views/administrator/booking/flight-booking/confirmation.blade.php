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
            <li class="active">Booking Confirmation</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <!-- Toolbar -->
            <!--===================================================-->
            
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Booking Confirmation</h3>
                </div>
                <div class="panel-body">
                    @php
                        if(@$flight_details['journey_type'] == 1){
                            $segments = json_decode($flight_details['flight_details'],true)['Segments'][0][0];
                            $flightDetails = json_decode($flight_details['flight_details'],true);
                        }elseif($flight_details['journey_type'] == 2){
                            $segments_1 = json_decode($flight_details['flight_details_1'],true)['Segments'][0][0];
                            $segments_2 = json_decode($flight_details['flight_details_2'],true)['Segments'][0][0];
                            $flightDetails_1 = json_decode($flight_details['flight_details_1'],true);
                            $flightDetails_2 = json_decode($flight_details['flight_details_2'],true);
                        }
                    @endphp
                    @if($flight_details['journey_type'] == 1)
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
                            </div>
                        </div>
                    @elseif($flight_details['journey_type'] == 2)
                        <div class="row">
                            <div class="col-md-3" style="border: 1px solid #CCC;">
                                <img src="{{ asset('images/'.$segments_1['Airline']['AirlineName']) }}.jpg" style="width: 100%;" />
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="height: 189px;">
                                    <tbody>
                                        <tr>
                                            <td width="120"><b>Source</b></td>
                                            <td width="300">{{ $segments_1['Origin']['Airport']['AirportName'] }}</td>

                                            <td width="120"><b>Destination</b></td>
                                            <td>{{ $segments_1['Destination']['Airport']['AirportName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Baggage</b></td>
                                            <td width="300">{{ $segments_1['Baggage'] }}</td>

                                            <td width="120"><b>Departure Time</b></td>
                                            <td>{{ $segments_1['Origin']['DepTime'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Arrival Time</b></td>
                                            <td width="300">{{ $segments_1['Destination']['ArrTime'] }}</td>

                                            <td width="120"><b>Airline</b></td>
                                            <td>{{ $segments_1['Airline']['AirlineName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Published Fare</b></td>
                                            <td width="300"><b>&#8377; {{ $flightDetails_1['Fare']['PublishedFare'] }}</b></td>

                                            <td width="120"><b>Duration</b></td>
                                            <td>{{ $segments_1['Duration'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Airline Code</b></td>
                                            <td width="300">{{ $segments_1['Airline']['AirlineCode'] }}</td>

                                            <td width="120"><b>Flight Number</b></td>
                                            <td>{{ $segments_1['Airline']['FlightNumber'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style="border: 1px solid #CCC;">
                                <img src="{{ asset('images/'.$segments_2['Airline']['AirlineName']) }}.jpg" style="width: 100%;" />
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered" style="height: 189px;">
                                    <tbody>
                                        <tr>
                                            <td width="120"><b>Source</b></td>
                                            <td width="300">{{ $segments_2['Origin']['Airport']['AirportName'] }}</td>

                                            <td width="120"><b>Destination</b></td>
                                            <td>{{ $segments_2['Destination']['Airport']['AirportName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Baggage</b></td>
                                            <td width="300">{{ $segments_2['Baggage'] }}</td>

                                            <td width="120"><b>Departure Time</b></td>
                                            <td>{{ $segments_2['Origin']['DepTime'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Arrival Time</b></td>
                                            <td width="300">{{ $segments_2['Destination']['ArrTime'] }}</td>

                                            <td width="120"><b>Airline</b></td>
                                            <td>{{ $segments_2['Airline']['AirlineName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Published Fare</b></td>
                                            <td width="300"><b>&#8377; {{ $flightDetails_2['Fare']['PublishedFare'] }}</b></td>

                                            <td width="120"><b>Duration</b></td>
                                            <td>{{ $segments_2['Duration'] }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120"><b>Airline Code</b></td>
                                            <td width="300">{{ $segments_2['Airline']['AirlineCode'] }}</td>

                                            <td width="120"><b>Flight Number</b></td>
                                            <td>{{ $segments_2['Airline']['FlightNumber'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    <div class="row" style="margin-bottom: 2%;">
                        <div class="col-md-12">
                            {{-- <button class="btn btn-primary pull-right add_passenger">+ Add Passenger</button> --}}
                            {{-- <button class="btn btn-default pull-left reload_list"><i class="fa fa-refresh"></i> Reload List</button> --}}
                        </div>
                    </div>
                    {!! Form::open(['route'=>'process.payment','class'=>'payment_process']) !!}
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
                                            </tr>
                                        </thead>
                                        <tbody class="customers_list">
                                            @php
                                                $customers_count = 0;
                                            @endphp
                                            @foreach($customers as $key => $customer)
                                                <tr>
                                                    <td>{{ $customer['first_name'] }} {{ $customer['last_name'] }}</td>
                                                    <td>{{ $customer['email'] }}</td>
                                                    <td>{{ ($customer['gender'] == '1')?'Male':'Female' }}</td>
                                                    <td>{{ $customer['contact_number'] }}</td>
                                                    <td>{{ $customer['city'] }}</td>
                                                </tr>
                                                @php
                                                    $customers_count++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <b>Total Amount: </b>
                                <span class="total_amount"><b style="color: red">&#8377; {{ $flight_details['single_amount'] }}</b></span>
                            </div>
                            <div class="col-md-3">
                                Pay From Wallet <input id="demo-sw-clr1" type="checkbox" class="payment_from">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success pull-right process_button">Process Payment</button>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
            <hr class="new-section-xs bord-no">
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection