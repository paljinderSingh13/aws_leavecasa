
<script type="text/javascript">
    
    function openSignup(){
        regist = document.getElementById('reg');
        login = document.getElementById('login-form');
        login.style.display  = "none";
        regist.style.display = "block";
    }

     function openLogin(){
        regist = document.getElementById('reg');
        login = document.getElementById('login-form');
        login.style.display  = "block";
        regist.style.display = "none";
    }
</script>
<section class="section" id="content">
<div class="container"  id="login-form">
	<div class="row mt-5 mb-1 justify-content-md-center">
		<div class=" col col-md-6 bg-white ">
			<div class="panel">
				<div class="panel-heading">
					<h2 class="text-center">Login</h2>
				</div>
				<div class="panel-body ">
					<div id="loginresult" class="text-center text-danger" ></div>
					<form class="login-form lform" method="post" action="{{ route('login.customer') }}">
						{{ csrf_field() }}
						<input type="hidden" name="redirect" value="{{ route('flight.details') }}">
						<div class="form-group">
							<label class="control-label col-sm-2" >Email:</label>
							<div class="col-sm-12">
								<input  type="text" autocomplete="off" name="email"  class="form-control" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" >Password:</label>
							<div class="col-sm-12">
								<input  type="password" name="password" autocomplete="off" class="form-control" required>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" class="btn btn-primary btn-rounded btn-block" value="Login"  name="action">
							</div>
						</div>
					</form>
					<a  id="signup" href="javascript:openSignup();" class="text-danger text-center">Don't have any account .Now Sign up</a>
				</div>
				
					
				
			</div>
		</div>
	</div>
</div>
<div class="container"  id="reg"  style="display: none">
      <div class="row mt-5 mb-1 justify-content-md-center">
		<div class=" col col-md-6 bg-white ">
		<div class="panel">
			<div class="panel-heading">
				<h2 class="text-center">Signup</h2>
			</div>
			<div class="panel-body ">
				
				<form method="post" action="{{ route('cust.reg') }}">
                {{ csrf_field() }}
					
					<div class="form-group">
						<label class="control-label col-sm-2" >Name:</label>
						<div class="col-sm-12">
							<input type="text" class="form-control"   name="name"  required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" >Email:</label>
						<div class="col-sm-12">
							<input type="email" class="form-control"  name="email"   required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" >Password:</label>
						<div class="col-sm-12">
							<input type="password" name="password"  class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" >Mobile:</label>
						<div class="col-sm-12">
							<input type="text" name="mobile"  class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-12">
							<input type="submit" class="btn btn-primary btn-rounded btn-block" value="Signup"  name="action">
						</div>
					</div>

				</form>
				<a  id="logi" href="javascript:openLogin();" class="text-danger text-center">Login to continue</a>
			</div>
			
			
			
		</div>
		</div>
	</div>
</div>
</section>