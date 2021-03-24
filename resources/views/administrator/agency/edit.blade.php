@extends('layouts.main')
@section('content')
@php
// dd($data);
@endphp
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Edit Agency </h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Home</a></li>
            <li class="active">Edit Agency</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">

            <!-- Toolbar -->
            <!--===================================================-->
            {!! Form::open(['route'=>'admin.agency.update' , 'enctype'=>'multipart/form-data']) !!}
            <input type="hidden" name="id" value="{{ $data['id'] }}">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Agency</h3>
                    </div>
                    <div class="panel-body">
                
                        <!-- Inline Form  -->
                        <!--===================================================-->
                        <form class="form-inline">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $data['name']  }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Image</label>                                       
                                        <img src="{{ $data['file_path']  }}/{{ $data['image']  }}" width="50">
                                        <button onclick="$('.img').show(); return false;"> Change Image</button>
                                    </div>
                                </div>

                                <div class="col-md-3 img"  style="display: none;">
                                    <div class="form-group">
                                        <label class="control-label">Image</label>
                                        <input type="file" class="form-control" name="image">                                      
                                    </div>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $data['address']  }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        <input type="text" class="form-control" name="state" value="{{ $data['state']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" class="form-control" name="city" value="{{ $data['city']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Contact</label>
                                        <input type="text" class="form-control" name="contact_no" value="{{ $data['contact_no']}}">
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Sub Domain</label>
                                        <input type="text" class="form-control" name="sub_domain" value="{{ $data['sub_domain']}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ $data['email']}}">
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-top: 2%;">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Update Agency</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            {!! Form::close() !!}


             <div class="search-background"></div>

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
    
    {{-- Bootstrap Model --}}
    <div class="modal_content">
        
    </div>

@endsection