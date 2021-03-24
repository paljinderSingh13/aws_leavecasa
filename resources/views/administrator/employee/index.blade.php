@extends('layouts.main')
@section('content')
    <div id="content-container">
        <div id="page-head">
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Users</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->
        </div>
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <!-- Contact Toolbar -->
            <!---------------------------------->
            <div class="row pad-btm">
                <div class="col-sm-6 toolbar-left">
                    <button id="demo-btn-addrow" class="btn btn-purple" onclick="window.location.href='{{ route('create.employee') }}'">Add New</button>
                    <button class="btn btn-default"><i class="demo-pli-printer"></i></button>
                </div>
                <div class="col-sm-6 toolbar-right text-right">
                    Sort by :
                    <div class="select">
                        <select id="demo-ease">
                            <option value="date-created" selected="">Date Created</option>
                            <option value="date-modified">Date Modified</option>
                            <option value="frequency-used">Frequency Used</option>
                            <option value="alpabetically">Alpabetically</option>
                            <option value="alpabetically-reversed">Alpabetically Reversed</option>
                        </select>
                    </div>
                    <button class="btn btn-default">Filter</button>
                    <button class="btn btn-primary"><i class="demo-psi-gear icon-lg"></i></button>
                </div>
            </div>
            <!---------------------------------->
            <div class="row">
                @foreach($model as $key => $value)
                    <div class="col-sm-4 col-md-3">
                    <!-- Contact Widget -->
                    <!---------------------------------->
                    <div class="panel pos-rel">
                        <div class="pad-all text-center">
                            <div class="widget-control">
                                <a href="#" class="add-tooltip btn btn-trans" data-original-title="Favorite"><span class="favorite-color"><i class="demo-psi-star icon-lg"></i></span></a>
                                <div class="btn-group dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right" style="">
                                        <li><a href="{{route('edit.employee',$value->id)}}"><i class="icon-lg icon-fw
                                        demo-psi-pen-5"></i>
                                                Edit</a></li>
                                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a>
                                        </li>
                                        {{-- <li class="divider"></li>
                                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-mail"></i> Send a Message</a>
                                        </li>
                                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-calendar-4"></i> View Details</a>
                                        </li>
                                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <a href="#"> <img alt="Profile Picture" class="img-lg img-circle mar-ver"
                                        src="{{asset('v2.9/img/profile-photos/2.png')}}">
                                <p class="text-lg text-semibold mar-no text-main">{{$value->name}}</p>
                                <p class="text-sm">{{ ($value['designation'] == 0)?'Senior':'Junior' }}</p>
                                <p class="text-sm">{{ $value['bio'] }}</p>
                            </a>
                            <div class="pad-top btn-groups">
                                <a href="#" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"></a>
                                <a href="#" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
                                <a href="#" class="btn btn-icon demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"></a>
                                <a href="#" class="btn btn-icon demo-pli-instagram icon-lg add-tooltip" data-original-title="Instagram" data-container="body"></a>
                            </div>
                        </div>
                    </div>
                    <!---------------------------------->
                </div>
                @endforeach
                {{--<div class="col-sm-4 col-md-3">
                    <!-- Contact Widget -->
                    <!---------------------------------->
                    <div class="panel pos-rel">
                        <div class="pad-all text-center">
                            <div class="widget-control">
                                <a href="#" class="add-tooltip btn btn-trans" data-original-title="Favorite"><span class="favorite-color"><i class="demo-psi-star icon-lg"></i></span></a>
                                <div class="btn-group dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right" style="">
                                        <li><a href="#"><i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit</a></li>
                                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-mail"></i> Send a Message</a>
                                        </li>
                                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-calendar-4"></i> View Details</a>
                                        </li>
                                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock</a></li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#"> <img alt="Profile Picture" class="img-lg img-circle mar-ver"
                                        src="{{asset('v2.9/img/profile-photos/9.png')}}">
                                <p class="text-lg text-semibold mar-no text-main">Stephen Tran</p>
                                <p class="text-sm">Marketing manager</p>
                                <p class="text-sm">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean massa.</p>
                            </a>
                            <div class="pad-top btn-groups">
                                <a href="#" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"></a>
                                <a href="#" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
                                <a href="#" class="btn btn-icon demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"></a>
                                <a href="#" class="btn btn-icon demo-pli-instagram icon-lg add-tooltip" data-original-title="Instagram" data-container="body"></a>
                            </div>
                        </div>
                    </div>
                    <!---------------------------------->
                </div>--}}
            </div>
        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
@endsection