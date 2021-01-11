<?php include 'template/header.php'; ?>
	
<div class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
			<form method="GET">
				<!-- Search Filter -->
				<div class="card search-filter">
					<div class="card-header">
						<h4 class="card-title mb-0">Filter </h4>
					</div>
					<div class="card-body">

					<div class="filter-widget">
						<h4>Nama Tempat</h4>
						<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= isset($_GET['nama']) ? $_GET['nama'] : '' ?>">
					</div>

					<div class="filter-widget">
						<?php 
							$lokasi = mysqli_query($koneksi, 'SELECT * FROM lokasi ORDER BY nama_lokasi ASC');
						?>

						<h4>Lokasi</h4>
						<select class="form-control" name="lokasi_id">
							<option value="all">Semua</option>
							<?php 
								while ($data = mysqli_fetch_array($lokasi)) { 
									$id = isset($_GET['lokasi_id']) ? $_GET['lokasi_id'] : '';
							?>
									<option <?= $data['id'] == $id ? 'selected="selected"' : '' ?> value="<?= $data['id'] ?>"><?= $data['nama_lokasi'] ?></option>
							<?php
								}
							?>
						</select>
					</div>

						<div class="btn-search">
							<button class="btn btn-block">Cari</button>
						</div>	
					</div>
				</div>
				<!-- /Search Filter -->
			</form>
			</div>
			
			<div class="col-md-12 col-lg-8 col-xl-9">

				<?php  

					$query = 'SELECT *, 
								tempat.nama AS nama_tempat, tempat.foto AS foto_tempat,
								tempat.id AS tempat_id

							FROM tempat 
							
							JOIN kategori ON kategori.id = tempat.kategori_id
							JOIN lokasi ON lokasi.id = tempat.lokasi_id ';

					if(isset($_GET['lokasi_id']) && isset($_GET['nama'])){

						if($_GET['lokasi_id'] == 'all' && $_GET['nama'] != ''){
							$query .= "WHERE nama LIKE '%".$_GET['nama']."%'";
						
						}else if($_GET['lokasi_id'] != 'all' && $_GET['nama'] != ''){
							$query .= "WHERE lokasi_id = '".$_GET['lokasi_id']."' AND nama LIKE '%".$_GET['nama']."%'";

						}else if($_GET['lokasi_id'] != 'all'){
							$query .= "WHERE lokasi_id = '".$_GET['lokasi_id']."'";
						}
						
					}

					$query .= ' ORDER BY tempat.id';

					$tempat = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
				?>

				<?php $n=1; while ($data = mysqli_fetch_array($tempat)) { ?>

				<!-- Doctor Widget -->
				<div class="card">
					<div class="card-body">
						<div class="doctor-widget">
							<div class="doc-info-left">
								<div class="doctor-img">
									<a href="doctor-profile">
										<img src="assets/foto/<?= $data['foto_tempat'] ?>" class="img-fluid" alt="User Image">
									</a>
								</div>
								<div class="doc-info-cont">
									<h4 class="doc-name"><a href="doctor-profile"><?= $data['nama_tempat'] ?></a></h4>
									<p class="doc-speciality"><?= $data['alamat'] ?></p>
									
									<h5 class="doc-department mt-3"><?= $data['nama_kategori'] ?></h5>
									<div class="clinic-details">
										<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?= $data['nama_lokasi'] ?></p>
									</div>
								</div>
							</div>
							<div class="doc-info-right">
								<div class="clini-infos">
									<ul>
										<li class="text-center"><h4>Rp. <?= number_format($data['harga']) ?></h4></li>
									</ul>
								</div>
								<div class="clinic-booking">
									<a class="view-pro-btn" href="detail.php?id=<?= $data['tempat_id'] ?>">Lihat</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Doctor Widget -->

				<?php } ?>

			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<?php include 'template/footer.php'; ?>