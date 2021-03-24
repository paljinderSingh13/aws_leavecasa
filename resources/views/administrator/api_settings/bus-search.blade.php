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
                <div class="panel">
                    <div class="panel-body">
                        <h3>Search Your Bus</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, eum, magni nesciunt soluta labore dolorem expedita ipsa asperiores temporibus suscipit maxime harum odit autem dolor recusandae impedit itaque adipisci rem..</p>
                        <form action="" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Source</label>
                                                <select class="form-control" name="source">
                                                    @foreach($sources['cities'] as $key => $value)
                                                        <option value="{{ $value['id'] }}">{{ $value['name'] }} ({{ @$value['state'] }})</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" class="form-control" name="from" placeholder="Exp: DEL" value="{{ request()->from }}"> --}}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Destination</label>
                                                <select class="form-control" name="destination">
                                                    @foreach($sources['cities'] as $key => $value)
                                                        <option value="{{ $value['id'] }}">{{ $value['name'] }} ({{ @$value['state'] }})</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" class="form-control" name="to" placeholder="Exp: BOM" value="{{ request()->to }}"> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group" id="demo-dp-txtinput">
                                                <label class="control-label">Date</label>
                                                <input type="text" class="form-control" name="to" placeholder="DD-MM-YYYY" value="{{ request()->to }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit" style="margin-top: 8.5%;">Search Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if(@$results['Response']['ResponseStatus'] == 3)
                            <span style="color: red">{{ $results['Response']['Error']['ErrorMessage'] }}</span>
                        @endif
                    </div>
                </div>  

                   @if(!empty($result))
                    <!-- 3 Column Layout -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Search Results</h3>
                        </div>
                        <div class="panel-body demo-liquid-fixed">
                            <p>This is a three-column layout where the side columns are fixed-width and the center column is liquid.</p>
                            <p>In this layout the side column widths are in pixels and the centre page adjusts in size to fill the rest of the screen. </p>
                            <hr>
                            <div id="sortingRow" class="row" style="background-color: #f5f5f5;">
                                <div class="col-lg-12 clearfix">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                                        <a href="javascript:;" class="row">BUS</a>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                        <a href="javascript:;" class="row">DEPARTURE</a>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 arrival_informtn">
                                        <a href="javascript:;" class="row">ARRIVAL</a>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 price_informtn">
                                        <a href="javascript:;" class="row">PRICE</a>
                                    </div>
                                    {{-- <div class="col-lg-3 col-md-3 col-sm-2 col-xs-4 price_informtn">
                                        <a href="javascript:;" class="row">Commision</a>
                                    </div> --}}
                                </div>
                            </div>
                           
                            @foreach($result['availableTrips'] as $key => $value)
                                {{-- {{ dd($value) }} --}}
                                <div class="row clearfix" style="margin-top: 2%; border-bottom: 1px solid #f5f5f5;">
                                    <div class="col-md-5" style="border-right: 1px solid #FFF;">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{ asset('images/bus.png') }}" style="width: 60%;">
                                            </div>
                                            <div class="col-md-6" style="padding-top: 2%;">
                                                <span>{{ $value['busTypeId'] }} ({{ $value['busType'] }})</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="border-right: 1px solid #FFF;">
                                        <div class="row">
                                            <div class="col-md-6" style="padding-top: 2%;">
                                                @php
                                                    $jDate = explode('T',$value['doj']);
                                                @endphp
                                                <span><b>{{ $jDate[0] }}</b></span>
                                                <span style="font-size: 10px;">{{ substr($value['departureTime'],0,2) }}: {{ substr($value['departureTime'],2,4) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="border-right: 1px solid #FFF;">
                                        <div class="row">
                                            <div class="col-md-6" style="padding-top: 2%;">
                                                
                                                <span><b>{{ $jDate[0] }}</b></span>
                                                <span style="font-size: 10px;">{{ substr($value['arrivalTime'],0,2) }}: {{ substr($value['arrivalTime'],2,4) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="border-right: 1px solid #FFF;">
                                        <span style="color: red; font-size: 18px">₹</span>
                                        <span style="color: red; font-size: 18px">{{ $value['fares'] }}</span>
                                    </div>
                                    {{-- <div class="col-md-3" style="border-right: 1px solid #FFF;">
                                        <span style="color: green; font-size: 18px">₹</span>
                                        <span style="color: green; font-size: 18px">fsdf</span>
                                    </div> --}}
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                   @endif
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection