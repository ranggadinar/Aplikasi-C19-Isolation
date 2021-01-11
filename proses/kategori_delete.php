<?php 
	
	if(isset($_GET['id'])){

		include '../koneksi.php';

		$query  = "DELETE FROM kategori WHERE id='".$_GET['id']."'";

		$tambah = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
		if($tambah){
			$_SESSION['alert'] = '<div class="alert alert-success">Data berhasil dihapus</div>';
			
		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal dihapus</div>';
		}

		header('Location:../admin_kategori.php');
	}
	
?>