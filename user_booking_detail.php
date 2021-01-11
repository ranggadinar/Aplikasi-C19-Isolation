<?php include 'template/header.php'; ?>

<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-8">
							<h4 class="card-title">BOOKING</h4>
						</div>
						<div class="col-4 text-right">
							<a href="proses/logout.php" class="btn btn-danger">Logout</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<ul class="nav nav-tabs nav-tabs-top">
						<li class="nav-item"><a class="nav-link" href="user_dashboard.php">Dashboard</a></li>
						<li class="nav-item"><a class="nav-link active" href="user_booking.php">Booking</a></li>
						<li class="nav-item"><a class="nav-link" href="user_profile.php">Ganti Profile</a></li>
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
								$transaksi = mysqli_query($koneksi, '
									SELECT *, transaksi.id  AS transaksi_id, tempat.nama AS nama_tempat, 
									user.nama AS nama_user FROM transaksi 

										JOIN tempat ON tempat.id = transaksi.tempat_id 
										JOIN kategori ON kategori.id = tempat.kategori_id 
										JOIN lokasi ON lokasi.id = tempat.lokasi_id
										JOIN user ON user.id = transaksi.user_id

									WHERE user_id = "'.$_SESSION['login_data']['id'].'" AND transaksi.id = "'.$_GET['id'].'"') or die(mysqli_error($koneksi));

								$trans = mysqli_fetch_assoc($transaksi);
							?>

							<a href="user_booking.php" class="btn btn-outline-secondary">KEMBALI</a>

							<table class="table table-hover mt-4">
								<thead style="background-color: #eee">
									<tr>
										<th>Kode Booking</th>
										<th>Tempat</th>
										<th style="width: 20%">Tanggal Mulai</th>
										<th class="text-center">Status Order</th>
									</tr>
								</thead>
								<tbody>
										<tr>
											<td><?php echo $trans['kode_booking'] ?><h6 class="text-info">Rp. <?php echo number_format($trans['total_transaksi']) ?></h6></td>
											<td>
												<?php echo $trans['nama_tempat']."<br>" ?>
												<small>
													<?php echo $trans['nama_kategori'] ?>
												</small>
											</td>
											<td>
												<?php echo $trans['tanggal_mulai']." s/d ".$trans['tanggal_selesai']."<br><small>Durasi : ".$trans['durasi']." Hari</small>" ?>
											</td>

											<td class="text-center">
												<?php 
													$msg = 'https://api.whatsapp.com/send?phone=0895373483105&text=Hi Admin, saya ingin melakukan konfirmasi pembayaran dengan kode transaksi #'.$trans['kode_booking'];

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
								<div class="col-md-4">
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

								<div class="col-md-8">
									<?php if($trans['status'] == 'pending'){ ?>

									<div class="alert alert-warning">
										<b>Pembayaran</b><br>
										<p>Silahkan konfirmasi pembayaran dengan mengirim bukti transfer pada nomor yang tertera berikut ini : 0895373483105</p>
									</div>

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
</div>

<?php include 'template/footer.php' ?>
