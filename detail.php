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

?>
	
	
<div class="breadcrumb-bar">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-12 col-12">
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Detail Tempat</li>
					</ol>
				</nav>
				<h2 class="breadcrumb-title">Detail Tempat</h2>
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
						<div class="clini-infos">
							<ul>
								<li class="text-right"><h4>Rp. <?= number_format($tempat['harga']) ?></h4></li>
							</ul>
						</div>
						<div class="clinic-booking">
							<a class="apt-btn" href="detail_booking.php?id=<?= $_GET['id'] ?>">BOOKING</a>
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
							<a class="nav-link active" href="#doc_overview" data-toggle="tab">Detail</a>
						</li>
					</ul>
				</nav>
				<!-- /Tab Menu -->
				
				<!-- Tab Content -->
				<div class="tab-content pt-0">
				
					<!-- Overview Content -->
					<div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
						<div class="row">
							<div class="col-md-12 col-lg-9">
							
								<!-- About Details -->
								<div class="widget about-widget">
									<h4 class="widget-title">Informasi Detail</h4>
									<p><?= nl2br($tempat['deskripsi']) ?></p>
								</div>
								<!-- /About Details -->
							

							</div>
						</div>
					</div>
					<!-- /Overview Content -->
					
					
				</div>
			</div>
		</div>
		<!-- /Doctor Details Tab -->

	</div>
</div>		

<?php include 'template/footer.php'; ?>