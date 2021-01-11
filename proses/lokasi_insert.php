<?php 
	
	include '../koneksi.php';

	$p = $_POST;

	$query  = "INSERT INTO lokasi SET 
					nama_lokasi = '".$p['nama_lokasi']."',
					created_at    = '".date('Y-m-d H:i:s')."'
			  ";

	$tambah = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
	if($tambah){
		$_SESSION['alert'] = '<div class="alert alert-success">Data berhasil ditambahkan</div>';
		
	}else{
		$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal ditambahkan</div>';
	}

	header('Location:../admin_lokasi.php');
?>