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
                    {!! Form::open(['route'=>'login.user.account','class'=>'login-form']) !!}
                        <div class="form-group {{ $errors->has('email')?'has-error':'' }}">
                            {!! Form::text('email',null,['class'=>'input-text input-large full-width','placeholder'=>'Enter your email']) !!}
                            @if($errors->has('email'))
                                <span class="help-block">
                                    {!! $errors->first('email') !!}
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password')?'has-error':'' }}">
                            {!! Form::password('password',['class'=>'input-text input-large full-width','placeholder'=>'enter your password']) !!}
                            @if($errors->has('password'))
                                <span class="help-block">
                                    {!! $errors->first('password') !!}
                                </span>
                            @endif

                            @if(session()->get('error'))
                                <span class="help-block" style="color: red;">
                                    {!! session()->get('error') !!}
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" value="">remember my details
                            </label>
                        </div>
                        <button type="submit" class="btn-large full-width sky-blue1">LOGIN TO YOUR ACCOUNT</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection