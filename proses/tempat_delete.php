<?php 
	
	if(isset($_GET['id'])){
		include '../koneksi.php';
		$query    = mysqli_query($koneksi, 'SELECT * FROM tempat WHERE id="'.$_GET['id'].'"');
		$tempat   = mysqli_fetch_assoc($query);
		$old_gbr  = $tempat['foto'];

		$id = $_GET['id'];
		$query = "DELETE FROM tempat WHERE id='".$id."'";

		if(mysqli_query($koneksi, $query) or die(mysqli_error($koneksi))){
			if(file_exists('../assets/foto/'.$old_gbr)){
				unlink('../assets/foto/'.$old_gbr);
			}
				
			$_SESSION['alert'] = '<div class="alert alert-success">Data berhasil dihapus</div>';
		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal dihapus</div>';
		}

		header('Location:../admin_tempat.php');
	}

?>