@extends('website.layout.auth')
@section('content')
    <section id="content">
        <div class="container">
            <div id="main">
                <h1 class="logo block">
                    <a href="index.html" title="Travelo - home">
                        <img src="images/logo2.png" alt="Travelo HTML5 Template" />
                    </a>
                </h1>
                <div class="text-center yellow-color box" style="font-size: 4em; font-weight: 300; line-height: 1em;">Welcome to leavecasa!</div>
                <p class="light-blue-color block" style="font-size: 1.3333em;">Please login to your account.</p>
                <div class="col-sm-8 col-md-6 col-lg-5 no-float no-padding center-block">
                    {!! Form::open(['route'=>'customer.register','class'=>'login-form']) !!}
                        <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                            {!! Form::text('name',null,['class'=>'input-text input-large full-width','placeholder'=>'Enter name']) !!}
                            @if($errors->has('name'))
                                <span class="help-block">
                                    {!! $errors->first('name') !!}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email')?'has-error':'' }}">
                            {!! Form::text('email',null,['class'=>'input-text input-large full-width','placeholder'=>'Enter email']) !!}
                            @if($errors->has('email'))
                                <span class="help-block">
                                    {!! $errors->first('email') !!}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mobile')?'has-error':'' }}">
                            {!! Form::text('mobile',null,['class'=>'input-text input-large full-width','placeholder'=>'Enter mobile']) !!}
                            @if($errors->has('mobile'))
                                <span class="help-block">
                                    {!! $errors->first('mobile') !!}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('address')?'has-error':'' }}">
                            {!! Form::textarea('address',null,['class'=>'input-text input-large full-width','placeholder'=>'Enter address']) !!}
                            @if($errors->has('address'))
                                <span class="help-block">
                                    {!! $errors->first('address') !!}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password')?'has-error':'' }}">
                            {!! Form::password('password',['class'=>'input-text input-large full-width','placeholder'=>'Enter password']) !!}
                            @if($errors->has('password'))
                                <span class="help-block">
                                    {!! $errors->first('password') !!}
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn-large full-width sky-blue1">SIGN UP</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection