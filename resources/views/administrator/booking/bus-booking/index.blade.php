@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Bus Search</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Bus Search</li>
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
                        <h3 class="panel-title">Book Bus</h3>
                    </div>
                    <div class="panel-body">
                
                        <!-- Inline Form  -->
                        <!--===================================================-->
                        <form class="form-inline">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bus-source">Source</label>
                                        {!! Form::select('from',$sources,null,['class'=>'form-control busSource','placeholder'=>'Select Source','id'=>'bus-source']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bus-destination">Destination</label>
                                        {!! Form::select('destination',[],null,['class'=>'form-control busDestination','placeholder'=>'Select Destination','id'=>'bus-destination','required']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="departure_date">Journey Date</label>
                                        {!! Form::text('journey_date',null,['class'=>'form-control datePicker','id'=>'departure_date','placeholder'=>'Journey Date','autocomplete'=>'off','data-format'=>'yyyy-mm-dd']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-top: 2%;">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Search Bus</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            {!! Form::close() !!}


             <div class="search-background"></div>
                <div class="row search-spinner hotel-spinner">
                    <div class="col-md-12 text-center">
                        <h4 class="load_text">Getting Destination List..</h4>
                        <div class="sk-wandering-cubes">
                            <div class="sk-cube sk-cube1"></div>
                            <div class="sk-cube sk-cube2"></div>
                        </div>
                    </div>
                </div>

            <hr class="new-section-xs bord-no">
            @php
         // dd($searchResults);
            @endphp
            @if(!empty($searchResults['availableTrips']))
                <div class="panel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped bus_details">
                                <thead>
                                    <tr>
                                        <th width="90">Departure Time</th>
                                        <th width="80">Duration</th>
                                        <th width="88">Arrival Time</th>
                                        <th width="200">Bus Details</th>
                                        <th>Seats</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <input id="ctoken" type="hidden" value="{{csrf_token()}}">
                                    @foreach($searchResults['availableTrips'] as $key => $bus)
                                        <tr>
                                            <td>
                                                @php
                                                    $departureTime = $bus['departureTime'];
                                                    $hours = floor($departureTime/60)%24;
                                                    $minutes = $departureTime%60;
                                                    echo \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $timeElaps = $bus['arrivalTime'] - $bus['departureTime'];
                                                    $hours = floor($timeElaps/60)%24;
                                                    $minutes = $timeElaps%60;
                                                @endphp
                                                {{ $hours }}h, {{ $minutes }}m
                                            </td>
                                            <td>
                                                @php
                                                    $arrivalTime = $bus['arrivalTime'];
                                                    $hours = floor($arrivalTime/60)%24;
                                                    $minutes = $arrivalTime%60;
                                                    echo \Carbon\Carbon::parse($hours.':'.$minutes)->format('g:i a');
                                                @endphp
                                            </td>
                                            <td>
                                                <h5>{{ $bus['travels'] }}</h5>
                                                {{ $bus['busType'] }}
                                            </td>
                                            <td>
                                                <span style="color: {{ ($bus['availableSeats'] == 0)?'red':'#000' }}">Seats <b>{{ $bus['availableSeats'] }}</b> Left</span>
                                                <br/>
                                                <small>Available Windows Seat {{ $bus['avlWindowSeats'] }}</small>
                                            </td>
                                            <td>
                                                @if(is_array($bus['fares']))
                                                    <h4> &#8377; {{ round(max($bus['fares'])) }}</h4>
                                                @else
                                                    <h4> &#8377; {{ round($bus['fares']) }}</h4>
                                                @endif
                                            </td>
                                            <td>
                                                 

                                                <button class="btn btn-primary seat_details" data-id="{{ $bus['id'] }}" {{ ($bus['availableSeats'] == 0)?'disabled':'' }} data-boarding-points="{{ json_encode($bus['boardingTimes']) }}" data-droping-points="{{ json_encode($bus['droppingTimes']) }}" data-source="{{ request()->from }}" data-destination="{{ request()->destination }}">Book Now</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
    
    {{-- Bootstrap Model --}}
    <div class="modal_content">
        
    </div>

@endsection
@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'css/bus_booking.css?ref='.rand(111,999)) }}">
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset(env('FPATH').'js/bus_booking.js?ref='.rand(11111,99999)) }}"></script>
     <script type="text/javascript">
     $(document).ready(function(){
            $('select[name=from]').select2();
            $('select[name=destination]').select2();
        });
     </script>
    <script type="text/javascript">
        $(function(){
            window.selectedSeats = {};
            window.price = 0;
            $('body').on('click','.seat',function(){
                if(!$(this).hasClass('disabled')){
                    if($(this).hasClass('selected')){
                        $(this).removeClass('selected');
                        if($(this).hasClass('sleeper')){
                            $(this).find('img').attr('src','{{ asset('public/images/sleapper_seat.png') }}');
                        }else if($(this).hasClass('sitting')){
                            $(this).find('img').attr('src','{{ asset('public/images/bus_seat.png') }}');
                        }
                        delete selectedSeats[$(this).data('name')];
                        var tempArray = [];
                        $.each(selectedSeats, function(key,value){
                            tempArray.push(value);
                        });
                        price = price - parseFloat($(this).data('fare'));
                        $('.total_price').html(price);
                        $('input[name=total_price]').val(price);
                        $('.seats_selected').html(tempArray.join(','));
                        $('input[name=seats_selected]').val(tempArray.join(','));
                    }else{
                        if($('.maximum_seats').val() == Object.keys(selectedSeats).length){
                            $.niftyNoty({
                                type: 'danger',
                                container : 'floating',
                                title : 'Error',
                                message : 'You have selected maximum seats!',
                                closeBtn : true,
                                timer : 10000,
                            });
                            return false;
                        }
                        $(this).addClass('selected');
                        if($(this).hasClass('sleeper')){
                            $(this).find('img').attr('src','{{ asset('public/images/sleapper_seat_selected.png') }}');
                        }else if($(this).hasClass('sitting')){
                            $(this).find('img').attr('src','{{ asset('public/images/bus_seat_selected.png') }}');
                        }
                        var tempArray = [];
                        selectedSeats[$(this).data('name')] = $(this).data('name');
                        $.each(selectedSeats, function(key,value){
                            tempArray.push(value);
                        });
                        price = price + parseFloat($(this).data('fare'));
                        $('.total_price').html(price);
                        $('input[name=total_price]').val(price);
                        $('.seats_selected').html(tempArray.join(','));
                        $('input[name=seats_selected]').val(tempArray.join(','));
                    }
                }
            });
        });
    </script>
@endsection