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

									WHERE user_id = "'.$_SESSION['login_data']['id'].'"') or die(mysqli_error($koneksi));
							?>

							<table class="table table-hover mt-4">
								<thead style="background-color: #eee">
									<tr>
										<th style="width: 5%">No</th>
										<th>Kode Booking</th>
										<th>Tempat</th>
										<th style="width: 20%">Tanggal Mulai</th>
										<th class="text-center">Status Order</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$n = 1;
										while ($row = mysqli_fetch_array($transaksi)) { ?>

										<tr>
											<td><?php echo $n++ ?></td>
											<td><?php echo $row['kode_booking'] ?><h6 class="text-info">Rp. <?php echo number_format($row['total_transaksi']) ?></h6></td>
											<td>
												<?php echo $row['nama_tempat']."<br>" ?>
												<small>
													<?php echo $row['nama_kategori'] ?>
												</small>
											</td>
											<td>
												<?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai']."<br><small>Durasi : ".$row['durasi']." Hari</small>" ?>
											</td>

											<td class="text-center">
												<?php 

													if($row['status'] == 'selesai'){
														echo "<span class='badge badge-success'>Pembayaran diterima</span>";
													}else if($row['status'] == 'pending'){
														echo "<span class='badge badge-primary'>Menunggu konfirmasi pembayaran</span>";
													}else{
														echo "<span class='badge badge-danger'>Ditolak</span>";
													}
												?>
											</td>

											<td class="text-center">
												<a href="user_booking_detail.php?id=<?= $row['transaksi_id'] ?>" class="btn btn-info">Detail</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'template/footer.php' ?>
