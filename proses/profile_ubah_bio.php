<?php 
	include '../koneksi.php';

	if($_POST['id']){
		$id = $_SESSION['login_data']['id'];

		$update = mysqli_query($koneksi, 'UPDATE user SET nama="'.$_POST['nama'].'", no_hp="'.$_POST['no_hp'].'" WHERE id="'.$id.'"') or die(mysqli_error($koneksi));

		if($update){
			$_SESSION['login_data'] = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id='".$id."'"));
			$_SESSION['alert'] = '<div class="alert alert-success">Data diri, berhasil diubah</div>';
		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal diubah</div>';
		}

		header('Location:../user_profile.php');
	}

?>