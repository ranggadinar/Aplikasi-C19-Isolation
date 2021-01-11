<?php include 'template/header.php' ?>

<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-8">
							<h4 class="card-title">GANTI PROFILE</h4>
						</div>
						<div class="col-4 text-right">
							<a href="proses/logout.php" class="btn btn-danger">Logout</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<ul class="nav nav-tabs nav-tabs-top">
						<li class="nav-item"><a class="nav-link" href="user_dashboard.php">Dashboard</a></li>
						<li class="nav-item"><a class="nav-link" href="user_booking.php">Booking</a></li>
						<li class="nav-item"><a class="nav-link active" href="user_profile.php">Ganti Profile</a></li>
						<li class="nav-item"><a class="nav-link" href="user_password.php">Ganti Password</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane show active">

							<div class="row">
								<div class="col-md-12">
									<?php if(isset($_SESSION['alert'])){
										echo $_SESSION['alert'];
										unset($_SESSION['alert']);
									} ?>
								</div>
							</div>


							<?php  
								$query = mysqli_query($koneksi, 'SELECT * FROM user WHERE id="'.$_SESSION['login_data']['id'].'"');
								$user  = mysqli_fetch_assoc($query);
							?>

							<div class="row">
								<div class="col-md-6">
									<b>GANTI PROFIL</b>
									<form method="POST" action="proses/profile_ubah_bio.php" class="mt-3">
										<input type="hidden" value="<?php echo $_SESSION['login_data']['id'] ?>" name="id">
										<div class="form-group">
										    <label for="exampleInputEmail1">Email Address</label>
										    <h6><?php echo $user['email'] ?></h6>
										</div>

										<div class="form-group">
										    <label for="exampleInputEmail1">Nama Lengkap</label>
										    <input name="nama" required="" autocomplete="off" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama Lengkap" value="<?php echo $user['nama'] ?>">
										</div>
									  
										<div class="form-group">
										    <label for="exampleInputEmail1">Nomor Handphone</label>
										    <input autocomplete="off" name="no_hp" required="" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan No. Handphone" value="<?php echo $user['no_hp'] ?>">
										</div>

										<button type="submit" class="btn btn-warning text-white">Ubah Profile</button>
									</form>

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'template/footer.php' ?>
