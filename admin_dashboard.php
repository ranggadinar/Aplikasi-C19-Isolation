<?php include 'template/header_admin.php' ?>

<div class="page-wrapper">
			
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome Admin!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <?php 
            if(isset($_SESSION['alert'])){
                echo $_SESSION['alert'];
                unset($_SESSION['alert']);
            }
        ?>

        <?php 
        	$query = mysqli_query($koneksi, 'SELECT 
        								COUNT(id) AS total_transaksi,
        								SUM(
        									CASE WHEN status = "selesai" THEN total_transaksi ELSE 0 END
        								) AS total_pendapatan
        						   FROM transaksi') or die(mysqli_error($koneksi));
        	$revenue = mysqli_fetch_array($query);

        	$query = mysqli_query($koneksi, 'SELECT * FROM user WHERE akses="user"') or die(mysqli_error($koneksi));
        	$total_user = mysqli_num_rows($query);

        	$query = mysqli_query($koneksi, 'SELECT * FROM tempat') or die(mysqli_error($koneksi));
        	$total_tempat = mysqli_num_rows($query);
        ?>

        <div class="row">
        	<div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-success">
                                <i class="fe fe-money"></i>
                            </span>
                            <div class="dash-count">
                                <h3>Rp <?= number_format($revenue['total_pendapatan']) ?></h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            
                            <h6 class="text-muted">TOTAL PENDAPATAN</h6>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-primary border-primary">
                            	<i class="fe fe-credit-card"></i>
                            </span>
                            <div class="dash-count">
                                <h3><?= $revenue['total_transaksi'] ?></h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            <h6 class="text-muted">JUMLAH TRANSAKSI</h6>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-danger border-danger">
                                <i class="fe fe-folder"></i>
                            </span>
                            <div class="dash-count">
                                <h3><?= $total_tempat ?></h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            
                            <h6 class="text-muted">JUMLAH TEMPAT</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-warning border-warning">
                                <i class="fe fe-users"></i>
                            </span>
                            <div class="dash-count">
                                <h3><?= $total_user ?></h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            
                            <h6 class="text-muted">JUMLAH USER</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            
                <!-- Latest Customers -->
                <div class="card card-table">
                    <div class="card-header">
                        <h4 class="card-title">Booking Terbaru</h4>
                    </div>
                    <div class="card-body">

                        <?php  
							$transaksi = mysqli_query($koneksi, '
								SELECT *, 
									tempat.nama AS nama_tempat, tempat.foto AS foto_tempat,
									user.nama AS nama_user, user.email AS email_user, 
									user.no_hp AS no_hp_user

								FROM transaksi 
								
								JOIN tempat ON tempat.id = transaksi.tempat_id 
								JOIN kategori ON kategori.id = tempat.kategori_id
								JOIN user ON user.id = transaksi.user_id

								ORDER BY transaksi.id DESC LIMIT 5

								') or die(mysqli_error($koneksi));
						?>

						<table class="table table-hover mt-4">
							<thead style="background-color: #eee">
								<tr>
									<th style="width: 5%">No</th>
									<th>Booking</th>
									<th>Tempat</th>
									<th>Tanggal Mulai</th>
									<th>Total Harga</th>
									<th class="text-center">Status Order</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$n = 1;
									while ($row = mysqli_fetch_array($transaksi)) { ?>

									<tr>
										<td><?php echo $n++ ?></td>
										<td><?php echo $row['kode_booking'] ?><br><small><?= $row['nama_user'] ?></small></td>
										<td>
											<?php echo $row['nama_tempat']."<br>" ?>
											<small>
												<?php echo $row['nama_kategori'] ?>
											</small>
										</td>
										<td>
                                            <?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai']."<br><small>Durasi : ".$row['durasi']." Hari</small>" ?>
                                        </td>
										<td class="text-right">Rp <?= number_format($row['total_transaksi']) ?></td>

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
									</tr>
								<?php } ?>
							</tbody>
						</table>

                    </div>
                </div>
                <!-- /Latest Customers -->
                
            </div>
        </div>
        
    </div>			
</div>
<!-- /Page Wrapper -->

<?php include 'template/footer_admin.php' ?>
