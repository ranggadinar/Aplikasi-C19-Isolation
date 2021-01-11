<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
                <title>Panel Admin</title>
                <link rel="shortcut icon" type="image/x-icon" href="assets/frontend/img/icon-c19.png">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/admin/css/font-awesome.min.css">
        <!-- <link rel="stylesheet" href="https://doccure-laravel.dreamguystech.com/template/public/assets_pharmacy/plugins/fontawesome/css/font-awesome.min.css"> -->
        
        <link rel="stylesheet" href="assets/admin/plugins/fontawesome/css/all.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/admin/css/feathericon.min.css">
        <link rel="stylesheet" href="assets/admin/plugins/morris/morris.css">
        <!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/admin/css/select2.min.css">
        	<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/admin/css/bootstrap-datetimepicker.min.css">
		
		<!-- Full Calander CSS -->
        <link rel="stylesheet" href="assets/admin/plugins/fullcalendar/fullcalendar.min.css">
        <!-- Datatables CSS -->
		<link rel="stylesheet" href="assets/admin/plugins/datatables/datatables.min.css">
		
		<!-- <link rel="stylesheet" href="assets/plugins/morris/morris.css"> -->
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/admin/css/style.css">  

        <script src="assets/admin/js/jquery-3.2.1.min.js"></script>
   </head>

  <body>
    <!-- Main Wrapper -->
	<div class="main-wrapper">
		
		<!-- Header -->
		<div class="header">
		
			<!-- Logo -->
			<div class="header-left">
				<a href="admin_dashboard.php" class="logo">
					<img src="assets/frontend/img/logo2.png" alt="Logo">
				</a>
			</div>
				
			<!-- Header Right Menu -->
			<ul class="nav user-menu">

				<?php $user = $_SESSION['login_data']; ?>
				
				<!-- User Menu -->
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img"><img class="rounded-circle" src="assets/admin/img/profiles/avatar.jpg" width="31" alt="Ryan Taylor"></span>
					</a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm">
								<img src="assets/admin/img/profiles/avatar.jpg" alt="User Image" class="avatar-img rounded-circle">
							</div>
							<div class="user-text">
								<h6><?= $user['nama'] ?></h6>
								<p class="text-muted mb-0">Administrator</p>
							</div>
						</div>
						<a class="dropdown-item" href="proses/logout.php">Logout</a>
					</div>
				</li>
				<!-- /User Menu -->
				
			</ul>
			<!-- /Header Right Menu -->
			
		</div>
		<!-- /Header --> <!-- Sidebar -->
<div class="sidebar bg-dark" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li> 
								<a href="admin_dashboard.php"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Tempat</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="" href="admin_lokasi.php">Lokasi</a></li>
									<li><a class="" href="admin_kategori.php">Kategori</a></li>
									<li><a class="" href="admin_tempat.php">Daftar Tempat</a></li>
								</ul>
							</li>

							<li class=""><a href="admin_transaksi.php"><i class="fe fe-table"></i> <span>Transaksi</span></a></li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->  	<!-- Page Wrapper -->
