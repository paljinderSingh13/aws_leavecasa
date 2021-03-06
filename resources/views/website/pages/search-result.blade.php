@extends('website.layout.website')
@section('content')
    <section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b>1,984</b> results found.</h4>
                            <div class="toggle-container filters-container">
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                                    </h4>
                                    <div id="price-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <div id="price-range"></div>
                                            <br />
                                            <span class="min-price-label pull-left"></span>
                                            <span class="max-price-label pull-right"></span>
                                            <div class="clearer"></div>
                                        </div><!-- end content -->
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#flight-times-filter" class="collapsed">Flight Times</a>
                                    </h4>
                                    <div id="flight-times-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <div id="flight-times" class="slider-color-yellow"></div>
                                            <br />
                                            <span class="start-time-label pull-left"></span>
                                            <span class="end-time-label pull-right"></span>
                                            <div class="clearer"></div>
                                        </div><!-- end content -->
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#flight-stops-filter" class="collapsed">Flight Stops</a>
                                    </h4>
                                    <div id="flight-stops-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">1 Stop</a></li>
                                                <li><a href="#">2 Stops</a></li>
                                                <li class="active"><a href="#">3 Stops</a></li>
                                                <li><a href="#">MultiStops</a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#airlines-filter" class="collapsed">Airlines</a>
                                    </h4>
                                    <div id="airlines-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">Major Airline<small>($620)</small></a></li>
                                                <li><a href="#">United Airlines<small>($982)</small></a></li>
                                                <li class="active"><a href="#">delta airlines<small>($1,127)</small></a></li>
                                                <li><a href="#">Alitalia<small>($2,322)</small></a></li>
                                                <li><a href="#">US airways<small>($3,158)</small></a></li>
                                                <li><a href="#">Air France<small>($4,239)</small></a></li>
                                                <li><a href="#">Air tahiti nui<small>($5,872)</small></a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#flight-type-filter" class="collapsed">Flight Type</a>
                                    </h4>
                                    <div id="flight-type-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">Business</a></li>
                                                <li><a href="#">First class</a></li>
                                                <li class="active"><a href="#">Economy</a></li>
                                                <li><a href="#">Premium Economy</a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#inflight-experience-filter" class="collapsed">Inflight Experience</a>
                                    </h4>
                                    <div id="inflight-experience-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">Inflight Dining</a></li>
                                                <li><a href="#">Music</a></li>
                                                <li class="active"><a href="#">Sky Shopping</a></li>
                                                <li><a href="#">Wi-fi</a></li>
                                                <li><a href="#">Seats &amp; Cabin</a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>Leaving from</label>
                                                    <input type="text" class="input-text full-width" placeholder="" value="city, district, or specific airpot" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Departure on</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Arriving On</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                                <br />
                                                <button class="btn-medium icon-check uppercase full-width">search again</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9">
                            <div class="sort-by-section clearfix box">
                                <h4 class="sort-by-title block-sm">Sort results by:</h4>
                                <ul class="sort-bar clearfix block-sm">
                                    <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                                    <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                                    <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>duration</span></a></li>
                                </ul>
                                
                                <ul class="swap-tiles clearfix block-sm">
                                    <li class="swap-list active">
                                        <a href="flight-list-view.html"><i class="soap-icon-list"></i></a>
                                    </li>
                                    <li class="swap-grid">
                                        <a href="flight-grid-view.html"><i class="soap-icon-grid"></i></a>
                                    </li>
                                    <li class="swap-block">
                                        <a href="flight-block-view.html"><i class="soap-icon-block"></i></a>
                                    </li>
                                </ul>
                            </div>
                            @if($results['Response']['Error']['ErrorCode'] == 0)
                                <div class="flight-list listing-style3 flight">
                                    @foreach($results['Response']['Results'][0] as $key => $record)
                                        {{-- {{ dd($record['Segments'][0][0]['Baggage']) }} --}}
                                        <article class="box">
                                            <figure class="col-xs-3 col-sm-2">
                                                <img alt="" src="{{ asset('images/'.$record['Segments'][0][0]['Airline']['AirlineName'].'.jpg') }}" style="width: 100%;">
                                            </figure>
                                            <div class="details col-xs-9 col-sm-10">
                                                <div class="details-wrapper">
                                                    <div class="first-row">
                                                        <div>
                                                            <h4 class="box-title">{{ $record['Segments'][0][0]['Origin']['Airport']['CityName'] }} to {{ $record['Segments'][0][0]['Destination']['Airport']['CityName'] }}<small>{{ $record['Segments'][0][0]['Airline']['AirlineName'] }}</small>  Baggage: {{ $record['Segments'][0][0]['Baggage'] }}</h4>
                                                            @if($record['Segments'][0][0]['StopOver'] != false)
                                                                <a class="button btn-mini stop">{{ $record['Segments'][0][0]['StopOver'] }} STOP</a>
                                                            @endif
                                                            <div class="amenities">
                                                                <i class="soap-icon-wifi circle"></i>
                                                                <i class="soap-icon-entertainment circle"></i>
                                                                <i class="soap-icon-fork circle"></i>
                                                                <i class="soap-icon-suitcase circle"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <span class="price"><small>AVG/PERSON</small>???{{ $record['Fare']['PublishedFare'] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="second-row">
                                                        <div class="time">
                                                            <div class="take-off col-sm-4">
                                                                <div class="icon"><i class="soap-icon-plane-right yellow-color"></i></div>
                                                                <div>
                                                                    @php
                                                                        $departTime = $record['Segments'][0][0]['StopPointDepartureTime'];
                                                                        $departTime = explode('T',$departTime);
                                                                        $date = \Carbon\Carbon::parse($departTime[0]);
                                                                        $time = \Carbon\Carbon::parse($departTime[1]);
                                                                    @endphp
                                                                    <span class="skin-color">Take off</span><br />{{ $date->format('l') }} {{ $date->format('M') }} {{ $date->format('d') }}, {{ $date->format('Y') }} {{ $time->format('g:i A') }}
                                                                </div>
                                                            </div>
                                                            <div class="landing col-sm-4">
                                                                <div class="icon"><i class="soap-icon-plane-right yellow-color"></i></div>
                                                                <div>
                                                                    @php
                                                                        $departTime = $record['Segments'][0][0]['StopPointArrivalTime'];
                                                                        $departTime = explode('T',$departTime);
                                                                        $date = \Carbon\Carbon::parse($departTime[0]);
                                                                        $time = \Carbon\Carbon::parse($departTime[1]);
                                                                    @endphp
                                                                    <span class="skin-color">landing</span><br />{{ $date->format('l') }} {{ $date->format('M') }} {{ $date->format('d') }}, {{ $date->format('Y') }} {{ $time->format('g:i A') }}
                                                                </div>
                                                            </div>
                                                            <div class="total-time col-sm-4">
                                                                <div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
                                                                <div>
                                                                    @php
                                                                        $duration = $record['Segments'][0][0]['Duration'];
                                                                        $hours = $duration/60;
                                                                        $explodedHour = explode('.',$hours);
                                                                    @endphp
                                                                    <span class="skin-color">total time</span><br />{{ $explodedHour[0] }} Hour, {{ @substr(@$explodedHour[1], 0,2) }} minutes
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="action">
                                                            <a href="flight-detailed.html" class="button btn-small full-width">SELECT NOW</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                            <a class="button uppercase full-width btn-large">load more listings</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection