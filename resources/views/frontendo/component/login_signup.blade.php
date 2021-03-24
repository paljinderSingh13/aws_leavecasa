
{{-- <div class="modal " id="login" >
    <div class="modal-content">
      <div id="loginresult" class="center red-text" ></div>
      <form class="login-form lform" method="post"  id="logform" >
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

      </div>
    </form>
</div>
</div> --}}
<div id="login" class="modal fade" role="dialog">
   <div class="modal-dialog" style="margin-top: 100px;">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"> Login Form</h4>
            <button type="button" class="closeModal" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body ">
                <div id="loginresult" class="text-center text-danger" ></div>
            <form class="login-form lform" method="post"  id="logform" >
            {{ csrf_field() }}
              
               <div class="form-group">
                  <label class="control-label col-sm-2" >Email:</label>
                  <div class="col-sm-12">
                     <input id="LEmail" type="text" autocomplete="off" name="email"  class="form-control" required>
                  </div>
               </div>
               
                <div class="form-group">
                  <label class="control-label col-sm-2" >Password:</label>
                  <div class="col-sm-12">          
                    <input id="Lpassword" type="password" name="paswrd" autocomplete="off" class="form-control" required>
                  </div>
               </div>
               
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-12">
                     <input type="submit" class="btn btn-outline-success" value="Login" >
                  </div>
               </div>
            </form>
         </div>      </div>
   </div>
</div>

<div id="signup" class="modal fade" role="dialog">
  
   <div class="modal-dialog" style="margin-top: 100px;">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title"> Signup Form</h4>
            <button type="button" class="closeModal" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body ">
      <div id="Signresult" class="text-center text-red" ></div>
       <form class="login-form lform" method="post" id="reg_form"  autocomplete="off">
       {{ csrf_field() }}
              
               <div class="form-group">
                  <label class="control-label col-sm-2" >Name:</label>
                  <div class="col-sm-12">          
                     <input type="text" class="form-control"   id="username" name="name" value="" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" >Email:</label>
                  <div class="col-sm-12">          
                     <input type="email" class="form-control"  name="email" id="email" value="" required>
                  </div>
               </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" >Password:</label>
                  <div class="col-sm-12">          
                    <input type="password" id="password" name="password"  class="form-control"/>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" >Mobile:</label>
                  <div class="col-sm-12">          
                    <input type="text" id="mobile" name="mobile"  class="form-control"/>
                  </div>
               </div>
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-12">
                     <input type="submit" class="btn btn-outline-success" value="Signup" >
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

{{-- <div class="modal " id="signup" >
    <div class="modal-content">
      <div id="Signresult" class="center red-text" ></div>
    <form class="login-form lform" method="post" id="reg_form"  autocomplete="off">
 {{ csrf_field() }}
      <div class="row">        
          <h5 class="ml-4">Register</h5>

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
</div> --}}