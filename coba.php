<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
 require_once("koneksi.php");
    if (!isset($_SESSION)) {
        session_start();
    }
	$no=0;
	date_default_timezone_set("Asia/Jakarta");
		echo date("dmy-H:i:s"); 
		include("header.php");
		$awal = $_GET['tanggalawal'];
		$akhir = $_GET['tanggalakhir'];	
	echo $awal;
		?>

     
	  
<?php include ("footer.php") ?>