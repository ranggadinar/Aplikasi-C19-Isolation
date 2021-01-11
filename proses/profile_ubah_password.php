<?php 
	include '../koneksi.php';

	if($_POST['id']){
		$update = mysqli_query($koneksi, 'UPDATE user SET password="'.$_POST['password'].'" WHERE id="'.$_SESSION['login_data']['id'].'"');

		if($update){
			$_SESSION['alert'] = '<div class="alert alert-success">Password berhasil diubah</div>';
		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal diubah</div>';
		}

		header('Location:../user_password.php');
	}

?>