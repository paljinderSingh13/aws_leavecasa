@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">

            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Permissions</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li><a href="#"><i class="demo-pli-home"></i></a></li>
                <li class="active">List of Permissions</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>


        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">


            <!-- Basic Data Tables -->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Set role and permissions</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('role','Select Role') !!}
                                {!! Form::select('role',\App\Model\Administrator\Accounts\AdminUserRole::roles($except = [4]),null,['class'=>'form-control','placeholder'=>'Select Role','required']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('module','Select Module') !!}
                                {!! Form::select('module',\App\Model\Administrator\Accounts\Module::moduleList(),null,['class'=>'form-control','placeholder'=>'Select Module','required']) !!}
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        {!! Form::submit('Set Permissions',['class'=>'btn btn-primary set_permissions']) !!}
                                    </div>
                                    <div class="col-md-2">
                                        <div class="load8 show_hide_loader" style="display: none;">
                                            <div class="loader" style="margin: 0; font-size: 4px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="permission-actions">

            </div>
            <!--===================================================-->
            <!-- End Striped Table -->
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection