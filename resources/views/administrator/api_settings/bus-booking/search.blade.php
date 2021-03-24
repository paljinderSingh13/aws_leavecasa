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
                {{--<div class="panel">
                    <div class="panel-body">
                        <h3>Search Your Bus</h3>
                        <p>Search your busses.</p>
                        <form action="{{route('search.bus')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Source</label>
                                                <select class="form-control" name="source">
                                                    <option value="all">All</option>
                                                    @foreach($sources['cities'] as $key => $value)
                                                        <option value="{{ $value['id'] }}">{{ $value['name'] }} ({{ @$value['state'] }})</option>
                                                    @endforeach
                                                </select>
                                                --}}{{-- <input type="text" class="form-control" name="from" placeholder="Exp: DEL" value="{{ request()->from }}"> --}}{{--
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Destination</label>
                                                <select class="form-control" name="destination">
                                                    <option value="all">All</option>
                                                    @foreach($sources['cities'] as $key => $value)
                                                        <option value="{{ $value['id'] }}">{{ $value['name'] }} ({{ @$value['state'] }})</option>
                                                    @endforeach
                                                </select>
                                                --}}{{-- <input type="text" class="form-control" name="to" placeholder="Exp: BOM" value="{{ request()->to }}"> --}}{{--
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Journy Date</label>
                                                <input type="text" class="form-control datePicker" name="to" autocomplete="off" placeholder="YYYY-MM-DD" data-format="yyyy-mm-dd" value="{{request()->to}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit" style="margin-top: 8.5%;">Search Bus</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if(@$results['Response']['ResponseStatus'] == 3)
                            <span style="color: red">{{ $results['Response']['Error']['ErrorMessage'] }}</span>
                        @endif
                    </div>
                </div>--}}
                <div class="panel">
                    <div class="panel-body">
                        <h3>Create Your Markup</h3>
                        <p>Create your busses markups according to your route or all routes.</p>
                        <form action="{{route('save.bus-markups')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Source</label>
                                                {!! Form::select('source',$sources,null,['class'=>'form-control busSource','placeholder'=>'Select Source']) !!}
                                                {{-- <input type="text" class="form-control" name="from" placeholder="Exp: DEL" value="{{ request()->from }}"> --}}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Destination</label>
                                                {!! Form::select('destination',[],null,['class'=>'form-control busDestination','placeholder'=>'Select Destination']) !!}
                                                {{-- <input type="text" class="form-control" name="to" placeholder="Exp: BOM" value="{{ request()->to }}"> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        {{--<div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Date</label>
                                                <input type="text" class="form-control datePicker" name="to"
                                                        placeholder="YYYY-MM-DD" data-format="yyyy-mm-dd" value="{{
                                                        request()->to
                                                        }}">
                                            </div>
                                        </div>--}}
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Amount By</label>
                                                <select name="amount_by" class="form-control">
                                                    <option value="percent">Percent</option>
                                                    <option value="rupee">Rupee</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Amount Or Percent</label>
                                                <input type="text" name="amount_or_percent" value=""
                                                        placeholder="Amount Or Percent" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit" style="margin-top: 8.5%;">Save Markup</button>
                                    </div>
                                </div>
                            </div>
                        </form>

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


                        @if(@$results['Response']['ResponseStatus'] == 3)
                            <span style="color: red">{{ $results['Response']['Error']['ErrorMessage'] }}</span>
                        @endif
                    </div>
                </div>
                        {{-- {!! $dataTable->table() !!} --}}

                  <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Your Current Busses Markups</h3>
                        </div>
                        <div class="panel-body">
                            <table id="bus-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Source</th>
                                        <th class="min-tablet">Destination</th>
                                        <th class="min-tablet">Amount By</th>
                                        <th class="min-desktop">Amount Or Percent</th>
                                        <th class="min-desktop">Created At</th>
                                        <th class="min-desktop">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($result))
                                    @foreach($result as $key => $val)
                                    <tr>
                                        <td>{{$sources[$val->source]}} </td>
                                        <td> @if(!empty($val->des))
                                             {{$val->des->city_name}}

                                             @else
                                                 {{$val->destination}}
                                             @endif
                                         </td>
                                        <td>{{$val->amount_by}}</td>
                                        <td>{{$val->amount_or_percent}}</td>
                                      
                                        <td> {{$val->created_at}} </td>
                                        <td><div class="btn-group">
                                        <a class="add-tooltip" href="{{route('delete.bus_markup',['id'=>$val->id])}}" data-original-title="Delete" data-container="body"><i class="fa fa-trash red"></i></a>
                                        </div></td>
                                    </tr>                                    
                                    @endforeach
                                    @endif
                                   </tbody>
                                </table>
                            </div>
                        </div>


                   {{-- @if(!empty($result))
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
                                </div>
                            </div>
                           
                            @foreach($result['availableTrips'] as $key => $value)
                              
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
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                   @endif --}}
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
            $('select[name=source]').select2();
            $('select[name=destination]').select2();
            $('#bus-list').DataTable();
        });
     </script>
     @endsection