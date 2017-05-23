<?php
include"koneksi.php";
$triger=$_POST['triger'];
$button=$_POST['btnaksi'];

if($triger == 'edit2' && $button == 'Update Data'){
$id=$_POST['id'];
$idpo=$_POST['id_po'];
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
header("location:editpo.php?kode=$idpo");
}
}

if($triger == 'edit2' && $button == 'Hapus Data'){
$id=$_POST['id'];

$res=$connect_db->query("DELETE from detail_po_sem WHERE kode_brg=$id");

if($res){
header("location:editpo.php?kode=$idpo");
}
}

if($triger == 'del'){
$id=$_POST['id'];
$connect_db->query("delete from detail_po_sem where kode_brg='$id' ");
}

if($triger == 'tambah'){
$res=$connect_db->query("insert into data_test (data_id) values('')");
if($res){
echo json_encode(array());
}
}

if($triger == 'edit'){
$id=$_POST['id'];
$jumlah=$_POST['jumlah'];
$harga=$_POST['harga'];
$totalpo = $harga * $jumlah;
$res=$connect_db->query("UPDATE detail_po_sem SET jml_brg=$jumlah, total=$totalpo WHERE kode_brg=$id");

if($res){
echo json_encode(array());
}
}

?>