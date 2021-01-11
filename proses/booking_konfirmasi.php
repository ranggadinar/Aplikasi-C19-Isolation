<?php 
	
	if(isset($_GET['id'])){
		include '../koneksi.php';

		$p 		= $_GET;
		$status = $p['status'] == '1' ? 'selesai' : 'tolak'; 

		$query  = "UPDATE transaksi SET 
						tanggal_konfirmasi = '".date('Y-m-d H:i:s')."',
						status = '".$status."'

				   WHERE id = '".$p['id']."'
				  ";

		$tambah = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
		if($tambah){
			$_SESSION['alert'] = '<div class="alert alert-success">Transaksi berhasil dikonfirmasi</div>';
			
		}else{
			$_SESSION['alert'] = '<div class="alert alert-danger">Transaksi gagal dikonfirmasi</div>';
		}

		header('Location:../admin_transaksi_detail.php?id='.$p['id']);
	}
	
?>