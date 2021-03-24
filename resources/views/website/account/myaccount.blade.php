@extends('website.layout.website')

@section('content')
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">My Account</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="#">HOME</a></li>
                <li class="active">My Account</li>
            </ul>
        </div>
    </div>
    <section id="content" class="gray-area">
        <div class="container">
            <div id="main">
                <div class="tab-container full-width-style arrow-left dashboard">
                    <ul class="tabs">
                        <li class="active"><a data-toggle="tab" href="#dashboard"><i class="soap-icon-anchor circle"></i>Dashboard</a></li>
                        <li class=""><a data-toggle="tab" href="#profile"><i class="soap-icon-user circle"></i>Profile</a></li>
                        <li class=""><a data-toggle="tab" href="#booking"><i class="soap-icon-businessbag circle"></i>Booking</a></li>
                        <li class=""><a data-toggle="tab" href="#wishlist"><i class="soap-icon-wishlist circle"></i>Wallet</a></li>
                        {{-- <li class=""><a data-toggle="tab" href="#settings"><i class="soap-icon-settings circle"></i>Settings</a></li> --}}
                    </ul>
                    <div class="tab-content">
                        <div id="dashboard" class="tab-pane fade in active">
                            <h1 class="no-margin skin-color">Hi {{ Auth::guard('customer')->user()->name }}, Welcome to Leavecasa!</h1>
                            <p>All your trips booked with us will appear here and you’ll be able to manage everything!</p>
                            <br />
                            <div class="row block">
                                <div class="col-sm-6 col-md-3">
                                    <a href="javascript:void(0)">
                                        <div class="fact blue">
                                            <div class="numbers counters-box">
                                                <dl>
                                                    <dt class="display-counter" data-value="3200">0</dt>
                                                    <dd>Hotels to Stay</dd>
                                                </dl>
                                                <i class="icon soap-icon-hotel"></i>
                                            </div>
                                            <div class="description">
                                                <i class="icon soap-icon-longarrow-right"></i>
                                                <span>View Hotels</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <a href="javascript:void(0)">
                                        <div class="fact yellow">
                                            <div class="numbers counters-box">
                                                <dl>
                                                    <dt class="display-counter" data-value="4509">0</dt>
                                                    <dd>Airlines to Travel</dd>
                                                </dl>
                                                <i class="icon soap-icon-plane"></i>
                                            </div>
                                            <div class="description">
                                                <i class="icon soap-icon-longarrow-right"></i>
                                                <span>View Flights</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <a href="javascript:void(0)">
                                        <div class="fact red">
                                            <div class="numbers counters-box">
                                                <dl>
                                                    <dt class="display-counter" data-value="3250">0</dt>
                                                    <dd>VIP Transports</dd>
                                                </dl>
                                                <i class="icon soap-icon-car"></i>
                                            </div>
                                            <div class="description">
                                                <i class="icon soap-icon-longarrow-right"></i>
                                                <span>View Cars</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <a href="javascript:void(0)">
                                        <div class="fact green">
                                            <div class="numbers counters-box">
                                                <dl>
                                                    <dt class="display-counter" data-value="1570">0</dt>
                                                    <dd>Celebrity Cruises</dd>
                                                </dl>
                                                <i class="icon soap-icon-cruise flip-effect"></i>
                                            </div>
                                            <div class="description">
                                                <i class="icon soap-icon-longarrow-right"></i>
                                                <span>View Cruises</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="notification-area">
                                <div class="info-box block">
                                    <span class="close"></span>
                                    <p>This is your Dashboard, the place to check your Profile, respond to Reservation Requests, view upcoming Trip Information, and much more.</p>
                                    <br />
                                    <ul class="circle">
                                        <li><span class="skin-color">Learn How It Works</span> — Watch a short video that shows you how Travelo works.</li>
                                        <li><span class="skin-color">Get Help</span> — View our help section and FAQs to get started on Travelo. </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="profile" class="tab-pane fade">
                            <div class="view-profile">
                                <article class="image-box style2 box innerstyle personal-details">
                                    <figure>
                                        <a title="" href="#"><img width="270" height="263" alt="" src="http://placehold.it/270x263"></a>
                                    </figure>
                                    <div class="details">
                                        <a href="javascript:void(0)" class="button btn-mini pull-right edit-profile-btn">EDIT PROFILE</a>
                                        <h2 class="box-title fullname">Jessica Brown</h2>
                                        <dl class="term-description">
                                            @php
                                                $nameExploded = explode(' ',$model->name);
                                            @endphp
                                            <dt>first name:</dt><dd>{{ $nameExploded[0] }}</dd>
                                            @if(!empty($nameExploded[1]))
                                            <dt>last name:</dt><dd>{{ $nameExploded[1] }}</dd>
                                            @endif
                                            <dt>phone number:</dt><dd>{{ $model->mobile }}</dd>
                                            <dt>Date of birth:</dt><dd>{{ $model->dob }}</dd>
                                            <dt>Street Address and number:</dt><dd>{{ $model->address }}</dd>
                                            <dt>Town / City:</dt><dd>{{ $model->city }}</dd>
                                            <dt>Country:</dt><dd>India</dd>
                                        </dl>
                                    </div>
                                </article>
                            </div>
                            <div class="edit-profile">
                                {!! Form::model($model,['class'=>'edit-profile-form']) !!}
                                    <h2>Personal Details</h2>
                                    <div class="col-sm-9 no-padding no-float">
                                        <div class="row form-group">
                                            <div class="col-sms-6 col-sm-6">
                                                <label>First Name</label>
                                                {!! Form::text('first_name',null,['class'=>'input-text full-width','placeholder'=>'Enter First name']) !!}
                                            </div>
                                            <div class="col-sms-6 col-sm-6">
                                                <label>Last Name</label>
                                                {!! Form::text('last_name',null,['class'=>'input-text full-width','placeholder'=>'Enter last name']) !!}
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sms-12 col-sm-12">
                                                <label>Email Address</label>
                                                {!! Form::text('email',null,['class'=>'input-text full-width','placeholder'=>'Enter Email id','disabled'=>'disabled']) !!}                                                
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sms-12 col-sm-12">
                                                <label>Phone Number</label>
                                                {!! Form::text('mobile',null,['class'=>'input-text full-width','placeholder'=>'Enter phone number']) !!}
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-xs-12">Date of Birth</label>
                                            <div class="col-xs-12 col-sm-12">
                                                {!! Form::text('dob',null,['class'=>'input-text full-width','placeholder'=>'Select DOB']) !!}
                                            </div>
                                        </div>
                                        <hr>
                                        <h2>Contact Details</h2>
                                        <div class="row form-group">
                                            <div class="col-sms-6 col-sm-6">
                                                <label>City</label>
                                                {!! Form::text('city',null,['class'=>'input-text full-width','placeholder'=>'Enter City']) !!}
                                            </div>
                                            <div class="col-sms-6 col-sm-6">
                                                <label>Address</label>
                                                {!! Form::text('address',null,['class'=>'input-text full-width','placeholder'=>'Enter Address']) !!}
                                            </div>
                                        </div>
                                        <hr/>
                                        <h2>Upload Profile Photo</h2>
                                        <div class="row form-group">
                                            <div class="col-sms-12 col-sm-6 no-float">
                                                <div class="fileinput full-width">
                                                    <input type="file" class="input-text" data-placeholder="select image/s">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="from-group">
                                            <button type="submit" class="btn-medium col-sms-6 col-sm-4">UPDATE SETTINGS</button>
                                        </div>

                                        <div class="form-group">
                                            <a href="javascript:void(0)" class="button btn-medium orange col-sms-6 col-sm-4 go_back" style="margin-left: 2%;">Go Back</a>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>


                        <div id="booking" class="tab-pane fade">
                            <h2>Trips You have Booked!</h2>
                            <div class="filter-section gray-area clearfix">
                                <form>
                                    <label class="radio radio-inline">
                                        <input type="radio" name="filter" checked="checked" />
                                        All Types
                                    </label>
                                    <label class="radio radio-inline">
                                        <input type="radio" name="filter" />
                                        Hotels
                                    </label>
                                    <label class="radio radio-inline">
                                        <input type="radio" name="filter" />
                                        Flights
                                    </label>
                                    <label class="radio radio-inline">
                                        <input type="radio" name="filter" />
                                        Cars
                                    </label>
                                    <label class="radio radio-inline">
                                        <input type="radio" name="filter" />
                                        Cruises
                                    </label>
                                    <div class="pull-right col-md-6 action">
                                        <h5 class="pull-left no-margin col-md-4">Sort results by:</h5>
                                        <button class="btn-small white gray-color">UPCOMING</button>
                                        <button class="btn-small white gray-color">CANCELLED</button>
                                    </div>
                                </form>
                            </div>
                            <div class="booking-history">
                                <div class="booking-info clearfix">
                                    <div class="date">
                                        <label class="month">NOV</label>
                                        <label class="date">23</label>
                                        <label class="day">SAT</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-plane-right takeoff-effect yellow-color circle"></i>Indianapolis to Paris<small>you are flying</small></h4>
                                    <dl class="info">
                                        <dt>TRIP ID</dt>
                                        <dd>5754-8dk8-8ee</dd>
                                        <dt>booked on</dt>
                                        <dd>saturday, nov 23, 2013</dd>
                                    </dl>
                                    <button class="btn-mini status">UPCOMMING</button>
                                </div>
                                <div class="booking-info clearfix">
                                    <div class="date">
                                        <label class="month">NOV</label>
                                        <label class="date">30</label>
                                        <label class="day">SAT</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-plane-right takeoff-effect yellow-color circle"></i>England to Rome<small>you are flying</small></h4>
                                    <dl class="info">
                                        <dt>TRIP ID</dt>
                                        <dd>5754-8dk8-8ee</dd>
                                        <dt>booked on</dt>
                                        <dd>saturday, nov 30, 2013</dd>
                                    </dl>
                                    <button class="btn-mini status">UPCOMMING</button>
                                </div>
                                <div class="booking-info clearfix">
                                    <div class="date">
                                        <label class="month">DEC</label>
                                        <label class="date">11</label>
                                        <label class="day">MON</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-hotel blue-color circle"></i>Hilton Hotel &amp; Resorts<small>2 adults staying</small></h4>
                                    <dl class="info">
                                        <dt>TRIP ID</dt>
                                        <dd>5754-8dk8-8ee</dd>
                                        <dt>booked on</dt>
                                        <dd>monday, dec 11, 2013</dd>
                                    </dl>
                                    <button class="btn-mini status">UPCOMMING</button>
                                </div>
                                <div class="booking-info clearfix">
                                    <div class="date">
                                        <label class="month">DEC</label>
                                        <label class="date">18</label>
                                        <label class="day">THU</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-car red-color circle"></i>Economy Car<small>you are driving</small></h4>
                                    <dl class="info">
                                        <dt>TRIP ID</dt>
                                        <dd>5754-8dk8-8ee</dd>
                                        <dt>booked on</dt>
                                        <dd>thursday, dec 18, 2013</dd>
                                    </dl>
                                    <button class="btn-mini status">UPCOMMING</button>
                                </div>
                                <div class="booking-info clearfix">
                                    <div class="date">
                                        <label class="month">DEC</label>
                                        <label class="date">22</label>
                                        <label class="day">SUN</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-cruise green-color circle"></i>Baja Mexico<small>3 adults going on cruise</small></h4>
                                    <dl class="info">
                                        <dt>TRIP ID</dt>
                                        <dd>5754-8dk8-8ee</dd>
                                        <dt>booked on</dt>
                                        <dd>sunday, dec 22, 2013</dd>
                                    </dl>
                                    <button class="btn-mini status">UPCOMMING</button>
                                </div>
                                <div class="booking-info clearfix cancelled">
                                    <div class="date">
                                        <label class="month">NOV</label>
                                        <label class="date">30</label>
                                        <label class="day">SAT</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-plane-right takeoff-effect circle"></i>England to Rome<small>you are flying</small></h4>
                                    <dl class="info">
                                        <dt>TRIP ID</dt>
                                        <dd>5754-8dk8-8ee</dd>
                                        <dt>booked on</dt>
                                        <dd>saturday, nov 30, 2013</dd>
                                    </dl>
                                    <button class="btn-mini status">CANCELLED</button>
                                </div>
                                <div class="booking-info clearfix cancelled">
                                    <div class="date">
                                        <label class="month">DEC</label>
                                        <label class="date">18</label>
                                        <label class="day">THU</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-car circle"></i>Economy Car<small>you are driving</small></h4>
                                    <dl class="info">
                                        <dt>TRIP ID</dt>
                                        <dd>5754-8dk8-8ee</dd>
                                        <dt>booked on</dt>
                                        <dd>thursday, dec 18, 2013</dd>
                                    </dl>
                                    <button class="btn-mini status">CANCELLED</button>
                                </div>
                            </div>
                        </div>
                        <div id="wishlist" class="tab-pane fade">
                            <h2>Your Wallet</h2>
                            <div class="row image-box listing-style2 add-clearfix">
                                <div class="col-sm-6 col-md-4">                                    
                                    <img src="{{ asset('images/wallet.png') }}" width="20%" />
                                    <div class="details" style="margin-top: 7%;">
                                        <h4 class="box-title">Available Amount</h4>
                                        <label class="price-wrapper">
                                            <span class="price-per-unit">&#8377; 170</span>
                                        </label>
                                    </div>                                    
                                </div>
                                <div class="col-md-6">
                                    <a href="javascript:void(0)" class="button btn-medium green">Add Amount To Wallet</a>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="settings" class="tab-pane fade">
                            <h2>Account Settings</h2>
                            <h5 class="skin-color">Change Your Password</h5>
                            <form>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <label>Old Password</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <label>Enter New Password</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <label>Confirm New password</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn-medium">UPDATE PASSWORD</button>
                                </div>
                            </form>
                            <hr>
                            <h5 class="skin-color">Change Your Email</h5>
                            <form>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <label>Old email</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <label>Enter New Email</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <label>Confirm New Email</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn-medium">UPDATE EMAIL ADDRESS</button>
                                </div>
                            </form>
                            <hr>
                            <h5 class="skin-color">Send Me Emails When</h5>
                            <form>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Travelo has periodic offers and deals on really cool destinations.
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Travelo has fun company news, as well as periodic emails.
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I have an upcoming reservation.
                                    </label>
                                </div>
                                <button class="btn-medium uppercase">Update All Settings</button>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        tjq(document).ready(function() {
            tjq("#profile .edit-profile-btn").click(function(e) {
                e.preventDefault();
                tjq(".view-profile").fadeOut();
                tjq(".edit-profile").fadeIn();
            });

            tjq('.go_back').click(function(e){
                e.preventDefault();
                tjq(".edit-profile").fadeOut();  
                tjq(".view-profile").fadeIn();
            });

            setTimeout(function() {
                tjq(".notification-area").append('<div class="info-box block"><span class="close"></span><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ab quis a dolorem, placeat eos doloribus esse repellendus quasi libero illum dolore. Esse minima voluptas magni impedit, iusto, obcaecati dignissimos.</p></div>');
            }, 10000);
        });
        tjq('a[href="#profile"]').on('shown.bs.tab', function (e) {
            tjq(".view-profile").show();
            tjq(".edit-profile").hide();
        });
    </script>
@endsection