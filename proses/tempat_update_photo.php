<?php 
	
	if(!empty($_FILES['foto']['name'])){
		include '../koneksi.php';

		$u = true;
		$query    = mysqli_query($koneksi, 'SELECT * FROM tempat WHERE id="'.$_POST['id'].'"');
		$tempat   = mysqli_fetch_assoc($query);
		$old_gbr  = $tempat['foto'];

		if(!empty($_FILES['foto']['name'])){
			$ext_allowed = array('png','jpg', 'jpeg');
			$nama_gbr	 = $_FILES['foto']['name'];
			$x 			 = explode('.', $nama_gbr);
			$ext  	     = strtolower(end($x));
			$file_tmp 	 = $_FILES['foto']['tmp_name'];

			if(in_array($ext, $ext_allowed)){
				move_uploaded_file($file_tmp, '../assets/foto/'.$nama_gbr);

				if(file_exists('../assets/foto/'.$old_gbr)){
					unlink('../assets/foto/'.$old_gbr);
				}

				$query = "UPDATE tempat SET foto = '".$nama_gbr."' WHERE id='".$_POST['id']."'";

				if(mysqli_query($koneksi, $query) or die(mysqli_error($koneksi))){
					$_SESSION['alert'] = '<div class="alert alert-success">Foto berhasil diubah</div>';
				}else{
					$_SESSION['alert'] = '<div class="alert alert-danger">Foto gagal diubah</div>';
				}

			}else{
				$_SESSION['alert'] = '<div class="alert alert-danger">Esktensi file tidak diizinkan</div>';
			}

			header('Location:../admin_tempat.php');
		}
		
	}

?>