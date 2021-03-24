@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">User Register</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">User Register</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <!-- Toolbar -->
            <!--===================================================-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Register New User</h3>
                        </div>
            
                        <!--Block Styled Form -->
                        <!--===================================================-->
                        {!! Form::open(['route'=>'create.customer']) !!}
                            {!! Form::hidden('redirect_to','booking.confirmation') !!}
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
                                            {!! Form::label('name','Name',['class'=>'control-label']) !!}
                                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Name']) !!}
                                            @if($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group {{ ($errors->has('email'))?'has-error':'' }}">
                                            {!! Form::label('email','Email',['class'=>'control-label']) !!}
                                            {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                                            @if($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group {{ ($errors->has('password'))?'has-error':'' }}">
                                            {!! Form::label('password','Password',['class'=>'control-label']) !!}
                                            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter Password']) !!}
                                            @if($errors->has('password'))
                                                <span class="help-block">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group {{ ($errors->has('mobile'))?'has-error':'' }}">
                                            {!! Form::label('mobile','Mobile',['class'=>'control-label']) !!}
                                            {!! Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Enter Mobile']) !!}
                                            @if($errors->has('mobile'))
                                                <span class="help-block">{{ $errors->first('mobile') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group {{ ($errors->has('address'))?'has-error':'' }}">
                                            {!! Form::label('address','Address',['class'=>'control-label']) !!}
                                            {!! Form::textarea('address',null,['class'=>'form-control','placeholder'=>'Enter Address']) !!}
                                            @if($errors->has('address'))
                                                <span class="help-block">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-left">
                                <button class="btn btn-success" type="submit">Register Now</button>
                            </div>
                        </form>
                        <!--===================================================-->
                        <!--End Block Styled Form -->
            
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Horizontal form</h3>
                        </div>
            
                        <!--Horizontal Form-->
                        <!--===================================================-->
                        {!! Form::open(['route'=>'login.by.email.mobile','class'=>'form-horizontal']) !!}
                            {!! Form::hidden('redirect_to','booking.confirmation') !!}
                            <div class="panel-body">
                                <div class="form-group {{ ($errors->has('login_email'))?'has-error':'' }}">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">Email</label>
                                    <div class="col-sm-9">
                                        {!! Form::text('login_email',null,['class'=>'form-control','placeholder'=>'Email Id']) !!}
                                        @if($errors->has('login_email'))
                                            <span class="help-block">{{ $errors->first('login_email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 2%;">
                                    <div class="col-md-12 text-center">
                                        --OR--
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('login_mobile'))?'has-error':'' }}">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputpass">Mobile</label>
                                    <div class="col-sm-9">
                                        {!! Form::number('login_mobile',null,['class'=>'form-control','placeholder'=>'Mobile Number']) !!}
                                        @if($errors->has('login_mobile'))
                                            <span class="help-block">{{ $errors->first('login_mobile') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-left">
                                {!! Form::submit('Login Now',['class'=>'btn btn-success']) !!}
                            </div>
                        {!! Form::close() !!}
                        <!--===================================================-->
                        <!--End Horizontal Form-->
            
                    </div>
                </div>
            </div>
            <hr class="new-section-xs bord-no">
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection