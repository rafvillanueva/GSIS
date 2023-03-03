<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				<h3 class="kr-label"><span class="fa fa-lock"></span> Login | <small>Please Enter the following.</small></h3>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div id="kr-display"></div>				
		<form class="form-group" autocomplete="off" onsubmit="return false">
			<div class="form-group">
				<span class="kr-label">Username or Email Address</span>
				<input type="text" class="form-control kr-login-input" id="username" required>
			</div>
			<div class="form-group">
				<span class="kr-label">Password</span>
				<input type="Password" class="form-control kr-login-input" id="password" required>
			</div>
			<hr>
			<div class="form-group">
				<button onclick="adsign_in()" style="background-color: #ED1F24;" class="btn btn-danger btn-block btn-md kr-login-btn">Sign - In &nbsp;<span class="fa fa-sign-in"></span></button><br>

				<!-- <center><a href="#">Forget Password ?</a></center> -->
			</div>
		</form>
	</div>
</div>