<div class="panel-body">
    <div class="row">
        <div class="col-sm-6">
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
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('role_id')?'has-error':'' }}">
                {!! Form::label('role_id','Role*',['class'=>'control-label']) !!}
                {!! Form::select('role_id',App\Model\Administrator\Accounts\AdminUserRole::roles(),null,['class'=>'form-control','placeholder'=>'Select Role']) !!}
                @if($errors->has('role_id'))
                    <span class="help-block error">
                        {{$errors->first('role_id')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('contact_no')?'has-error':'' }}">
                {!! Form::label('contact_no','Contact No',['class'=>'control-label']) !!}
                {!! Form::text('contact_no',null,['class'=>'form-control']) !!}
                @if($errors->has('contact_no'))
                    <span class="help-block error">
                        {{$errors->first('contact_no')}}
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('address')?'has-error':'' }}">
                {!! Form::label('address','Address',['class'=>'control-label']) !!}
                {!! Form::textarea('address',null,['class'=>'form-control']) !!}
                @if($errors->has('address'))
                    <span class="help-block error">
                        {{$errors->first('address')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('password')?'has-error':'' }}">
                {!! Form::label('password','Password',['class'=>'control-label']) !!}
                {!! Form::password('password',['class'=>'form-control']) !!}
                @if($errors->has('password'))
                    <span class="help-block error">
                        {{$errors->first('password')}}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <p class="text-main text-bold">Is WhiteList</p>
                {!! Form::checkbox('is_whitelist','yes',null,['id'=>'demo-sw-checked']) !!}
            </div>
        </div>
    </div>
</div>