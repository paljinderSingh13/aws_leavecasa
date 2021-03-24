<div class="panel-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('employee_id')?'has-error':'' }}">
                {!! Form::label('employee_id','Employee ID*',['class'=>'control-label']) !!}
                {!! Form::text('employee_id',null,['class'=>'form-control']) !!}
                @if($errors->has('employee_id'))
                    <span class="help-block error">
                        {{$errors->first('employee_id')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                {!! Form::label('name','Name*',['class'=>'control-label']) !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
                @if($errors->has('name'))
                    <span class="help-block error">
                        {{$errors->first('name')}}
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('email')?'has-error':'' }}">
                {!! Form::label('email','Email*',['class'=>'control-label']) !!}
                {!! Form::text('email',null,['class'=>'form-control']) !!}
                @if($errors->has('email'))
                    <span class="help-block error">
                        {{$errors->first('email')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('password')?'has-error':'' }}">
                {!! Form::label('password','Password*',['class'=>'control-label']) !!}
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password']) !!}
                @if($errors->has('password'))
                    <span class="help-block error">
                        {{$errors->first('password')}}
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('bio')?'has-error':'' }}">
                {!! Form::label('bio','Bio',['class'=>'control-label']) !!}
                {!! Form::textarea('bio',null,['class'=>'form-control']) !!}
                @if($errors->has('bio'))
                    <span class="help-block error">
                        {{$errors->first('bio')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('designation')?'has-error':'' }}">
                {!! Form::label('designation','Designation',['class'=>'control-label']) !!}
                {!! Form::select('designation',['0'=>'Senior','1'=>'Junior'],null,['class'=>'form-control']) !!}
                @if($errors->has('designation'))
                    <span class="help-block error">
                        {{$errors->first('designation')}}
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>