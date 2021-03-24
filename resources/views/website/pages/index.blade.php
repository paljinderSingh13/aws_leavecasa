@extends('website.layout.website')
@section('content')
    <div class="backdrop full-screen-loader"></div>
    <img src="images/Spinner-1s-153px.gif" class="spinner-load full-screen-loader">
    <section id="content">
        <div class="search-box-wrapper">
            <div class="search-box container">
                <ul class="search-tabs clearfix">
                    <li class="active"><a href="#hotels-tab" data-toggle="tab">HOTELS</a></li>
                    <li><a href="#flights-tab" data-toggle="tab">FLIGHTS</a></li>
                    <li><a href="#bus" data-toggle="tab">BUS</a></li>
                    <li><a href="#flight-status-tab" data-toggle="tab">FLIGHT STATUS</a></li>
                </ul>
                <div class="visible-mobile">
                    <ul id="mobile-search-tabs" class="search-tabs clearfix">
                        <li class="active"><a href="#hotels-tab">HOTELS</a></li>
                        <li><a href="#flights-tab">FLIGHTS</a></li>
                        <li><a href="#bus">BUS</a></li>
                        <li><a href="#flight-status-tab">FLIGHT STATUS</a></li>
                    </ul>
                </div>
                
                <div class="search-tab-content">
                    <div class="tab-pane fade active in" id="hotels-tab">
                        <form action="{{ route('hotels.results') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-4">
                                    <h4 class="title">Country</h4>
                                    <label>Your Country</label>
                                    {!! Form::select('country',$countries,null,['class'=>'input-text full-width','placeholder'=>'Select country','id'=>'hotel_country']) !!}
                                </div>
                                <div class="form-group col-sm-6 col-md-4">
                                    <h4 class="title">City</h4>
                                    <label>Your City</label>
                                    {!! Form::select('city',[],null,['class'=>'input-text full-width','placeholder'=>'Select city','id'=>'cities']) !!}
                                </div>
                                <div class="form-group col-sm-6 col-md-4">
                                    <h4 class="title">Destination</h4>
                                    <label>Your Destination</label>
                                    {!! Form::select('destination',[],null,['class'=>'input-text full-width','placeholder'=>'Select destination','id'=>'destinations']) !!}
                                </div>
                                
                                <div class="form-group col-sm-12 col-md-12">
                                    <h4 class="title">When</h4>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label>Check In</label>
                                            <div class="datepicker-wrap">
                                                <input type="text" name="checkin" class="input-text full-width" placeholder="mm/dd/yy" />
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label>Check Out</label>
                                            <div class="datepicker-wrap">
                                                <input type="text" name="checkout" class="input-text full-width" placeholder="mm/dd/yy" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12" style="padding-top: 23px;">
                                            <button type="button" class="btn btn-primary add-more-rooms pull-right">Add More Room</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-12">
                                    <h4 class="title">Rooms</h4>
                                    <div class="rooms-list">
                                        <div class="row rooms-details">
                                            <div class="col-xs-3">
                                                <label>Adults</label>
                                                <div class="selector">
                                                    <select class="full-width" name="adults[]">
                                                        <option value="0">00</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Kids</label>
                                                <div class="selector">
                                                    <select class="full-width" name="kids[]">
                                                        <option value="0">00</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-sm-6 col-md-2 fixheight">
                                    <label class="hidden-xs">&nbsp;</label>
                                    <button type="submit" class="full-width icon-check animated" data-animation-type="bounce" data-animation-duration="1">SEARCH NOW</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="flights-tab">
                         {!! Form::open(['route'=>'search.results','id'=>'flight_search']) !!}
                         {!! Form::hidden('action','flight') !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="radio radio-inline">
                                            <input type="radio" name="trip_type" value="one_way" /> One Way
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="trip_type" value="round" /> Round Trip
                                        </label>
                                        <label class="radio radio-inline">
                                            <input type="radio" name="trip_type" value="multi_city" /> Multi City
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row one_way_round">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Leaving From</label>
                                        {!! Form::text('from',null,['class'=>'input-text full-width typeahead','placeholder'=>'City, Distirct','autocomplete'=>'off']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Going To</label>
                                        {!! Form::text('to',null,['class'=>'input-text full-width typeahead','placeholder'=>'City, Distirct','autocomplete'=>'off']) !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Departing On</label>
                                        <div class="datepicker-wrap">
                                            {!! Form::text('depart',null,['class'=>'input-text full-width','placeholder'=>'mm/dd/yy','autocomplete'=>'off']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 round_trip" style="display: none;">
                                    <div class="form-group">
                                        <label>Returning On</label>
                                        <div class="datepicker-wrap">
                                            {!! Form::text('returning',null,['class'=>'input-text full-width','placeholder'=>'mm/dd/yy','autocomplete'=>'off']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Adults</label>
                                        <div class="selector">
                                            <select class="full-width" name="adult">
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Kids</label>
                                        <div class="selector">
                                            <select class="full-width" name="child">
                                                <option value="0">00</option>
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Infants</label>
                                        <div class="selector">
                                            <select class="full-width" name="infants">
                                                <option value="0">00</option>
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>&nbsp;</label>
                                    <button class="full-width icon-check search_flight">SERACH NOW</button>
                                </div>
                            </div>
                        {!! Form::close() !!}

                        {!! Form::open(['route'=>'search.results','id'=>'flight_search_multi']) !!}
                        {!! Form::hidden('trip_type','multi_city') !!}
                         {!! Form::hidden('action','flight') !!}
                            <div class="multi_city_div" style="display: none;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Adults</label>
                                            <div class="selector">
                                                <select class="full-width" name="adult">
                                                    <option value="1">01</option>
                                                    <option value="2">02</option>
                                                    <option value="3">03</option>
                                                    <option value="4">04</option>
                                                    <option value="5">05</option>
                                                    <option value="6">06</option>
                                                    <option value="7">07</option>
                                                    <option value="8">08</option>
                                                    <option value="9">09</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kids</label>
                                            <div class="selector">
                                                <select class="full-width" name="child">
                                                    <option value="0">00</option>
                                                    <option value="1">01</option>
                                                    <option value="2">02</option>
                                                    <option value="3">03</option>
                                                    <option value="4">04</option>
                                                    <option value="5">05</option>
                                                    <option value="6">06</option>
                                                    <option value="7">07</option>
                                                    <option value="8">08</option>
                                                    <option value="9">09</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Infants</label>
                                            <div class="selector">
                                                <select class="full-width" name="infants">
                                                    <option value="0">00</option>
                                                    <option value="1">01</option>
                                                    <option value="2">02</option>
                                                    <option value="3">03</option>
                                                    <option value="4">04</option>
                                                    <option value="5">05</option>
                                                    <option value="6">06</option>
                                                    <option value="7">07</option>
                                                    <option value="8">08</option>
                                                    <option value="9">09</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label>&nbsp;</label>
                                        <button class="full-width icon-check search_flight">SERACH NOW</button>
                                    </div>
                                </div>
                                <div class="row multi_city">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Leaving From</label>
                                            {!! Form::text('from[]',null,['class'=>'input-text full-width typeahead','placeholder'=>'City, Distirct','autocomplete'=>'off']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Going To</label>
                                            {!! Form::text('to[]',null,['class'=>'input-text full-width typeahead','placeholder'=>'City, Distirct','autocomplete'=>'off']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Departing On</label>
                                            <div class="datepicker-wrap">
                                                {!! Form::text('depart[]',null,['class'=>'input-text full-width','placeholder'=>'mm/dd/yy','autocomplete'=>'off']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ad_more_button" style="padding-top: 2%;">
                                        <a href="javascript:void(0)" class="btn btn-primary add_more_flight"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="multi_city appended_row">
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    
                    
                    <div class="tab-pane fade" id="bus">
                        {!! Form::open(['route'=>'search.results']) !!}
                            {!! Form::hidden('action','bus') !!}
                            {!! Form::hidden('bus_from',null) !!}
                            {!! Form::hidden('bus_to',null) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    <h4 class="title">Where</h4>
                                    <div class="form-group">
                                        <label>Leaving From</label>
                                        <input type="text" class="input-text full-width cities_from" placeholder="city, distirct or specific airpot" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="title">Where</h4>
                                    <div class="form-group">
                                        <label>Going To</label>
                                        <input type="text" class="input-text full-width cities_to" placeholder="city, distirct or specific airpot" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="title">When</h4>
                                    <div class="form-group">
                                        <label>Journey Date</label>
                                        <div class="datepicker-wrap">
                                            <input type="text" class="input-text full-width" name="journey_date" placeholder="mm/dd/yy" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top: 3.2%;">
                                    <label>&nbsp;</label>
                                    <button class="full-width icon-check">SERACH NOW</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    
                    <div class="tab-pane fade" id="flight-status-tab">
                        <form action="flight-list-view.html" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="title">Where</h4>
                                    <div class="form-group row">
                                        <div class="col-xs-6">
                                            <label>Leaving From</label>
                                            <input type="text" class="input-text full-width" placeholder="enter a city or place name" />
                                        </div>
                                        <div class="col-xs-6">
                                            <label>Going To</label>
                                            <input type="text" class="input-text full-width" placeholder="enter a city or place name" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xs-6 col-md-2">
                                    <h4 class="title">When</h4>
                                    <div class="form-group">
                                        <label>Departure Date</label>
                                        <div class="datepicker-wrap">
                                            <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xs-6 col-md-2">
                                    <h4 class="title">Who</h4>
                                    <div class="form-group">
                                        <label>Flight Number</label>
                                        <input type="text" class="input-text full-width" placeholder="enter flight number" />
                                    </div>
                                </div>
                                <div class="form-group col-md-2 fixheight">
                                    <label class="hidden-xs">&nbsp;</label>
                                    <button class="icon-check full-width">SEARCH NOW</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Popuplar Destinations -->
       {{--  <div class="destinations section">
            <div class="container">
                <h2>Popular Destinations</h2>
                <div class="row image-box style1 add-clearfix">
                    <div class="col-sms-6 col-sm-6 col-md-3">
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="1">
                                <a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img src="http://placehold.it/270x160" alt="" width="270" height="160" /></a>
                            </figure>
                            <div class="details">
                                <span class="price"><small>FROM</small>$490</span>
                                <h4 class="box-title"><a href="hotel-detailed.html">Atlantis - The Palm<small>Paris</small></a></h4>
                            </div>
                        </article>
                    </div>
                    <div class="col-sms-6 col-sm-6 col-md-3">
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="1" data-animation-delay="0.3">
                                <a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img src="http://placehold.it/270x160" alt="" width="270" height="160" /></a>
                            </figure>
                            <div class="details">
                                <span class="price"><small>FROM</small>$170</span>
                                <h4 class="box-title"><a href="hotel-detailed.html">Hilton Hotel<small>LONDON</small></a></h4>
                            </div>
                        </article>
                    </div>
                    <div class="col-sms-6 col-sm-6 col-md-3">
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="1" data-animation-delay="0.6">
                                <a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img src="http://placehold.it/270x160" alt="" width="270" height="160" /></a>
                            </figure>
                            <div class="details">
                                <span class="price"><small>FROM</small>$130</span>
                                <h4 class="box-title"><a href="hotel-detailed.html">MGM Grand<small>LAS VEGAS</small></a></h4>
                            </div>
                        </article>
                    </div>
                    <div class="col-sms-6 col-sm-6 col-md-3">
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="1" data-animation-delay="0.9">
                                <a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img src="http://placehold.it/270x160" alt="" width="270" height="160" /></a>
                            </figure>
                            <div class="details">
                                <span class="price"><small>FROM</small>$290</span>
                                <h4 class="box-title"><a href="hotel-detailed.html">Crown Casino<small>ASUTRALIA</small></a></h4>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div> --}}
        
        
        <!-- Did you Know? section -->
    
        <!-- Features section -->
    </section>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[name=trip_type]').click(function(){
                if($(this).val() == 'round'){
                    $('.round_trip').fadeIn(300);
                    $('.one_way_round').show();
                    $('.multi_city_div').hide();
                }else if($(this).val() == 'one_way'){
                    $('.round_trip').fadeOut(300);
                    $('.one_way_round').show();
                    $('.multi_city_div').hide();
                }else{
                    $('.multi_city_div').show();
                    $('.one_way_round').hide();
                }
            });
        });
    </script>
@endsection