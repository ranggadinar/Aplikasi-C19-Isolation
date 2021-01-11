<?php 
	
	if(isset($_POST['nama_tempat'])){
		include '../koneksi.php';

		$query = "UPDATE tempat SET 
			nama 		 = '".$_POST['nama_tempat']."',
			kategori_id  = '".$_POST['kategori_id']."',
			lokasi_id 	 = '".$_POST['lokasi_id']."',
			harga 		 = '".$_POST['harga']."',
			alamat       = '".$_POST['alamat']."',
			deskripsi    = '".$_POST['deskripsi']."',
			kuota	     = '".$_POST['kuota']."'

			WHERE id = '".$_POST['id']."'
			";

		if(mysqli_query($koneksi, $query) or die(mysqli_error($koneksi))){
			$_SESSION['alert'] = '<div class="alert alert-success">Data berhasil diubah</div>';
		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal diubah</div>';
		}

		header('Location:../admin_tempat.php');
	}

?>