<?php
include"koneksi.php";

$kode=$_POST['kodesup'];
$res=$connect_db->query("SELECT * FROM brg WHERE SUP = $kode");

if($res){
echo json_encode(array());
}

?>