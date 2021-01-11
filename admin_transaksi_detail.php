<?php include 'template/header_admin.php' ?>

<div class="page-wrapper">
    <div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-7 col-auto">
					<h3 class="page-title">Detail Transaksi</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="admin_transaksi.php">Transaksi</a></li>
						<li class="breadcrumb-item active">Detail</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						
						<div class="row">
							<div class="col-md-12">
								<?php if(isset($_SESSION['alert'])){
									echo $_SESSION['alert'];
									unset($_SESSION['alert']);
								} ?>
							</div>
						</div>

						<a href="admin_transaksi.php" class="btn btn-outline-secondary">KEMBALI</a>

						<?php  
							$transaksi = mysqli_query($koneksi, '
								SELECT *,
									user.nama AS nama_user, user.email AS email_user, 
									tempat.nama AS nama_tempat, transaksi.id AS transaksi_id, 
									tempat.nama AS nama_tempat, user.nama AS nama_user 

								FROM transaksi 

								JOIN tempat ON tempat.id = transaksi.tempat_id 
								JOIN kategori ON kategori.id = tempat.kategori_id 
								JOIN lokasi ON lokasi.id = tempat.lokasi_id
								JOIN user ON user.id = transaksi.user_id 

								WHERE transaksi.id = "'.$_GET['id'].'"') or die(mysqli_error($koneksi));

							$trans = mysqli_fetch_assoc($transaksi);
						?>

						<table class="table table-hover mt-4">
							<thead style="background-color: #eee">
								<tr>
									<th>Kode Booking</th>
									<th>Tempat</th>
									<th style="width: 20%">Tanggal Mulai</th>
									<th>Total Harga</th>
									<th class="text-center">Status Order</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $trans['kode_booking'] ?><br><small><?= $trans['email_user'] ?></small></td>
									<td>
										<?php echo $trans['nama_tempat']."<br>" ?>
										<small>
											<?php echo $trans['nama_kategori'] ?>
										</small>
									</td>
									<td>
										<?php echo $trans['tanggal_mulai']." s/d ".$trans['tanggal_selesai']."<br><small>Durasi : ".$trans['durasi']." Hari</small>" ?>
									</td>

									<td class="text-right">
										<h6 class="text-info">Rp. <?php echo number_format($trans['total_transaksi']) ?></h6>
									</td>

									<td class="text-center">
										<?php 

											if($trans['status'] == 'selesai'){
												echo "<span class='badge badge-success'>Pembayaran diterima</span>";
											}else if($trans['status'] == 'pending'){
												echo "<span class='badge badge-primary'>Menunggu konfirmasi pembayaran</span>";
											}else{
												echo "<span class='badge badge-danger'>Ditolak</span>";
											}
										?>
									</td>
								</tr>
							</tbody>
						</table>

						<div class="row mt-3">
							<div class="col-md-5">
								<table class="table">
									<tr>
										<td>Tanggal Pesan</td>
										<th class="text-right"><?= $trans['tanggal_pesan'] ?></th>
									</tr>

									<tr>
										<td>Tanggal Konfirmasi</td>
										<th class="text-right"><?= $trans['tanggal_konfirmasi'] ?></th>
									</tr>

									<tr>
										<td>Nama Pasien Isolasi</td>
										<th class="text-right"><?= $trans['nama_pasien'] ?></th>
									</tr>

									<tr>
										<td>Nomor Handphone</td>
										<th class="text-right"><?= $trans['no_hp_pasien'] ?></th>
									</tr>
								</table>
							</div>

							<div class="col-md-7">
								<h6>KONFIRMASI</h6>

								<?php if($trans['status'] == 'pending'){ ?>

									<a href="proses/booking_konfirmasi.php?id=<?= $trans['transaksi_id']?>&status=1" class="btn btn-success" onclick="return confirm('Setujui transaksi ini ?')">SETUJU</a> &nbsp;
									<a href="proses/booking_konfirmasi.php?id=<?= $trans['transaksi_id']?>&status=0" class="btn btn-danger" onclick="return confirm('Tolak transaksi ini ?')">TOLAK</a>
								

								<?php }else{ ?>

									<?php if($trans['status'] == 'selesai'){ ?>
										<div class="alert alert-success">
											<b>Pembayaran diterima</b><br>
											<p>Konfirmasi pembayaran transaksi sudah diterima</p>
										</div>

									<?php }else{ ?>
										<div class="alert alert-danger">
											<b>Pembayaran ditolak</b><br>
											<p>Konfirmasi pembayaran transaksi ditolak</p>
										</div>
									<?php } ?>

								<?php } ?>
							</div>
						</div>

					</div>
				</div>
			</div>			
		</div>
	</div>			
</div>

<?php include 'template/footer_admin.php' ?>
