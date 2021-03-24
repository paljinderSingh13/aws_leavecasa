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
                            <h3 class="panel-title">Agency List</h3>
                        </div>
                        <div class="panel-body">
                            <table id="demo-agency" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th class="min-tablet">Name</th>
                                        <th class="min-tablet">Subdomain</th>
                                        <th class="min-desktop">Email</th>
                                        <th class="min-desktop">Status</th>
                                        <th class="min-desktop">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $val)
                                    <tr>
                                        <td> {{$loop->iteration}} </td>
                                        <td>{{ucfirst($val->name)}}</td>
                                        <td>{{ucfirst($val->sub_domain)}}</td>
                                        <td>{{$val->email}}</td>
                                        <td> {{($val->status==1?'Activate':'Deactivate')}} </td>
                                        <td><div class="btn-group">
                                        <a class="add-tooltip" href="{{route('admin.agency.edit',['id'=>$val->id])}}" data-original-title="Edit" data-container="body"><i class="fa fa-pencil  green"></i></a>
                                        <a class="add-tooltip" href="{{route('admin.agency.delete',['id'=>$val->id])}}" data-original-title="Delete" data-container="body"><i class="fa fa-trash red"></i></a>
                                        <a class=" add-tooltip" href="{{route('admin.agency.status',['id'=>$val->id, 'status'=>$val->status])}}" data-original-title="Click to {{($val->status==1?'Ban Agency':'Activate Agency')}}" data-container="body"><i class="fa fa-lock {{($val->status==1?'green':'red') }} "></i></a>
                                        </div></td>
                                    </tr>                                    
                                    @endforeach
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
           $('#demo-agency').DataTable();
        });
    </script>
@endsection