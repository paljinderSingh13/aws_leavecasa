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