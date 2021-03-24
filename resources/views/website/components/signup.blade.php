<div id="travelo-signup" class="travelo-signup-box travelo-box">
        {{-- <div class="login-social">
            <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
            <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
        </div>
        <div class="seperator"><label>OR</label></div> --}}
        <div class="email-signup" style="display: block;">
            {!! Form::open(['route'=>'customer.register']) !!}
                <div class="form-group">
                    {!! Form::text('name',null,['class'=>'input-text full-width','placeholder'=>'Name', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('email',null,['class'=>'input-text full-width','placeholder'=>'Email address', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('mobile',null,['class'=>'input-text full-width','placeholder'=>'Mobile', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::textarea('address',null,['class'=>'input-text full-width','placeholder'=>'Address','rows'=>2, 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password',['class'=>'input-text full-width','placeholder'=>'Password', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('conf_password',['class'=>'input-text full-width','placeholder'=>'Confirm Password', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Tell me about LeaveCasa News
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <p class="description">By signing up, I agree to Leavecasa Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</p>
                </div>
                {!! Form::button('SIGNUP',['class'=>'full-width btn-medium signup_user','type'=>'submit']) !!}
            {!! Form::close() !!}
        </div>
        <div class="seperator"></div>
        <p>Already a Leavecasa member? <a href="#travelo-login" class="goto-login soap-popupbox">Login</a></p>
    </div>

