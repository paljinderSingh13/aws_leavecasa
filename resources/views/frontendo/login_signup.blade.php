{{-- action="{{ route('login.user.account') }}" --}}
<div class="modal " id="login" >
    <div class="modal-content">

      <div id="loginresult" class="alert-success"></div>
      <form class="login-form lform" method="post" onsubmit="return save()" id="logform" >
      	 {{ csrf_field() }}
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Sign in</h5>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="LEmail" type="text" autocomplete="off" name="email" required>
          <label for="LEmail" class="center-align">Email</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="Lpassword" type="password" name="password" autocomplete="off" required>
          <label for="Lpassword" class="">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <p>
            <label>
              <input type="checkbox">
              <span>Remember Me</span>
            </label>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" >Login</button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <p class="margin medium-small"><a href="javascript:signup()">Register Now!</a></p>
        </div>
        {{-- <div class="input-field col s6 m6 l6">
          <p class="margin right-align medium-small"><a href="user-forgot-password.html">Forgot password ?</a></p>
        </div> --}}
      </div>
    </form>
</div>
</div>

<div class="modal " id="signup" >
    <div class="modal-content">
    <form class="login-form lform" method="post" action="{{ route('customer.register') }}" autocomplete="off">
 {{ csrf_field() }}
      <div class="row">        
          <h5 class="ml-4">Register</h5>
          {{-- 
          <p class="ml-4">Join to our community now !</p> --}}        
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="username" type="text" name="name" required>
          <label for="username" class="center-align">Username</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">mail_outline</i>
          <input id="email" type="email" name="email" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" name="password" autocomplete="off" required>
          <label for="password">Password</label>
        </div>
      </div>
        <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="mobile" name="mobile" type="text" required>
          <label for="mobile">Mobile</label>
        </div>
      </div>
      
    
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Register</button>
        </div>
      </div>
      <div class="row">
          <p class="margin medium-small"><a href="javascript:login()">Already have an account? Login</a></p>
        
      </div>
    </form>
</div>
</div>