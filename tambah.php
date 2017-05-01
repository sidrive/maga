<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
require_once("koneksi.php");
$q = intval($_GET['kode_brg']);
$val = intval($_GET['jmledit']);
	  
		$queryPosem = "SELECT * from detail_po_sem WHERE kode_brg = $q";
		$resultPosem = mysqli_query($connect_db, $queryPosem);
		$row = mysqli_fetch_assoc($resultPosem);
				
				$jumlahUpdate = $val;
				$totalHarga = ($row['hrg_sup'] * $jumlahUpdate);
				$queUpdate = "Update detail_po_sem set jml_brg = $jumlahUpdate, total = $totalHarga where kode_brg = $q";
				$resultUpdate = mysqli_query($connect_db, $queUpdate);
        ?>
</body>
</html>