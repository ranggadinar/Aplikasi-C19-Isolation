<?php 
	
	if(isset($_POST['nama_tempat'])){
		include '../koneksi.php';

		$ext_allowed = array('png','jpg', 'jpeg');
		$nama_gbr	 = $_FILES['foto']['name'];
		$x 			 = explode('.', $nama_gbr);
		$ext  	     = strtolower(end($x));
		$file_tmp 	 = $_FILES['foto']['tmp_name'];	

		if(in_array($ext, $ext_allowed)){
			move_uploaded_file($file_tmp, '../assets/foto/'.$nama_gbr);
			$query = "INSERT INTO tempat SET 
				nama 		 = '".$_POST['nama_tempat']."',
				kategori_id  = '".$_POST['kategori_id']."',
				lokasi_id 	 = '".$_POST['lokasi_id']."',
				harga 		 = '".$_POST['harga']."',
				alamat       = '".$_POST['alamat']."',
				foto 		 = '".$nama_gbr."',
				deskripsi    = '".$_POST['deskripsi']."',
				kuota	     = '".$_POST['kuota']."',
				created_at 	 = '".date('Y-m-d H:i:s')."'";

			if(mysqli_query($koneksi, $query) or die(mysqli_error($koneksi))){
				$_SESSION['alert'] = '<div class="alert alert-success">Data berhasil ditambahkan</div>';
			}else{
				$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal ditambahkan</div>';
			}

		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Esktensi file tidak diizinkan</div>';
		}

		header('Location:../admin_tempat.php');
	}

?>