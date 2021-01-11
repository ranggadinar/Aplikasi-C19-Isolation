<?php include 'template/header_admin.php' ?>

<div class="page-wrapper">
    <div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-7 col-auto">
					<h3 class="page-title">Transaksi</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active">Transaksi</li>
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

								ORDER BY transaksi.id DESC') or die(mysqli_error($koneksi));
						?>

						<table class="table table-hover mt-4">
							<thead style="background-color: #eee">
								<tr>
									<th style="width: 5%">No</th>
									<th>Kode Booking</th>
									<th>Tempat</th>
									<th style="width: 20%">Tanggal Mulai</th>
									<th>Total Harga</th>
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
										<td><?php echo $row['kode_booking'] ?><br><small><?= $row['email_user'] ?></small></td>
										<td>
											<?php echo $row['nama_tempat']."<br>" ?>
											<small>
												<?php echo $row['nama_kategori'] ?>
											</small>
										</td>
										<td>
											<?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai']."<br><small>Durasi : ".$row['durasi']." Hari</small>" ?>
										</td>

										<td class="text-right">
											<h6 class="text-info">Rp. <?php echo number_format($row['total_transaksi']) ?></h6>
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
											<a href="admin_transaksi_detail.php?id=<?= $row['transaksi_id'] ?>" class="btn btn-info">Detail</a>
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

<?php include 'template/footer_admin.php' ?>
