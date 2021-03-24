@extends('website.layout.website')
@section('content')
    <section id="content">
        <div class="container flight-detail-page">
            <div class="row">
                <div id="main" class="col-md-9">
                    
                    {{-- @php dump(session()->get('selected_bus')) @endphp --}}

                    @php
                        $record = session()->get('selected_bus')['record'];
                        //dump($record);
                       $data = session()->get('selected_bus');

                      // dump($data);
                    @endphp
                    
                    <div id="flight-features" class="tab-container">                        
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="flight-details">
                                <div class="intro table-wrapper full-width hidden-table-sm box">
                                    <div class="col-md-4 table-cell travelo-box">
                                        <dl class="term-description">
                                            <dt>AC:</dt><dd>{{ $record['AC'] ? 'Yes' : 'No' }}</dd>
                                   
                                            <dt>Available Seats:</dt><dd>{{ $record['availableSeats'] }}</dd>
                                            <dt>Avail Window Seats:</dt><dd>{{ $record['avlWindowSeats'] }}</dd>
                                            {{-- <dt>Provider:</dt><dd>{{ $record['boardingTimes']['bpName'] }}</dd> --}}
                                            <dt>Bus Tye:</dt><dd>{{ $record['busType'] }}</dd>
                                            <dt>DOJ:</dt><dd>{{ $record['doj'] }}</dd>
                                            <dt>Amount:</dt><dd>{{  $record['fares'] }}</dd>
                                        </dl>
                                    </div>

                                    @php
                                        // dd("  workin here");
                                    @endphp

                                    <div class="col-md-8 table-cell">
                                        <div class="detailed-features booking-details">
                                            <div class="travelo-box">
                                                {{-- <a href="#" class="button btn-mini yellow pull-right">1 STOP</a> --}}
                                              {{--   <h4 class="box-title">{{ App\Model\BusBookingSource::city_code_to_name($data['source']) }} to {{ App\Model\BusBookingSource::city_code_to_name($data['destination']) }} </h4> --}}
                                            </div>
                                            <div class="table-wrapper flights">
                                                <div class="table-row first-flight">
                                                    <div class="table-cell logo">
                                                        <label>{{ $record['busTypeId'] }}</label>
                                                    </div>
                                                    <div class="table-cell timing-detail">
                                                        <div class="timing">
                                                            <div class="check-in">
                                                                <label>Departure</label>
                                                                
                                                                <span>
                                                                    @php
                                                                        $departureTime = $record['departureTime'];
                                                                        $hours = floor($departureTime/60)%24;
                                                                        $minutes = $departureTime%60;
                                                                        $dateOfJourney = explode('T',$record['doj']);
                                                                        echo $dateOfJourney[0].' ';
                                                                        echo \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                                                                    @endphp
                                                                </span>
                                                            </div>
                                                            <div class="duration text-center">
                                                                <i class="soap-icon-clock"></i>
                                                                <span>
                                                                    @php
                                                                        $timeElaps = $record['arrivalTime'] - $record['departureTime'];
                                                                        $hours = floor($timeElaps/60)%24;
                                                                        $minutes = $timeElaps%60;
                                                                    @endphp
                                                                    {{ $hours }}h, {{ $minutes }}m
                                                                </span>
                                                            </div>
                                                            <div class="check-out">
                                                                <label>Arrival</label>
                                                                <span>
                                                                    @php
                                                                        $departureTime = $record['arrivalTime'];
                                                                        $hours = floor($departureTime/60)%24;
                                                                        $minutes = $departureTime%60;
                                                                        $dateOfJourney = explode('T',$record['doj']);
                                                                        echo $dateOfJourney[0].' ';
                                                                        echo \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                                                                    @endphp
                                                                </span>
                                                            </div>
                                                        </div>
                                                        {{-- <label class="layover">Layover : 3h 50m</label> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::open(['route'=>'webste.book.bus']) !!}

                                 <input type="text" name="trip_id" value="{{$record['id']  }}">
                                 {{-- <input type="text" name="trip_id" value="{{$req_data['seats_selected']  }}"> --}}
                                 <input type="text" name="total_price" value="{{$req_data['total_price']  }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Bus Passenger Details</h3>
                                            @php
                                                $selectedSeats = explode(',',request()->seats_selected);

                                                // dump( $selectedSeats);
                                            @endphp
                                            @foreach($selectedSeats as $key => $seat)

                                             <input class="form-control" name="seat[]" type="text" value="{{ $selectedSeats[$key] }}">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="flight-source">Title</label>
                                                            <select class="form-control" name="title[]"><option selected="selected" value="">--Select--</option><option value="Mr">Mr.</option><option value="Mrs">Mrs.</option><option value="Ms">Ms.</option></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="flight-destination">Name</label>
                                                            <input class="form-control" placeholder="Enter name" id="flight-destination" name="name[]" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="flight-source">Gender</label>
                                                            <select class="form-control" name="gender[]"><option selected="selected" value="">--Select--</option><option value="Male">Male</option><option value="Female">Female</option></select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="flight-destination">Age</label>
                                                            <input class="form-control" placeholder="Enter age" id="flight-destination" name="age[]" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <h3>Contact Details</h3>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="flight-source">Mobile</label>
                                                        <input class="form-control" placeholder="Entre Mobile" autocomplete="off" name="mobile" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="flight-destination">Email</label>
                                                        <input class="form-control" placeholder="Enter Email id" id="flight-destination" autocomplete="off" name="email" type="text">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="departure_date">Address</label>
                                                        <input class="form-control" placeholder="Enter Address" autocomplete="off" name="address" type="text">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="departure_date">Id Number</label>
                                                        <input class="form-control" placeholder="Enter Id Number" autocomplete="off" name="id_no" type="text">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="departure_date">ID Proof Type</label>
                                                        <select class="form-control" autocomplete="off" name="id_proof_type"><option selected="selected" value="">Select ID Proof Type</option><option value="Pan Card">Pan Card</option><option value="Driving Licence">Driving Licence</option><option value="Voting Card">Voting Card</option><option value="Aadhar Card">Aadhar Card</option></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2" style="padding-top: 2%;">
                                                    <div class="form-group">
                                                        <button class="button green full-width uppercase btn-medium" type="submit">Book Bus Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar col-md-3">
                    <article class="detailed-logo">
                        <div class="details">
                            <h2 class="box-title">Amritsar to Delhi
                                {{-- <small>Oneway flight</small> --}}
                                <small><b>{{ count($selectedSeats) }}</b> Adults</small>
                            </h2>
                            <span class="price clearfix">
                                <small class="pull-left">Total Amount</small>
                                <span class="pull-right">&#8377; {{  $record['fares']}}</span>
                            </span>
                            <a href="javascript:void(0)" class="button green full-width uppercase btn-medium">book bus now</a>
                        </div>
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