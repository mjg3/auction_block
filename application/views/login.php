<html>
	<head>
		<title>Login/Registration</title>
		<?php
			$this->load->view('/partials/meta');
		?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col s12 center">
					<img class="main_logo" src="/assets/images/hammer.gif" alt="no photo" />
				</div>
			</div>
			<div class="row">
				<div class="col s12 col m6 offset-m3">
					<?php
						$this->load->view('partials/flash_messages.php');
					?>
				</div>
			</div>
			<div class="row card z-depth-5">
				<div class="col s12 col m6 offset-m3">
					<div class="row">
						<div class="col s6 center">
							<a class="active red-text text-darken-3 big" id="register-form-link">Register</a>
						</div>
						<div class="col s6 center">
							<a class="red-text text-lighten-2 big" id="login-form-link">Login</a>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<form id="register-form" action="/users/register" method="post" role="form" style="display: block;">
								<div class="input-field">
									<label for="first_name">First Name</label>
									<input type="text" name="first_name" id="first_name" class="validate"/>
								</div>
								<div class="input-field">
									<label for="last_name">Last Name</label>
									<input type="text" name="last_name" id="last_name" class="validate"/>
								</div>
								<div class="input-field">
									<label for="email">Email</label>
									<input type="email" name="email" id="email" class="validate"/>
								</div>
								<div class="input-field">
									<label for="password">Password</label>
									<input type="password" name="password" id="password" class="validate"/>
								</div>
								<div class="input-field">
									<label for="confirm_password">Confirm Password</label>
									<input type="password" name="confirm_password" id="confirm_password" class="validate"/>
								</div>
								<div class="input-field">
									<div class="row">
										<div class="col s6 offset-s6 col m5 offset-m7 col l5 offset-l7">
											<button class="btn red darken-3" type="submit" name="action">Register
											    <i class="material-icons right">send</i>
											</button>
										</div>
									</div>
								</div>
							</form>
							<form id="login-form" action="/users/login" method="post" role="form" style="display: none;">
								<div class="input-field">
									<label for="email">Email</label>
									<input type="email" name="email" id="email" class="validate"/>
								</div>
								<div class="input-field">
									<label for="password">Password</label>
									<input type="password" name="password" id="password" class="validate"/>
								</div>
								<div class="input-field">
									<div class="row">
										<div class="col s6 offset-s6 col m5 offset-m7 col l5 offset-l7">
											<button class="btn red darken-3" type="submit" name="action">Login
											    <i class="material-icons right">send</i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div> <!--End of main container-->
	</body>
</html>
