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
            <li class="active">Flight Search</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">

            <!-- Toolbar -->
            <!--===================================================-->
            {!! Form::open() !!}
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Book Flight</h3>
                    </div>
                    <div class="panel-body">
                
                        <!-- Inline Form  -->
                        <!--===================================================-->
                        <form class="form-inline">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="flight-source">Source</label>
                                        {!! Form::select('from',$codesArray = \App\Model\IndiaAirportCitiesCode::city_codes(),null,['class'=>'form-control','placeholder'=>'Select Source','id'=>'demo-inline-inputmail']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="flight-destination">Destination</label>
                                        {!! Form::select('to',$codesArray,null,['class'=>'form-control','placeholder'=>'Select Destination','id'=>'flight-destination']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="adult_count">Adult Count</label>
                                        {!! Form::number('adult_count',null,['class'=>'form-control flght_adult_count','id'=>'adult_count']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="child_count">Child Count</label>
                                        {!! Form::number('child_count',0,['class'=>'form-control','id'=>'child_count']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="infant">Infant</label>
                                        {!! Form::number('infant',0,['class'=>'form-control flight_infant','id'=>'infant']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dflight">Direct Flight</label>
                                        {!! Form::select('direct_flight',['true'=>'Yes','false'=>'No'],null,['class'=>'form-control','id'=>'dflight']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="journey_type">Journey Type</label>
                                        {!! Form::select('journey_type',App\Helpers\FlightApi::journeyType(),1,['class'=>'form-control','id'=>'journey_type','placeholder'=>'Journey Type']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cabin_class">Flight Cabin Class</label>
                                        {!! Form::select('cabin_class',App\Helpers\FlightApi::cabinClasses(),1,['class'=>'form-control','id'=>'cabin_class','placeholder'=>'Cabin Class']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="departure_date">Preferred Departure</label>
                                        {!! Form::text('departure_date',null,['class'=>'form-control datePicker','id'=>'departure_date','placeholder'=>'Preferred Departure','autocomplete'=>'off','data-format'=>'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 return_date" style="display: none;">
                                    <div class="form-group">
                                        <label for="arrival_date">Return Date</label>
                                        {!! Form::text('return_date',null,['class'=>'form-control datePicker','id'=>'arrival_date','placeholder'=>'Return Date','autocomplete'=>'off','data-format'=>'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="add_mark">Included Markups?</label>
                                        {!! Form::select('include_markup',['1'=>'Yes','2'=>'No'],'2',['class'=>'form-control','id'=>'add_mark','placeholder'=>'Include Markups?']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-top: 2%;">
                                    <div class="form-group">
                                        <button class="btn btn-primary searchFlightForBooking" type="submit">Search Flight</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            {!! Form::close() !!}
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

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name=from]').select2();
            $('select[name=to]').select2();
        });
    </script>
@endsection