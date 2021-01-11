<?php include 'template/header.php'; ?>

<!-- Page Content -->
    <div class="content bg-white pb-5" style="min-height:205px;">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-md-8 offset-md-2">
					
					<!-- Login Tab Content -->
					<div class="account-content">
						<div class="row align-items-center justify-content-center">
							<div class="col-md-7 col-lg-6 login-left">
								<img src="assets/frontend/img/login-banner.png" class="img-fluid" alt="Doccure Login">	
							</div>
							<div class="col-md-12 col-lg-6 login-right">
								<div class="login-header">
									<h3>Login</h3>
								</div>

								<?php 
									if(isset($_SESSION['alert'])){
										echo $_SESSION['alert'];
										unset($_SESSION['alert']);
									}
								?>

								<form method="POST" action="proses/login.php">
									<div class="form-group form-focus">
										<input type="email" class="form-control floating" required="" name="email" autocomplete="off">
										<label class="focus-label">Email</label>
									</div>
									<div class="form-group form-focus">
										<input type="password" class="form-control floating" required="" name="password" autocomplete="off">
										<label class="focus-label">Password</label>
									</div>
									<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
									<div class="text-center dont-have"><a href="register.php">Daftar Disini</a></div>
								</form>
							</div>
						</div>
					</div>
					<!-- /Login Tab Content -->
						
				</div>
			</div>

		</div>

	</div>		
	<!-- /Page Content -->


<?php include 'template/footer.php'; ?>