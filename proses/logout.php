<?php 
	
	session_start();
	session_destroy();

	$_SESSION['alert'] = '<div class="alert alert-success">Berhasil logout</div>';
	header('Location:../login.php');

?>