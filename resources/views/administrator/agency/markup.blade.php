@extends('layouts.main')

@section('content')

    <!--CONTENT CONTAINER-->

    <!--===================================================-->
<div id="content-container">
  <div id="page-head">
  </div>
    <div id="page-content">





                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Agency Markup</h3>
                        </div>
                        <div class="panel-body">

                        <div style="display: none;" class="edit">       
                            {!! Form::open(['route'=>'admin.agency.markstore' , 'enctype'=>'multipart/form-data']) !!}

                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label"> Hotel Markup</label>

                                        <input type="text" class="form-control" name="markup_hotel" value="{{ $data->markup_hotel }}">

                                    </div>

                                </div>



                                 <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Flight Markup</label>

                                        <input type="text" class="form-control" name="markup_flight" value="{{ $data->markup_flight }}">

                                    </div>

                                </div>



                               

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label class="control-label">Bus Markup</label>

                                        <input type="text" class="form-control" name="markup_bus" value="{{ $data->markup_bus }}">

                                    </div>

                                </div>

                               

                               

                                <div class="col-md-3" style="padding-top: 2%;">

                                    <div class="form-group">

                                        <button class="btn btn-primary" type="submit">Edit Markup</button>

                                    </div>

                                </div>

                               

                            </div>

                        </form>
                    </div>



                            <table id="agency-markup" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th class="min-tablet">Hotel Markup</th>
                                        <th class="min-tablet">Flight Markup</th>
                                        <th class="min-desktop">Bus Markup</th>
                                        {{-- <th class="min-desktop">Status</th> --}}
                                        <th class="min-desktop">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{ $data->markup_hotel }}</td>
                                        <td>{{ $data->markup_flight }}</td>
                                        <td>{{$data->markup_bus}}</td>
                                        {{-- <td> {{($data->status==1?'Activate':'Deactivate')}} </td> --}}
                                        <td><div class="btn-group">
                                        <a class="add-tooltip" onclick="$('.edit').toggle(); return false;" data-original-title="Edit" data-container="body"><i class="fa fa-pencil  green"></i></a>

                                        {{-- <a class="add-tooltip" href="{{route('admin.agency.delete',['id'=>$data->id])}}" data-original-title="Delete" data-container="body"><i class="fa fa-trash red"></i></a> --}}
                                        
                                        {{-- <a class=" add-tooltip" href="{{route('admin.agency.status',['id'=>$data->id, 'status'=>$data->status])}}" data-original-title="Click to {{($data->status==1?'Ban Agency':'Activate Agency')}}" data-container="body"><i class="fa fa-lock {{($data->status==1?'green':'red') }} "></i></a> --}}
                                        </div></td>
                                    </tr>                                    
                                  
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     
                    
</div>

           
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
           $('#agency-markup').DataTable();
        });
    </script>
@endsection