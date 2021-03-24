<div class="panel-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('role_name','Role Name',['class'=>'control-label']) !!}
                {!! Form::text('role_name',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('description','Description',['class'=>'control-label']) !!}
                {!! Form::textarea('description',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>