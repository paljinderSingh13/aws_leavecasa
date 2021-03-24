@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Bus Booking Passenger Details</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Passenger details</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">

            <!-- Toolbar -->
            <!--===================================================-->
            {!! Form::open(['route'=>'book.bus.now']) !!}
                <input type="hidden" name="booking_details" value="{{ json_encode($request->all()) }}">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bus Passenger Details</h3>
                    </div>
                    <div class="panel-body">
                        <!-- Inline Form  -->
                        <!--===================================================-->
                        @php
                            $requestData = $request->all();
                            $seats = explode(',', $requestData['seats_selected']);
                        @endphp
                        @foreach($seats as $key => $seat)
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="flight-source">Title</label>
                                        {!! Form::select('title[]',App\Model\BusBookingSource::getMrMrs(), null,['class'=>'form-control','placeholder'=>'--Select--']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="flight-destination">Name</label>
                                        {!! Form::text('name[]',null,['class'=>'form-control','placeholder'=>'Enter name','id'=>'flight-destination']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="flight-source">Gender</label>
                                        {!! Form::select('gender[]',['Male'=>'Male','Female'=>'Female'], null,['class'=>'form-control','placeholder'=>'--Select--']) !!}
                                    </div>
                                </div>
                                {{-- <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="flight-destination">Gender</label>
                                        <div class="radio">
                                            <!-- Inline radio buttons -->
                                            {!! Form::radio('gender_'.$loop->index.'[]','Male', null, ['class'=>'magic-radio','id'=>'demo-inline-form-radio_0_'.($loop->index)]) !!}
                                            <label for="demo-inline-form-radio_0_{{ $loop->index }}">Male</label>
                                            
                                            {!! Form::radio('gender_'.$loop->index.'[]','Female',null, ['class'=>'magic-radio','id'=>'demo-inline-form-radio_1_'.($loop->index)]) !!}
                                            <label for="demo-inline-form-radio_1_{{ $loop->index }}">Female</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="flight-destination">Age</label>
                                        {!! Form::text('age[]',null,['class'=>'form-control','placeholder'=>'Enter age','id'=>'flight-destination']) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr class="new-section-xs bord-no">
                        <h4>Contact Details</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="flight-source">Mobile</label>
                                    {!! Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Entre Mobile','autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="flight-destination">Email</label>
                                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email id','id'=>'flight-destination','autocomplete'=>'off']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="departure_date">Address</label>
                                    {!! Form::text('address',null,['class'=>'form-control','placeholder'=>'Enter Address','autocomplete'=>'off']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="departure_date">Id Number</label>
                                    {!! Form::text('id_no',null,['class'=>'form-control','placeholder'=>'Enter Id Number','autocomplete'=>'off']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="departure_date">ID Proof Type</label>
                                    {!! Form::select('id_proof_type',App\Model\BusBookingSource::getIdProofs(),null,['class'=>'form-control','placeholder'=>'Select ID Proof Type','autocomplete'=>'off']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2" style="padding-top: 2%;">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
  

@endsection
@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bus_booking.css?ref='.rand(111,999)) }}">
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('js/bus_booking.js?ref='.rand(11111,99999)) }}"></script>
@endsection