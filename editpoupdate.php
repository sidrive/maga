<?php
include"koneksi.php";
$triger=$_POST['triger'];

if($triger == 'edit2'){
$id=$_POST['id'];
$jumlah=$_POST['jmlbrg'];
$harga=$_POST['hargabrg'];
$totalpo = $harga * $jumlah;
echo $id;
echo $jumlah;
echo $harga;
echo $totalpo;
echo $triger;

$res=$connect_db->query("UPDATE detail_po_sem SET jml_brg=$jumlah, total=$totalpo WHERE kode_brg=$id");

if($res){
header("location:editpo.php");
}
}
/*
if($triger == 'del'){
$id=$_POST['id'];
$connect_db->query("delete from user where user_id='$id' ");
}

if($triger == 'tambah'){
$res=$connect_db->query("insert into data_test (data_id) values('')");
if($res){
echo json_encode(array());
}
}

if($triger == 'edit'){
$id=$_POST['id'];
$nama=$_POST['nama'];
$jekel=$_POST['jekel'];
$alamat=$_POST['alamat'];
$status=$_POST['status'];

$res=$connect_db->query("update data_test set data_name='$nama',data_jkl='$jekel',data_alamat='$alamat',data_status='$status' where data_id='$id' ");

if($res){
echo json_encode(array());
}
}
*/
?>