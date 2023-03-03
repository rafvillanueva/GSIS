<script src="vendor/custom/tnek.js"></script>
<div class="container">
	<div class="col-md-4"></div>	
	<div class="col-md-4 kr-login">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-12">
						<h3 class="kr-label"><span class="fa fa-pencil"></span> Register | <small>Administrator cPanel</small></h3>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div id="kr-display"></div>				
				<form class="form-group" autocomplete="off" onsubmit="return false">
					<div class="form-group">
						<span class="kr-label">Username </span>
						<input type="text" class="form-control kr-login-input" id="username_r" required>
					</div>
					<div class="form-group">
						<span class="kr-label">Email Address</span>
						<input type="email" class="form-control kr-login-input" id="email_r" required>
					</div>
					<div class="form-group">
						<span class="kr-label">Password</span>
						<input type="Password" class="form-control kr-login-input" id="password_r" required>
					</div>
					<hr>
					<div class="form-group">
						<button onclick="adregister()" class="btn btn-warning btn-block btn-md kr-login-btn">
							Register &nbsp;<span class="fa fa-check"></span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
	<div class="col-md-4"></div>
</div>