<?php include 'template/header_admin.php' ?>

<div class="page-wrapper">
    <div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-7 col-auto">
					<h3 class="page-title">Tempat</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
						<li class="breadcrumb-item active">Tempat</li>
					</ul>
				</div>
				<div class="col-sm-5 col">
					<a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2"><i class="fa fa-plus"></i> TAMBAH TEMPAT</a>
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
										<th>Lokasi</th>
										<th>Kuota</th>
										<th>Harga</th>
										<th>Tanggal Dibuat</th>
										<th class="text-right" style="width: 15%">Actions</th>
									</tr>
								</thead>

								 <?php  
									$tempat = mysqli_query($koneksi, '
										SELECT *, 
											tempat.nama AS nama_tempat, tempat.foto AS foto_tempat,
											tempat.id AS tempat_id

										FROM tempat 
										
										JOIN kategori ON kategori.id = tempat.kategori_id
										JOIN lokasi ON lokasi.id = tempat.lokasi_id

										ORDER BY tempat.id DESC

										') or die(mysqli_error($koneksi));
								?>


								<tbody>
									<?php $n=1; while ($data = mysqli_fetch_array($tempat)) { ?>
											<tr>
												<td><?= $n++; ?></td>
												
												<td>
													<h2 class="table-avatar">
														<a class="avatar avatar-sm mr-2">
															<img class="avatar-img rounded-circle" src="assets/foto/<?= $data['foto'] ?>" alt="product image">
														</a>
														<?= $data['nama'] ?>
														
													</h2><br>
													<small>Kategori : <?= $data['nama_kategori'] ?></small>
												</td>

												<td><?= $data['nama_lokasi'] ?><br><small><?= $data['alamat'] ?></small></td>

												<td><?= $data['kuota'] ?></td>
												<td class="text-right">Rp <?= number_format($data['harga']) ?></td>
												
												<td><?= date('d-m-Y H:i', strtotime($data['created_at'])) ?></td>

												<td class="text-right">
													<div class="actions">
														<a class="btn btn-sm bg-success-light" onclick="
															edit(
																'<?= $data['tempat_id'] ?>', 
																'<?= $data['kategori_id'] ?>',
																'<?= $data['lokasi_id'] ?>',
																'<?= $data['nama'] ?>',
																'<?= $data['harga'] ?>',
																'<?= $data['alamat'] ?>',
																`<?= $data['deskripsi'] ?>`,
																'<?= $data['kuota'] ?>',
															)
														">
															<i class="fe fe-pencil"></i> Ubah
														</a>
														<a class="btn btn-sm bg-success-light" onclick="
															edit_img(
																'<?= $data['tempat_id'] ?>', 
																'<?= $data['foto'] ?>'
															)
														">
															<i class="fa fa-image"></i> Gambar
														</a>
														<a onclick="return confirm('Hapus data ini?')" href="proses/tempat_delete.php?id=<?= $data['tempat_id'] ?>" class="btn btn-sm bg-danger-light">
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
<form method="POST" action="proses/tempat_insert.php" enctype="multipart/form-data">
<div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Tempat</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row form-row">
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Nama Tempat</label>
								<input type="text" class="form-control" required="" autocomplete="off" name="nama_tempat">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Harga</label>
								<input type="number" class="form-control" required="" autocomplete="off" name="harga">
							</div>
						</div>

						<div class="col-12 col-sm-6">
							<div class="form-group">
								<?php 
									$kategori = mysqli_query($koneksi, 'SELECT * FROM kategori ORDER BY nama_kategori ASC');
								?>
								<label>Kategori Tempat</label>
								<select class="form-control" required="" name="kategori_id">
									<option value="">Pilih</option>
									<?php 
										while ($data = mysqli_fetch_array($kategori)) { ?>
											<option value="<?= $data['id'] ?>"><?= $data['nama_kategori'] ?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<?php 
									$lokasi = mysqli_query($koneksi, 'SELECT * FROM lokasi ORDER BY nama_lokasi ASC');
								?>
								<label>Lokasi</label>
								<select class="form-control" required="" name="lokasi_id">
									<option value="">Pilih</option>
									<?php 
										while ($data = mysqli_fetch_array($lokasi)) { ?>
											<option value="<?= $data['id'] ?>"><?= $data['nama_lokasi'] ?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-12">
							<div class="form-group">
								<label>Kuota</label>
								<input type="number" placeholder="0" required="" class="form-control" autocomplete="off" name="kuota">
							</div>
						</div>

						<div class="col-12 col-sm-12">
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" class="form-control" required="" autocomplete="off" name="alamat">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" required="" name="foto" class="form-control">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label>Deskripsi Tempat</label>
								<textarea class="form-control" name="deskripsi" required="" placeholder="Ketik keterangan..."></textarea>
							</div>
						</div>
						
					</div>
					<button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
				</form>
			</div>
		</div>
	</div>
</div>
</form>
<!-- /ADD Modal -->


<!-- Add Modal -->
<form method="POST" action="proses/tempat_update.php" enctype="multipart/form-data">
	<input type="hidden" id="e_id" name="id">
<div class="modal fade" id="edit_specialities_details" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ubah Tempat</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row form-row">
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Nama Tempat</label>
								<input type="text" id="e_nama" class="form-control" required="" autocomplete="off" name="nama_tempat">
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>Harga</label>
								<input type="number" id="e_harga" class="form-control" required="" autocomplete="off" name="harga">
							</div>
						</div>

						<div class="col-12 col-sm-6">
							<div class="form-group">
								<?php 
									$kategori = mysqli_query($koneksi, 'SELECT * FROM kategori ORDER BY nama_kategori ASC');
								?>
								<label>Kategori Tempat</label>
								<select class="form-control" required="" id="e_kategori" name="kategori_id">
									<option value="">Pilih</option>
									<?php 
										while ($data = mysqli_fetch_array($kategori)) { ?>
											<option value="<?= $data['id'] ?>"><?= $data['nama_kategori'] ?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<?php 
									$lokasi = mysqli_query($koneksi, 'SELECT * FROM lokasi ORDER BY nama_lokasi ASC');
								?>
								<label>Lokasi</label>
								<select class="form-control" id="e_lokasi" required="" name="lokasi_id">
									<option value="">Pilih</option>
									<?php 
										while ($data = mysqli_fetch_array($lokasi)) { ?>
											<option value="<?= $data['id'] ?>"><?= $data['nama_lokasi'] ?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>

						<div class="col-12 col-sm-12">
							<div class="form-group">
								<label>Kuota</label>
								<input type="number" placeholder="0" required="" id="e_kuota" class="form-control" autocomplete="off" name="kuota">
							</div>
						</div>

						<div class="col-12 col-sm-12">
							<div class="form-group">
								<label>Alamat</label>
								<input type="text" id="e_alamat" class="form-control" autocomplete="off" name="alamat">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label>Deskripsi Tempat</label>
								<textarea class="form-control" name="deskripsi" required="" placeholder="Ketik keterangan..." id="e_deskripsi"></textarea>
							</div>
						</div>
						
					</div>
					<button type="submit" class="btn btn-warning btn-block">Ubah</button>
				</form>
			</div>
		</div>
	</div>
</div>
</form>
<!-- /ADD Modal -->



<!-- Edit Details Modal -->
<form method="POST" action="proses/tempat_update_photo.php" enctype="multipart/form-data">
	<input type="hidden" name="id" id="e_id_img">
<div class="modal fade" id="edit_specialities_photo" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ganti Foto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row form-row">
						<div class="col-12 col-sm-12">
							<div class="form-group">
								<label>Foto</label>
								<img class="img-fluid" id="e_photo">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" name="foto" class="form-control">
							</div>
						</div>
						
					</div>
					<button type="submit" class="btn btn-warning btn-block">Ganti</button>
				</form>
			</div>
		</div>
	</div>
</div>
</form>
<!-- /Edit Details Modal -->


<script type="text/javascript">
	function edit(id, kategori_id, lokasi_id, nama, harga, alamat, deskripsi, kuota){
		$('#e_id').val(id);
		$('#e_nama').val(nama);
		$('#e_harga').val(harga);
		$('#e_alamat').val(alamat);
		$('#e_deskripsi').val(deskripsi);
		$('#e_kuota').val(kuota);

		$('#e_kategori option').removeAttr('selected');
		$('#e_kategori option[value="'+ kategori_id +'"]').attr('selected', 'selected');

		$('#e_lokasi option').removeAttr('selected');
		$('#e_lokasi option[value="'+ lokasi_id +'"]').attr('selected', 'selected');

		$('#edit_specialities_details').modal('show');
	}

	function edit_img(id, file){
		$('#e_id_img').val(id);
		$('#e_photo').attr('src', 'assets/foto/' + file)

		$('#edit_specialities_photo').modal('show');
	}
</script>