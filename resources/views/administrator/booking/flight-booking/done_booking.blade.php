@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Booking Success</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Booking Success</li>
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
                    <h3 class="panel-title">Flight Booking Success</h3>
                </div>
                @php
                    $booking_response = json_decode($model->response_data)->Response->Response;
                @endphp
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="well">
                                <p style="font-size: 18px;"><i class="fa fa-check" style="color: green"></i> <b>Great</b>, your booking has been done. Your booking id is: <b>{{ $booking_response->BookingId }}</b></p>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right" onclick="window.location.href='{{ route('book.flight') }}'">Go Back To Search</button>
                            </div>
                            <div class="col-md-12">
                                <h4>Booking Details</h4>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td><b>PNR</b></td>
                                            <td>{{ $booking_response->PNR }}</td>

                                            <td><b>Booking ID</b></td>
                                            <td>{{ $booking_response->BookingId }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Origin</b></td>
                                            <td>{{ $booking_response->FlightItinerary->Segments[0]->Origin->Airport->AirportName  }} ({{ $booking_response->FlightItinerary->Segments[0]->Origin->Airport->CityName }})</td>

                                            <td><b>Destination</b></td>
                                            <td>{{ $booking_response->FlightItinerary->Segments[0]->Destination->Airport->AirportName  }} ({{ $booking_response->FlightItinerary->Segments[0]->Destination->Airport->CityName }})</td>
                                        </tr>

                                        <tr>
                                            <td><b>AirLine Code</b></td>
                                            <td>{{ $booking_response->FlightItinerary->AirlineCode }}</td>

                                            <td><b>Airline TollFree No</b></td>
                                            <td>{{ $booking_response->FlightItinerary->AirlineTollFreeNo }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Is Refundable</b></td>
                                            <td>{{ ($booking_response->FlightItinerary->NonRefundable == false)?'Yes':'No' }}</td>

                                            <td><b>Airline Last Ticket Date</b></td>
                                            <td>{{ $booking_response->FlightItinerary->LastTicketDate }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Booking Amount</b></td>
                                            <td>{{ $booking_response->FlightItinerary->Fare->PublishedFare }} {{ $booking_response->FlightItinerary->Fare->Currency }}</td>

                                            <td><b>Airline Name</b></td>
                                            <td>{{ $booking_response->FlightItinerary->Segments[0]->Airline->AirlineName }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Departure Time</b></td>
                                            <td>{{ $booking_response->FlightItinerary->Segments[0]->Origin->DepTime }}</td>

                                            <td><b>Arrival Time</b></td>
                                            <td>{{ $booking_response->FlightItinerary->Segments[0]->Destination->ArrTime }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Flight Status</b></td>
                                            <td style="color: green"><b>{{ $booking_response->FlightItinerary->Segments[0]->FlightStatus }}</b></td>

                                            <td><b>Issuance Pcc</b></td>
                                            <td>{{ $booking_response->FlightItinerary->IssuancePcc }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <h4>Passengers Details</h4>
                                <table class="table table-bodered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Passport No</th>
                                            <th>Contact No</th>
                                            <th>Date of Birth</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $passengers = $booking_response->FlightItinerary->Passenger;
                                        @endphp
                                        @foreach($passengers as $key => $passenger)
                                            <tr>
                                                <td>{{ $passenger->FirstName }} {{ $passenger->LastName }}</td>
                                                <td>{{ ($passenger->Gender == 1)?'Male':'Female' }}</td>
                                                <td>{{ $passenger->PassportNo }}</td>
                                                <td>{{ $passenger->ContactNo }}</td>
                                                <td>{{ $passenger->DateOfBirth }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <h4>Instructions</h4>
                                <pre>
                                    <p>{{ $booking_response->FlightItinerary->FareRules[0]->FareRuleDetail }}</p>
                                </pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="new-section-xs bord-no">
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <style type="text/css">
        pre{
            white-space: pre-wrap !important;       /* Since CSS 2.1 */
            white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
            white-space: -pre-wrap !important;      /* Opera 4-6 */
            white-space: -o-pre-wrap !important;    /* Opera 7 */
            word-wrap: break-word !important; 
        }
    </style>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection