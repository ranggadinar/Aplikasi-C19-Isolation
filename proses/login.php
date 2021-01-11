<?php 
	
	include '../koneksi.php';

	if($_POST['email']){
		$query = mysqli_query($koneksi, 'SELECT * FROM user WHERE email="'.$_POST['email'].'" AND password="'.$_POST['password'].'"');

		if(mysqli_num_rows($query) > 0){
			$user = mysqli_fetch_assoc($query);
			$_SESSION['login'] 		= true;
			$_SESSION['login_data'] = $user;
			
			$_SESSION['alert'] = '<div class="alert alert-success">Berhasil Login</div>';

			if($user['akses'] == 'user'){
				header('Location:../cari.php');
			}else if($user['akses'] == 'admin'){
				header('Location:../admin_dashboard.php');
			}
			
		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Email / password salah</div>';
			header('Location:../login.php');
		}
	}
?>