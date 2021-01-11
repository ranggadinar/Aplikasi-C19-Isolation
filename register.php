<?php include 'template/header.php'; ?>

<!-- Page Content -->
<div class="content bg-white pb-5" style="min-height:205px;"> 
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-md-8 offset-md-2">
					
				<!-- Register Content -->
				<div class="account-content">
					<div class="row align-items-center justify-content-center">
						<div class="col-md-7 col-lg-6 login-left">
							<img src="assets/frontend/img/login-banner.png" class="img-fluid" alt="Doccure Register">	
						</div>
						<div class="col-md-12 col-lg-6 login-right">
							<div class="login-header">
								<h3>Daftar Akun</h3>
							</div>
							
							<?php 
								if(isset($_SESSION['alert'])){
									echo $_SESSION['alert'];
									unset($_SESSION['alert']);
								}
							?>

							<form method="POST" action="proses/register.php">
								<div class="form-group form-focus">
									<input type="text" class="form-control floating" name="nama" required="" autocomplete="off">
									<label class="focus-label">Nama</label>
								</div>
								<div class="form-group form-focus">
									<input type="text" class="form-control floating" name="email" required="" autocomplete="off">
									<label class="focus-label">Email</label>
								</div>
								<div class="form-group form-focus">
									<input type="text" class="form-control floating" name="no_hp" required="" autocomplete="off">
									<label class="focus-label">Nomor Handphone</label>
								</div>
								<div class="form-group form-focus">
									<input type="password" class="form-control floating" name="password" required="" autocomplete="off">
									<label class="focus-label">Password</label>
								</div>
								<div class="text-right">
									<a class="forgot-link" href="login.php">Login disini </a>
								</div>
								<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>
							</form>
							<!-- /Register Form -->
							
						</div>
					</div>
				</div>
				<!-- /Register Content -->
					
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->


<?php include 'template/footer.php'; ?>