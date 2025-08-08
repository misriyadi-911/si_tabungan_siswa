<?php  
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "db_tabungan_si";
	$conn = mysqli_connect($server,$username,$password) or die ("Koneksi Gagal");
	$db = mysqli_select_db($conn, $database);
?>