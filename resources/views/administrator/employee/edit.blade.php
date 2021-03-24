@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Employees</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="{{route('subadmin.list')}}">Employee</a></li>
            <li class="active">Edit Employee</li>
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
                            <h3 class="panel-title">Edit Employee</h3>
                        </div>
            
                        <!--Block Styled Form -->
                        <!--===================================================-->
                        {!! Form::model($model,['route'=>['update.employee',$model->id],'method'=>'put']) !!}
                            @include('administrator.employee._form')
                            <div class="panel-footer">
                                <button class="btn btn-success" type="submit">Update Employee</button>
                                <a class="btn btn-primary" href="{{ route('subadmin.list') }}">Cancel</a>
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