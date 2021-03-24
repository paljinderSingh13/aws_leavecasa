@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">Add Packages</h1>
            </div>

            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Add Package</li>
            </ol>

        </div>

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <!-- Toolbar -->
            <input type="hidden" id="cuntryList" value="{{ $country }}">
            <input type="hidden" id="DurationList" value="{{ $duration }}">
            <!--===================================================-->
            {!! Form::open(['route'=>'package.store']) !!}
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Package</h3>
                    </div>
                    <div class="panel-body">
                <input type="hidden" value="{{route("country.city")}}" id="city_route">
                        <!-- Inline Form  -->
                        <!--===================================================-->
                        <form class="form-inline">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Title of Package</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Duration</label>
                                         {!! Form::select('duration[]',$duration,null,['placeholder'=>'Duration ', 'class'=>'form-control duration']) !!}                                       
                                    </div>
                                </div>
                            </div>

                    <div class="country-group"> 
                        <div  style="border:1px solid #7a878e61; padding: 12px;">  
                            <div  class="row" >                               
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                       {!! Form::select('countries_id[]',$country,null,['placeholder'=>'Choose Country', 'class'=>'form-control country' ,'onchange'=>'countryroute(this.value)']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Country Duration</label>
                                         {!! Form::select('duration[]',$duration,null,['placeholder'=>'Duration ', 'class'=>'form-control duration']) !!}
                                    </div>
                                </div>

                            </div>

                        <div class="city_group">
                             <div class="row city_data" >                               
                               <div class="col-md-6">
                                    <div class="form-group city_div">
                                        <label class="control-label">City</label>
                                        {!! Form::select('cities[]',[],null,['placeholder'=>'', 'class'=>'form-control cities']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> City Duration </label>
                                         {!! Form::select('duration[]',$duration,null,['placeholder'=>'Duration ', 'class'=>'form-control duration']) !!}
                                    </div>
                                </div>
                            </div>                           
                            </div>
                            <a href="javascript:void(0)" class="add_city"> Add More City</a>
                        </div>
                    </div>
                         <div class="row">
                                <div class="col-md-3">
                                    <a id="add_more_country" href="javascript:void(0)"> + ADD More Country</a>
                                </div>
                        </div>

                            <div class="row">
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Price</label>
                                        <input type="text" class="form-control" name="duration" >
                                    </div>
                                </div> --}}
                                <div class="col-md-3" style="padding-top: 2%;">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Add Packages</button>
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
       
    </script>
@endsection