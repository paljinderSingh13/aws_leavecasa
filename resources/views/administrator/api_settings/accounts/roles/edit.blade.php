@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">User Roles</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Roles</a></li>
            <li class="active">Edit Roles</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Role</h3>
                        </div>
            
                        <!--Block Styled Form -->
                        <!--===================================================-->
                        {!! Form::model($model,['route'=>['update.role',$model->id],'method'=>'put']) !!}
                            @include('administrator.accounts.roles._form')
                            <div class="panel-footer">
                                <button class="btn btn-success" type="submit">Update Role</button>
                                <a class="btn btn-primary" href="{{ route('roles.list') }}">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                        <!--===================================================-->
                        <!--End Block Styled Form -->
            
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection