<?php 
	
	include '../koneksi.php';

	$query  = "INSERT INTO transaksi SET 
					kode_booking = '".rand()."',
					tempat_id = '".$_POST['tempat_id']."',
					user_id   = '".$_SESSION['login_data']['id']."',
					nama_pasien = '".$_POST['nama_pasien']."',
					no_hp_pasien = '".$_POST['no_hp_pasien']."',
					tanggal_mulai = '".$_POST['tanggal_mulai']."',
					tanggal_selesai = '".$_POST['tanggal_selesai']."',
					durasi = '".$_POST['durasi']."',

					tanggal_pesan = '".date('Y-m-d H:i:s')."',
					total_transaksi = '".$_POST['total_transaksi']."'
			  ";

	$tambah = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
	if($tambah){
		$_SESSION['alert'] = '<div class="alert alert-success">Data booking berhasil ditambahkan</div>';
		header('Location:../user_booking.php');
	}else{
		$_SESSION['alert'] = '<div class="alert alert-danger">Data tidak masuk</div>';
		header('Location:../detail_booking.php?id='.$_POST['tempat_id'].'&from='.$_POST['tanggal_mulai'].'&to='.$_POST['tanggal_selesai']);
	}

?>