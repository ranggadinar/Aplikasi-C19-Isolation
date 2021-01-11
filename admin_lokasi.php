<?php include 'template/header_admin.php' ?>

<div class="page-wrapper">
    <div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-7 col-auto">
					<h3 class="page-title">Lokasi</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active">Lokasi</li>
					</ul>
				</div>
				<div class="col-sm-5 col">
					<a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2"><i class="fa fa-plus"></i> TAMBAH LOKASI</a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<?php 
							if(isset($_SESSION['alert'])){
								echo $_SESSION['alert'];
								unset($_SESSION['alert']);
							}
						?>

						<div class="table-responsive">
							<table class="datatable table table-hover table-center mb-0">
								<thead>
									<tr>
										<th style="width: 5%">#</th>
										<th>Nama</th>
										<th>Tanggal Dibuat</th>
										<th class="text-right">Aksi</th>
									</tr>
								</thead>

								<?php  
									$kategori = mysqli_query($koneksi, 'SELECT * FROM lokasi ORDER BY id DESC') or die(mysqli_error($koneksi));
								?>

								<tbody>

									<?php $n=1; while ($data = mysqli_fetch_array($kategori)) { ?>
											<tr>
												<td><?= $n++; ?></td>
												
												<td>
													<h2 class="table-avatar">	
														<?= $data['nama_lokasi'] ?>
													</h2>
												</td>
												
												<td><?= date('d-m-Y H:i', strtotime($data['created_at'])) ?></td>

												<td class="text-right">
													<div class="actions">
														<a class="btn btn-sm bg-success-light" onclick="
															edit(
																'<?= $data['id'] ?>', 
																'<?= $data['nama_lokasi'] ?>'
															)
														">
															<i class="fe fe-pencil"></i> Ubah
														</a>
														<a onclick="return confirm('Hapus data ini?')" href="proses/lokasi_delete.php?id=<?= $data['id'] ?>" class="btn btn-sm bg-danger-light">
															<i class="fe fe-trash"></i> Hapus
														</a>
													</div>
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

<?php include 'template/footer_admin.php' ?>


<!-- Add Modal -->
<form method="POST" action="proses/lokasi_insert.php">
<div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Lokasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row form-row">
					<div class="col-12">
						<div class="form-group">
							<label>Nama Lokasi</label>
							<input type="text" required="" autocomplete="off" name="nama_lokasi" class="form-control">
						</div>
					</div>
					
				</div>
				<button type="submit" class="btn btn-primary btn-block">Simpan</button>
			</div>
		</div>
	</div>
</div>
</form>
<!-- /ADD Modal -->

<!-- Edit Details Modal -->
<form method="POST" action="proses/lokasi_update.php">
	<input type="hidden" id="e_id" name="id">
	<div class="modal fade" id="edit_specialities_details" aria-hidden="true" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document" >
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ubah Lokasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row form-row">
						<div class="col-12">
							<div class="form-group">
								<label>Nama Lokasi</label>
								<input type="text" required="" autocomplete="off" name="nama_lokasi" class="form-control" id="e_nama">
							</div>
						</div>
						
					</div>
					<button type="submit" class="btn btn-warning btn-block">Ubah</button>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- /Edit Details Modal -->

<script type="text/javascript">
	function edit(id, nama){
		$('#e_id').val(id);
		$('#e_nama').val(nama);

		$('#edit_specialities_details').modal('show');
	}
</script>