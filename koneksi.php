<?php
//development connections
$host 	  = 'localhost:3307';
$db 	  = 'tubes_ken';
$username = 'root';
$password = '';
//remote databases
// $host 	  = 'remotemysql.com';
// $db 	  = 'WXhzTIpYq0';
// $username = 'WXhzTIpYq0';
// $password = 'gAtdA3Epn3';

$koneksi = mysqli_connect($host, $username, $password, $db);
session_start();

?>