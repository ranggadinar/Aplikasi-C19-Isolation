<?php 
	
	include '../koneksi.php';

	$p = $_POST;

	$query  = "INSERT INTO kategori SET 
					nama_kategori = '".$p['nama_kategori']."',
					created_at    = '".date('Y-m-d H:i:s')."'
			  ";

	$tambah = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
	if($tambah){
		$_SESSION['alert'] = '<div class="alert alert-success">Data berhasil ditambahkan</div>';
		
	}else{
		$_SESSION['alert'] = '<div class="alert alert-danger">Data gagal ditambahkan</div>';
	}

	header('Location:../admin_kategori.php');
?>