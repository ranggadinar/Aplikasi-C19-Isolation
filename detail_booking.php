<?php 
	include 'template/header.php'; 

	if(!isset($_SESSION['login'])){
		$_SESSION['alert'] = '<div class="alert alert-warning">Anda harus login untuk pilih jadwal</div>';
		header('Location:login.php');
	}

	$star = '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
</svg>';
	
	$kategori = mysqli_query($koneksi, 'SELECT * FROM kategori ORDER BY nama_kategori ASC') or die(mysqli_error($koneksi));

	$query = mysqli_query($koneksi, "SELECT tempat.*, kategori.nama_kategori, lokasi.nama_lokasi FROM tempat 
			   						  JOIN kategori ON kategori.id = tempat.kategori_id 
			   						  JOIN lokasi ON lokasi.id = tempat.lokasi_id

			   						  WHERE tempat.id='".$_GET['id']."'") 
			  or die(mysqli_error($koneksi));
	$tempat = mysqli_fetch_assoc($query);

	if(isset($_GET['from'])){
		$jadwal = mysqli_query($koneksi, 
			"SELECT * FROM transaksi WHERE ((tanggal_mulai BETWEEN '".$_GET['from']."' AND '".$_GET['to']."') OR (tanggal_selesai BETWEEN '".$_GET['from']."' AND '".$_GET['to']."')) AND (status != 'tolak')"
		) or die (mysqli_error($koneksi));

		$num = $tempat['kuota'] - mysqli_num_rows($jadwal);
	}

?>
	
	
<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item"><a href="detail.php?id=<?= $_GET['id'] ?>">Detail Tempat</a></li>
						<li class="breadcrumb-item active" aria-current="page">Pilih Tanggal</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">Pilih Tanggal</h2>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
	<div class="container">

		<!-- Doctor Widget -->
		<div class="card">
			<div class="card-body">
				<div class="doctor-widget">
					<div class="doc-info-left">
						<div class="doctor-img">
							<img src="assets/foto/<?= $tempat['foto'] ?>" class="img-fluid" alt="User Image">
						</div>
						<div class="doc-info-cont">
							<h4 class="doc-name"><?= $tempat['nama'] ?></h4>
							<p class="doc-speciality"><?= $tempat['alamat'] ?></p>
							<p class="doc-department"><?= $tempat['nama_kategori'] ?></p>
							<div class="clinic-details">
								<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?= $tempat['nama_lokasi'] ?></p>
							</div>
						</div>
					</div>
					<div class="doc-info-right">
						<div class="clinic-booking">
							<a class="btn btn-outline-primary" href="detail.php?id=<?= $_GET['id'] ?>">KEMBALI</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Doctor Widget -->
		
		<!-- Doctor Details Tab -->
		<div class="card">
			<div class="card-body pt-0">
			
				<!-- Tab Menu -->
				<nav class="user-tabs mb-4">
					<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
						<li class="nav-item">
							<a class="nav-link active" href="#doc_overview" data-toggle="tab">Pilih jadwal</a>
						</li>
					</ul>
				</nav>
				<!-- /Tab Menu -->
				
				<!-- Tab Content -->
				<div class="tab-content pt-0">
				
					<!-- Overview Content -->
					<div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
						<div class="row">
							<div class="col-md-12 col-lg-12">
							
							<form method="GET">
								<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
								<div class="row">
									<div class="col-md-3">
										<div class="filter-widget">
											<div class="cal-icon">
												<input type="text" required="" name="from" class="form-control datetimepicker" value="<?= isset($_GET['from']) ? $_GET['from'] : '' ?>" placeholder="Dari">
											</div>			
										</div>
									</div>

									<div class="col-md-3">
										<div class="filter-widget">
											<div class="cal-icon">
												<input type="text" required=""  value="<?= isset($_GET['to']) ? $_GET['to'] : '' ?>" name="to" class="form-control datetimepicker" placeholder="Ke">
											</div>			
										</div>
									</div>

									<div class="col-md-3">
										<button class="btn btn-primary mt-1">Cek Jadwal</button>
									</div>

									<?php if(isset($_GET['from'])){ ?>
										<div class="col-md-3 text-right">
											<h5><b><?= $num ?></b></h5> Kuota Tersisa
										</div>
									<?php } ?>
								</div>
							</form>

							</div>
						</div>

						<?php if(isset($_GET['from'])){ ?>
							<div class="row">

								<?php if($num > 0){ ?>

									<div class="col-md-3">
										<h4>Informasi Jadwal</h4>
										
										<?php

											$earlier = new DateTime($_GET['from']);
											$later 	 = new DateTime($_GET['to']);
											$diff 	 = $later->diff($earlier)->format("%a");

											$total_harga = $diff * $tempat['harga'];

										?>

										Durasi Karantina<h5 class="mt-2"><?= $diff ?> Hari</h5>
										Total Harga <h5 class="mt-2">Rp <?= number_format($total_harga) ?></h5>
									</div>

									<div class="col-md-9">
										<h4>Informasi Pasien Isolasi</h4>
										<form method="POST" action="proses/booking_insert.php">
											<input type="hidden" name="tempat_id" value="<?= $_GET['id'] ?>">
											<input type="hidden" name="tanggal_mulai" value="<?= $_GET['from'] ?>">
											<input type="hidden" name="tanggal_selesai" value="<?= $_GET['to'] ?>">
											<input type="hidden" name="durasi" value="<?= $diff ?>">
											<input type="hidden" name="total_transaksi" value="<?= $total_harga ?>">

											<div class="form-group form-focus">
												<input type="text" class="form-control floating" name="nama_pasien" required="" autocomplete="off">
												<label class="focus-label">Nama</label>
											</div>
											<div class="form-group form-focus">
												<input type="text" class="form-control floating" name="no_hp_pasien" required="" autocomplete="off">
												<label class="focus-label">Nomor Handphone</label>
											</div>
											<button class="btn btn-info btn-block btn-lg login-btn" type="submit">BOOKING SEKARANG</button>
										</form>
									</div>

								<?php }else{ ?>

									<div class="col-md-12 text-center mt-2">
										<h5 class="text-danger">Tidak ada jadwal yang tersedia</h5>
										<p>Silahkan cari jadwal lain</p>
									</div>

								<?php } ?>
								
							</div>
						<?php } ?>
						
					</div>
					<!-- /Overview Content -->
					
					
				</div>
			</div>
		</div>
		<!-- /Doctor Details Tab -->

	</div>
</div>		

<?php include 'template/footer.php'; ?>