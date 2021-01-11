<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>C-19 Isolation</title>
    <!-- Favicons -->
    <link type="image/x-icon" href="assets/frontend/img/icon-c19.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/frontend/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/frontend/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/frontend/plugins/fontawesome/css/all.min.css">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="assets/frontend/plugins/fancybox/jquery.fancybox.min.css">
    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="assets/frontend/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/frontend/plugins/select2/css/select2.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/frontend/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
    
    <link rel="stylesheet" href="assets/frontend/plugins/dropzone/dropzone.min.css">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="assets/frontend/css/bootstrap-datetimepicker.min.css">
    <!-- Full Calander CSS -->
        <link rel="stylesheet" href="assets/frontend/plugins/fullcalendar/fullcalendar.min.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/frontend/css/style.css">
    </head>
        <!-- Loader -->
  <!-- /Loader  -->
<div class="main-wrapper">
<!-- Header -->
<header class="header">
        <nav class="navbar navbar-expand-lg header-nav">
          <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
              <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </a>
            <a href="index.php" class="navbar-brand logo">
              <img src="assets/frontend/img/logo2.png" class="img-fluid" alt="Logo">
            </a>
          </div>
          <div class="main-menu-wrapper">
            <div class="menu-header">
              <a href="index.html" class="menu-logo">
                <img src="assets/frontend/img/logo.png" class="img-fluid" alt="Logo">
              </a>
              <a id="menu_close" class="menu-close" href="javascript:void(0);">
                <i class="fas fa-times"></i>
              </a>
            </div>
            <ul class="main-nav">
              <li>
                <a href="index.php">Home</a>
              </li>

              <li>
                <a href="cari.php">Cari Tempat Isolasi</a>
              </li>
            <!-- <li>
                <a href="https://doccure-laravel.dreamguystech.com/template/public/admin/index_admin" target="_blank">Admin</a>
              </li> -->
            </ul>    
          </div>     
          <ul class="nav header-navbar-rht">
            <li class="nav-item contact-item">
              <div class="header-contact-img">
                <i class="far fa-hospital"></i>             
              </div>
              <div class="header-contact-detail">
                <p class="contact-header">Kontak</p>
                <p class="contact-info-header"> 082250548583</p>
              </div>

              <?php if(isset($_SESSION['login'])){ ?>

                <li class="nav-item">
                  <a class="nav-link header-login" href="user_dashboard.php"><?= $_SESSION['login_data']['nama'] ?></a>
                </li> 

              <?php }else{ ?>
                <li class="nav-item">
                  <a class="nav-link header-login" href="login.php">Login / Daftar </a>
                </li>
              <?php } ?>
                          </li>
                                              </ul>
        </nav>
      </header>
      <!-- /Header -->    
    