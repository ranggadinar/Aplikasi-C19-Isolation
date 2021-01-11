<?php 
	
	if(isset($_POST['id'])){
		include '../koneksi.php';

		$p = $_POST;

		$query  = "UPDATE kategori SET 
						nama_kategori = '".$p['nama_kategori']."'

				   WHERE id = '".$p['id']."'
				  ";

		$tambah = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
		if($tambah){
			$_SESSION['alert'] = '<div class="alert alert-success">Data berhasil diubah</div>';
			
		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal diubah</div>';
		}

		header('Location:../admin_kategori.php');
	}
	
?>