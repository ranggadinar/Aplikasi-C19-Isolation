<?php 
	
	include '../koneksi.php';

	if($_POST['email']){
		$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE email='".$_POST['email']."'");

		if(mysqli_num_rows($cek) == 0){
			$query = 'INSERT INTO user SET 
						email = "'.$_POST['email'].'",
						password = "'.$_POST['password'].'",
						nama = "'.$_POST['nama'].'",
						no_hp = "'.$_POST['no_hp'].'"
					 ';

			$tambah = mysqli_query($koneksi, $query);

			if($tambah){
				$_SESSION['alert'] = '<div class="alert alert-success">Berhasil Daftar, silahkan login</div>';
				header('Location:../login.php');
			}else{
				$_SESSION['alert'] = '<div class="alert alert-danger">Data tidak masuk</div>';
				header('Location:../register.php');
			}

		}else{
			$_SESSION['alert'] = '<div class="alert alert-warning">Email sudah ada, gunakan yang lain</div>';
			header('Location:../register.php');
		}
		
	}
?>