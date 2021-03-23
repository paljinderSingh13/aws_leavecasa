@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Search Hotels</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Blog</a></li>
            <li class="active">Search Hotels</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            
                 <!-- Search -->
                 <!--===================================================-->
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
            

                <div class="panel">
                    <div class="panel-body">
                        <h3>Create Hotel Markups</h3>
                        <p>Create your hotel markups</p>
                        <form action="{{route('save.markup')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{$errors->has('country')?'has-error':''}}">
                                                <label class="control-label">Country</label>
                                                {!! Form::select('country',[],null,['class'=>'form-control country-list']) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{$errors->has('city')?'has-error':''}}">
                                                <label class="control-label">City</label>
                                                {!! Form::select('cities',[],null,['class'=>'form-control cities-list']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{$errors->has('amount_by')?'has-error':''}}">
                                                <label class="control-label">Amount By</label>
                                                {!! Form::select('amount_by',['percent'=>'Percentage','rupee'=>'Rupee'],null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{$errors->has('amount')?'has-error':''}}">
                                                <label class="control-label">Amount</label>
                                                {!! Form::text('amount',null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{$errors->has('visibility')?'has-error':''}}">
                                                <label class="control-label">Visibility</label>
                                                {!! Form::select('visibility',[1=>'Show',0=>'Hide'],null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{$errors->has('ratting')?'has-error':''}}">
                                                <label class="control-label">Star Ratting</label>
                                                {!! Form::select('ratting',App\Model\Administrator\ApiSettings\HotelsMarkup::starRating(),null,['class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                {!! Form::submit('Save Markup',['class'=>'form-control btn btn-primary','style'=>'margin-top:20%;']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="search-background"></div>
                <div class="row search-spinner hotel-spinner">
                    <div class="col-md-12 text-center">
                        <h4 class="load_text">Getting Countries List..</h4>
                        <div class="sk-wandering-cubes">
                            <div class="sk-cube sk-cube1"></div>
                            <div class="sk-cube sk-cube2"></div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Your Current Hotels Markups</h3>
                    </div>
                    <div class="panel-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            
                <hr class="new-section-xs bord-no">
        <!--===================================================-->
        <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection