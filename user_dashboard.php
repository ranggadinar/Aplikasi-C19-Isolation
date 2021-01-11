<?php include 'template/header.php' ?>

<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-8">
							<h4 class="card-title">DASHBOARD</h4>
						</div>
						<div class="col-4 text-right">
							<a href="proses/logout.php" class="btn btn-danger">Logout</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<ul class="nav nav-tabs nav-tabs-top">
						<ul class="nav nav-tabs nav-tabs-top">
						<li class="nav-item"><a class="nav-link active" href="user_dashboard.php">Dashboard</a></li>
						<li class="nav-item"><a class="nav-link" href="user_booking.php">Booking</a></li>
						<li class="nav-item"><a class="nav-link" href="user_profile.php">Ganti Profile</a></li>
						<li class="nav-item"><a class="nav-link" href="user_password.php">Ganti Password</a></li>
					</ul>
					</ul>
					<div class="tab-content">
						<div class="tab-pane show active">
							WELCOME, <b><?= $_SESSION['login_data']['nama'] ?></b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'template/footer.php' ?>
