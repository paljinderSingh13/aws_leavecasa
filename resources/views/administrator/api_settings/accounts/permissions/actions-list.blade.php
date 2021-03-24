<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Set Permissions</h3>
    </div>
    <div class="row">
        <div class="col-md-12 text-right" style="padding-right: 2%;">
            {!! Form::label('select_all','Select All',['style'=>'font-weight:600']) !!}
            {!! Form::checkbox('select_all','yes',null,['id'=>'select_all']) !!}
        </div>
    </div>
    {!! Form::open(['route'=>'save.permissions']) !!}
    {!! Form::hidden('role',$role) !!}
    {!! Form::hidden('module_id',$module) !!}
    {!! Form::hidden('permission_for','admin') !!}
    <div class="panel-body">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <table class="table table-hover table-vcenter">
                        <thead>
                        <tr>
                            <th>Module Name</th>
                            @foreach($actions as $key => $action)
                                <th class="text-center"> Can {{$action}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{\App\Model\Administrator\Accounts\Module::module_id_to_module_name($module)}}</td>
                            @foreach($actions as $key => $action)
                                @php
                                    $checked = null;
                                    if(in_array($action,$permissions)){
                                        $checked = true;
                                    }
                                @endphp
                                <td class="text-center">{!! Form::checkbox('actions['.$action.']',true,$checked,['class'=>'switchry']) !!}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                    {!! Form::submit('Save Permissions',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>