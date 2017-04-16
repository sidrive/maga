<?php 
require_once("koneksi.php");
 if (isset($_SESSION['items'])) {
        foreach ($_SESSION['items'] as $key => $val) {
            $query = mysqli_query($connect_db, "select * from brg where KODE_BRG = '$key'");
            $data = mysqli_fetch_array($query);

            $jumlah_harga = $data['HRG_SUP'] * $val;
            $total += $jumlah_harga;
            $no = 1;
	$id = 'FBMG'.date('dmy').'-'.$_GET['kode'];
	$edit = date('Y-m-d');
	
	$query1 = mysqli_query($connect_db, "INSERT INTO detail_po (id_po, kode_brg, hrg_sup, jml_brg, tgl_edit)
				VALUES ('$id', '$data[KODE_BRG]', $data[HRG_SUP], $val, '$edit')");

				header ("location:simpanpo.php");
 }}
?>