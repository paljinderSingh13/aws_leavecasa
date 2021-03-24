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

            <div class="row pad-btm">
                <form action="#" method="post" class="col-xs-12 col-sm-10 col-sm-offset-1 pad-hor">
                    <div class="input-group mar-btm">
                        <input type="text" placeholder="Search posts..." class="form-control input-lg">
                        <span class="input-group-btn">
					                     <button class="btn btn-primary btn-lg" type="button">Search</button>
					                 </span>
                    </div>
                </form>
            </div>

            <!-- Toolbar -->
            <!--===================================================-->
            {!! Form::open() !!}
                <div class="pad-all text-center">
                    <div class="box-inline mar-btm pad-rgt">
                        From :
                        <div class="">
                            {!! Form::select('from',\App\Model\IndiaAirportCitiesCode::city_codes(),'ATQ',['class'=>'form-control','placeholder'=>'Select Source']) !!}
                        </div>
                    </div>
                    <div class="box-inline mar-btm pad-rgt">
                        To :
                        <div class="">
                            {!! Form::select('to',\App\Model\IndiaAirportCitiesCode::city_codes(),'DEL',['class'=>'form-control','placeholder'=>'Select Source']) !!}
                        </div>
                    </div>
                    <div class="box-inline mar-btm">
                        Adult :
                        <div class="select">
                            <select class="form-control" name="adult_count">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-inline mar-btm">
                        Childs :
                        <div class="select">
                            <select class="form-control" name="childs_count">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inline mar-btm pad-rgt">
                                <label class="control-label">Departure</label>
                                {!! Form::text('departure',null,['class'=>'form-control datepicker','placeholder'=>'YYYY-MM-DD','autocomplete'=>'off']) !!}
                            </div>
                            <div class="box-inline mar-btm pad-rgt">
                                <label class="control-label">Arrival Estimate</label>
                                {!! Form::text('arrival',null,['class'=>'form-control datepicker','placeholder'=>'YYYY-MM-DD','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-default searchFlight">Search Flight</button>
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